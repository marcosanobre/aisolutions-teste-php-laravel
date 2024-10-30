@extends('layouts.main')

@section('content')

<div class="container">
    <h2>Remessas</h2>
    <table class="table table-bordered" id="remessaTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Exercício</th>
                <th>Sequencial</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($remessas as $remessa)
            <tr data-id="{{ $remessa->id }}" class="remessa-row">
                <td>{{ $remessa->id }}</td>
                <td>{{ $remessa->exercicio_remessa }}</td>
                <td>{{ $remessa->sequencial_remessa }}</td>
                <td>{{ $remessa->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Itens da Remessa Selecionada</h2>
    <table class="table table-bordered" id="remessaItensTable">
        <thead>
            <tr>
                <th>ID</th>
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
                            '<td>' + item.id + '</td>' +
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
