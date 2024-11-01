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
    public function index()
    {
        $tarefas = FilaTarefa::all();
        return view('filatarefa.filatarefas', compact('tarefas') );
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
    public function insereTarefa(Request $request, $remessaId)
    {
        $tarefa = new FilaTarefa();
        $tarefa->status = 'Em Fila';
        $tarefa->remessa_id = $remessaId;
        $tarefa->save();
        return redirect('/tarefas');
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
