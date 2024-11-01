@extends('layouts.main')

@section('content')

<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Documentos
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-tasks" id="documentoTable">
                        <thead>
                            <tr>
                                <th>Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentos as $documento)
                                <tr data-id="{{ $documento->id }}" class="remessa-row">
                                    <td data-label={{ __("Documento") }}>{{ $documento['cod_documento'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h2>Dados do Documento:<p id="codigoDaRemessa"></p></h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table  class="table-tasks" id="documentoItensTable">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Conteúdo</th>
                                <th>Visualiza</th>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Quando uma linha de Documento é clicada
            $('#documentoTable').on('click', '.remessa-row', function() {
                // Obter o ID do Documento selecionado
                var docId = $(this).data('id');
                // Fazer a requisição AJAX para buscar os itens da remessa
                $.ajax({
                    url: '/documento/' + docId + '/itens',
                    type: 'GET',
                    success: function(data) {
                        so1vez = true;
                        // Limpar o grid de RemessaItem
                        $('#documentoItensTable tbody').empty();
                        // Iterar sobre os itens retornados e adicioná-los ao grid de RemessaItem
                        data.forEach(function(item) {
                            if (so1vez) {
                                $('#codigoDaRemessa').html('<strong>'+item.documento.cod_documento+'</strong>');
                                so1vez = false;
                            }
                            let conteudo = item.conteudo;
                            let linkViz  = '<td>' +
                                           '<div class="hidden space-x-8 sm:-my-px sm:ms-5 sm:flex">' +
                                           '<a href="/documento/' + item.id + '" class="action-btn edit">Visualiza</a>' +
                                           '</div>' +
                                           '</td>';

                            let row =   '<tr>' +
                                            '<td>' + item.titulo + '</td>' +
                                            '<td>' + conteudo.substring(0,60) + '...</td>' +
                                            linkViz +
                                        '</tr>';
                            $('#documentoItensTable tbody').append(row);
                        });
                    }
                });
            });
        });
    </script>
@endsection
