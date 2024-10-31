@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datagrid.css') }}">
@endsection

@section('content')

<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Remessas
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a class="action-btn create" href="{{ route('filatarefa.create') }}">Importação</a>
                    <table class="table-tasks">
                        <thead>
                            <tr>
                                <th>Exercício</th>
                                <th>Sequencial</th>
                                <th>Data Processamento</th>
                                <th>Quantidade Documentos</th>
                                <th>Situação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remessas as $remessa)
                                <tr data-id="{{ $remessa->id }}" class="remessa-row" onclick="window.location='/importacao'">
                                    <td data-label={{ __("Exercício") }}>{{ $remessa['exercicio_remessa'] }}</td>
                                    <td data-label={{ __("Sequencial") }}>{{ $remessa['sequencial_remessa'] }}</td>
                                    <td data-label={{ __("Dt Processamento") }}>{{ date('d/m/Y', strtotime($remessa['created_at']) ) }}</td>
                                    <td data-label={{ __("Qtd Docmtos") }}>{{ $remessa['qtd_documentos'] }}</td>
                                    <td data-label={{ __("Situação") }}>{{ $remessa['status'] }}</span></td>
                                    <td data-label={{ __("Ação") }}>
                                        <div class="hidden space-x-8 sm:-my-px sm:ms-5 sm:flex">
                                            @if ($remessa['status'] == 'Registrado')
                                                <a href="{{ route('filatarefa.insereTarefa', $remessa['id']) }}" class="action-btn edit">Processa</a -->                                            
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

    <h2>Itens da Remessa Selecionada</h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table  class="table-tasks" id="remessaItensTable">
                        <thead>
                            <tr>
                                <th>Remessa</th>
                                <th>Categoria</th>
                                <th>Período de Referência</th>
                                <th>Código Documento</th>
                                <th>Título</th>
                                <th>Conteúdo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Itens de Remessa serão carregados aqui via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a class="action-btn create" href="{{ route('home') }}">Volta</a>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Quando uma linha da Remessa é clicada
            $('#remessaTable').on('click', '.remessa-row', function() {
                // Obter o ID da remessa selecionada
                var remessaId = $(this).data('id');

                // Fazer a requisição AJAX para buscar os itens da remessa
                $.ajax({
                    url: '/remessas/' + remessaId + '/itens',
                    type: 'GET',
                    success: function(data) {
                        // Limpar o grid de RemessaItem
                        $('#remessaItensTable tbody').empty();

                        // Iterar sobre os itens retornados e adicioná-los ao grid de RemessaItem
                        data.forEach(function(item) {
                            var row = '<tr>' +
                                '<td>' + item.remessa_id + '</td>' +
                                '<td>' + item.categoria_id + '</td>' +
                                '<td>' + item.periodo_referencia + '</td>' +
                                '<td>' + item.cod_documento + '</td>' +
                                '<td>' + item.titulo + '</td>' +
                                '<td>' + item.conteudo + '</td>' +
                                '</tr>';
                            $('#remessaItensTable tbody').append(row);
                        });
                    }
                });
            });
        });
    </script>
@endsection
