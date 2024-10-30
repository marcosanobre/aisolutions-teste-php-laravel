<?php

namespace App\Http\Controllers;

use App\Models\Remessa;
use Illuminate\Http\Request;

class RemessaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $remessas = Remessa::all();
        return view('importacao.remessas', compact('remessas') );
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
    public function show(Remessa $remessa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remessa $remessa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Remessa $remessa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remessa $remessa)
    {
        //
    }

    public function fetchItens(Remessa $remessa)
    {
        $itens = $remessa->itens; // Usa a relação definida para buscar os itens
        return response()->json($itens); // Retorna os itens como JSON
    }

}
