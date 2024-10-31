<?php

namespace App\Http\Controllers;

use App\Models\Remessa;
use App\Models\RemessaItem;

use App\Models\FilaTarefa;
use Illuminate\Http\Request;

class FilaTarefaController extends Controller
{
    /**
     * Datagrid da Fila.
     */
    public function insereTarefa($idRemessa)
    {
        $remessa = Remessa::find($idRemessa);
        $label_remessa = $remessa->exercicio_remessa . '|' . $remessa->sequencial_remessa ;
var_dump($label_remessa);
die();        
        // Recupera a Remessa e registra na Fila
        // Invoca o dataGrid da Fila
        return view("filatarefas.filatarefas");
    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FilaTarefa $filaTarefa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FilaTarefa $filaTarefa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FilaTarefa $filaTarefa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FilaTarefa $filaTarefa)
    {
        //
    }

}
