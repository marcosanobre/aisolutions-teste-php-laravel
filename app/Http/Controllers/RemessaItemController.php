<?php

namespace App\Http\Controllers;

use App\Models\Remessa;
use App\Models\RemessaItem;
use Illuminate\Http\Request;

class RemessaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $meses = ['janeiro', 'fevereiro', 'marÇo', 'marco', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outrubro', 'novembro', 'dezembro'];

        $remessa_id             = $request->remessa_id;
        $categoria              = $request->categoria ;
        $periodo_referencia     = strtolower( $request->periodo_referencia );
        $cod_documento          = $request->cod_documento ;
        $titulo                 = $request->titulo ;
        $conteudo               = $request->conteudo ;

        $categoria_id           = ($categoria == 'Remessa Parcial' ? 1 : 2);

        $logRemessa             = "\nDocumento: " . $request->cod_documento;
        $tamanho                = strlen($conteudo);

        // Regras de Validação de Remessa
        $documentoValido = true;
        if ($tamanho > 2048) {
            $documentoValido = false;
            $logRemessa = $logRemessa . "\n Conteúdo do Documento: inválido. Excedeu limite de tamanho: maior que 2048 caracteres.";
        };

        if( ($categoria_id == 1) && (! in_array($periodo_referencia, $meses) ) ) {
            $documentoValido = false;
            $logRemessa = $logRemessa . "\n Periodo de Referencia do Documento: inválido. Para Remessa Parcial, tem que ser um mês [Janeiro ... Dezembro].";
        };

        if( ($categoria_id == 2) && (! str_contains('....'.$periodo_referencia, 'semestre') ) ){
            $documentoValido = false;
            $logRemessa = $logRemessa . "\n Periodo de Referencia do Documento: inválido. Para Remessa, tem que ser 'semestre'.";
        };

        if($documentoValido) {
            $logRemessa = $logRemessa . ' - Válido. Documento registrado com sucesso.';
        };

        // Criar e salvar uma nova Remessa
        $remessaItem = new RemessaItem();
        $remessaItem->remessa_id = $remessa_id;
        $remessaItem->categoria_id = $categoria_id;
        $remessaItem->periodo_referencia = $periodo_referencia;
        $remessaItem->cod_documento = $cod_documento;
        $remessaItem->titulo = $titulo;
        $remessaItem->conteudo = $conteudo;
        $remessaItem->save(); // Salva a Remessa no banco de dados

        $remessa = Remessa::find($remessa_id);
        $log     = $remessa->log . $logRemessa;
        $qtd     = $remessa->qtd_documentos + 1;
        $remessa->log = $log;
        $remessa->qtd_documentos = $qtd;
        $remessa->status = $documentoValido ? $remessa->status : 'Com Problema';
        $remessa->save();

        // Retorne a nova Remessa como resposta JSON
        return response()->json($remessaItem, 201); // 201 indica criação bem-sucedida
    }

    /**
     * Display the specified resource.
     */
    public function show(RemessaItem $remessaItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RemessaItem $remessaItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RemessaItem $remessaItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RemessaItem $remessaItem)
    {
        //
    }
}
