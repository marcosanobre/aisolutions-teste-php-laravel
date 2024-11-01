@extends('layouts.main')

@section('content')

<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Remessas
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-tasks" id="remessaTable">
                        <thead>
                            <tr>
                                <th>Exercício</th>
                                <th>Sequencial</th>
                                <th>Data Processamento</th>
                                <th>Quantidade Documentos</th>
                                <th>Situação</th>
                                <th>Visualiza</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remessas as $remessa)
                                <tr data-id="{{ $remessa->id }}" class="remessa-row">
                                    <td data-label={{ __("Exercício") }}>{{ $remessa['exercicio_remessa'] }}</td>
                                    <td data-label={{ __("Sequencial") }}>{{ $remessa['sequencial_remessa'] }}</td>
                                    <td data-label={{ __("Dt Processamento") }}>{{ date('d/m/Y', strtotime($remessa['created_at']) ) }}</td>
                                    <td data-label={{ __("Qtd Docmtos") }}>{{ $remessa['qtd_documentos'] }}</td>
                                    <td data-label={{ __("Situação") }}>{{ $remessa['status'] }}</span></td>
                                    <td data-label={{ __("Ação") }}>
                                        <div class="hidden space-x-8 sm:-my-px sm:ms-5 sm:flex">
                                            <a href="{{ route('logshow', $remessa['id']) }}" class="action-btn edit">Log</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a class="action-btn create" href="{{ route('home') }}">Volta</a>
    </div>

@endsection


