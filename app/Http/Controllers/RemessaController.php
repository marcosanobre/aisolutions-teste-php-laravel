<?php

namespace App\Http\Controllers;

use App\Models\Remessa;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class RemessaController extends Controller
{
    private function remessaExiste($exercicio, $sequencial)
    {
        $remessa = Remessa::where('exercicio_remessa', '=', $exercicio)
                            ->where('sequencial_remessa','=',$sequencial)
                            ->get();
        return $remessa->isEmpty() ? false : true;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $remessas = Remessa::all();
        return view('remessa.remessas', compact('remessas') );
    }

    public function fetchItens(Remessa $remessa)
    {
        //$itens = $remessa->itens; // Usa a relação definida para buscar os itens

        // Carregar itens da remessa juntamente com a categoria relacionada
        $itens = $remessa->itens()->with('categoria')->get();
        return response()->json($itens); // Retorna os itens como JSON
    }

    public function uploadJson(Request $request)
    {
        $request->validate([
            'jsonFile' => 'required|file|mimes:json|max:10240'
        ]);

        // Ler o conteúdo do arquivo JSON
        $jsonData = json_decode(file_get_contents($request->file('jsonFile')), true);

        if ($jsonData === null) {
            return response()->json(['message' => 'Arquivo JSON inválido.'], 400);
        }

        // Retorne os dados JSON para o JavaScript processar
        return response()->json(['data' => $jsonData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if( ! $this->remessaExiste($request->exercicio_remessa, $request->sequencial_remessa) )
        {
            // Validação dos dados
            $validatedData = $request->validate([
                'exercicio_remessa' => 'required|integer',
                'sequencial_remessa' => 'required|integer',
                'status' => 'required|string|max:30',
            ]);

            $logR = 'Remessa: ' . $request->exercicio_remessa . ' / ' . $request->sequencial_remessa;

            // Criar e salvar uma nova Remessa
            $remessa = new Remessa();
            $remessa->exercicio_remessa = $validatedData['exercicio_remessa'];
            $remessa->sequencial_remessa = $validatedData['sequencial_remessa'];
            $remessa->qtd_documentos = 0;
            $remessa->status = $validatedData['status'];
            $remessa->log = $logR;
            $remessa->save(); // Salva a Remessa no banco de dados

            // Retorne a nova Remessa como resposta JSON
            return response()->json($remessa, 201); // 201 indica criação bem-sucedida
        };
        $returnData = ['status' => 'error', 'message' => 'Remessa já Importada !!!'];
        return  response()->json($returnData, 422);
    }

    /**
     * Display a listing of the resource.
     */
    public function showLogs()
    {
        $remessas = Remessa::all();
        return view('logs_remessa.logs', compact('remessas') );
    }

    /**
     * Display a listing of the resource.
     */
    public function showLogRemessa(Request $request, $remessaId)
    {
        $remessa = Remessa::find($remessaId);

        return view('logs_remessa.logitem', compact('remessa') );
    }

}
