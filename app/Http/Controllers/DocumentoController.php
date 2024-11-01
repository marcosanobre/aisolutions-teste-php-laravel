<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\DocumentoItem;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = Documento::all();
        return view('documento.documentos', compact('documentos') );
    }

    public function fetchItens(Documento $documento, $id)
    {
        //$itens = $documento->itens(); // Usa a relação definida para buscar os itens

        // Carregar itens do documento juntamente com os dados do Documento relacionada
        $itens = $documento::find($id)->itens()->with('documento')->get();
        return response()->json($itens); // Retorna os itens como JSON
    }

    /**
     * Display the specified resource.
     */
    public function showDocumento(Documento $documento, $id)
    {
        $docItem    = DocumentoItem::find($id);
        $docCodigo  = $documento::find($docItem->documento_id)->cod_documento;
        $docTitulo  = $docItem->titulo;
        $docConteudo= $docItem->conteudo;
        $documento  = ['id'=>$id, 'cod_documento'=>$docCodigo, 'titulo'=>$docTitulo, 'conteudo'=>$docConteudo];
//dd($documento);
        return view('documento.documentoitem', compact('documento') );
    }

}
