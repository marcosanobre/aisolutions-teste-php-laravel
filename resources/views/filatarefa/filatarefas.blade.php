@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datagrid.css') }}">
@endsection

@section('content')

<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Fila de Processamento
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table-tasks" id="tarefaTable">
                        <thead>
                            <tr>
                                <th>Remessa</th>
                                <th>Quantidade Documentos</th>
                                <th>Data Processamento</th>
                                <th>Situação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $tarefa)
                                <tr data-id="{{ $tarefa->id }}" class="tarefa-row">
                                    <td data-label={{ __("Remessa") }}>{{ $tarefa['exercicio_tarefa'] }}</td>
                                    <td data-label={{ __("Qtd Docmtos") }}>{{ $tarefa['qtd_documentos'] }}</td>
                                    <td data-label={{ __("Dt Processamento") }}>{{ date('d/m/Y', strtotime($tarefa['created_at']) ) }}</td>
                                    <td data-label={{ __("Situação") }}>{{ $tarefa['status'] }}</span></td>
                                    <td data-label={{ __("Ação") }}>
                                        <div class="hidden space-x-8 sm:-my-px sm:ms-5 sm:flex">
                                            @if ($tarefa['status'] == 'Em Fila')
                                                <a href="{{ route('filatarefa.insereTarefa', $tarefa['id']) }}" class="action-btn edit">Processa</a -->
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a class="action-btn create" href="{{ route('home') }}">Volta</a>
</div>

@endsection
