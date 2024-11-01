<?php

namespace App\Http\Controllers;

use App\Models\Remessa;
use App\Models\Documento;
use App\Models\DocumentoItem;
use App\Models\FilaTarefa;
use App\Models\RemessaItem;

use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class FilaTarefaController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function processaTarefa(Request $request, $filaTarefaId)
    {
        $filaTarefa = FilaTarefa::find($filaTarefaId);
        $remessaId  = $filaTarefa->remessa_id;

        // Pega Remessa
        $remessa = Remessa::find($remessaId);

        // Pega Documentos da Remessa
        $documentos = $remessa->itens()->get();

        $so1vez = true;

        foreach ($documentos as $doc) {
            // Processa Documentos para a Tarefa
            if( $so1vez ) {
                // Insere Documento-Master
                $documentoM = new Documento();
                $documentoM->cod_documento = $doc->cod_documento;
                $documentoM->save();
                $so1vez = false;
            }
            // Insere Documento-Detail
            $documentoD = new DocumentoItem();
            $documentoD->documento_id   = $documentoM->id;
            $documentoD->titulo         = $doc->titulo;
            $documentoD->conteudo       = $doc->conteudo;
            $documentoD->save();
        };

        // Muda STATUS da Fila para Processada
        $filaTarefa->status = 'Processada';
        $filaTarefa->save();

        // Muda STATUS da Remessa para Processada
        $remessa->status = 'Processada';
        $remessa->save();
        return redirect('/tarefas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insereTarefa(Request $request, $remessaId)
    {
        $tarefaJaExiste = FilaTarefa::where('remessa_id','=',$remessaId)->get();

        if ($tarefaJaExiste->isEmpty()) {
            $tarefa = new FilaTarefa();
            $tarefa->status = 'Em Fila';
            $tarefa->remessa_id = $remessaId;
            $tarefa->save();
        };
        return redirect('/tarefas');
    }

    /**
     * Datagrid da Fila.
     */
    public function index()
    {
        $tarefas = FilaTarefa::with('remessa')->get();
        return view('filatarefa.filatarefas', compact('tarefas') );
    }

    /* *
     * Show the form for creating a new resource.
    public function create()
    {
        //
    }
     */

    /* *
     * Display the specified resource.
    public function show(FilaTarefa $filaTarefa)
    {
        //
    }
     */


    /* *
     * Update the specified resource in storage.
    public function update(Request $request, FilaTarefa $filaTarefa)
    {
        //
    }
     */

    /* *
     * Remove the specified resource from storage.
    public function destroy(FilaTarefa $filaTarefa)
    {
        //
    }
     */

}
