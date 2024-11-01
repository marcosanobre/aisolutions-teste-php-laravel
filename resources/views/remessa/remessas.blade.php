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
                    <div class="upload-section">
                        <input type="file" id="jsonFile" accept=".json">
                        <button id="uploadBtn" class="action-btn create">Importa Remessa</button>
                    </div>

                    <table class="table-tasks" id="remessaTable">
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
                                <tr data-id="{{ $remessa->id }}" class="remessa-row">
                                    <td data-label={{ __("Exercício") }}>{{ $remessa['exercicio_remessa'] }}</td>
                                    <td data-label={{ __("Sequencial") }}>{{ $remessa['sequencial_remessa'] }}</td>
                                    <td data-label={{ __("Dt Processamento") }}>{{ date('d/m/Y', strtotime($remessa['created_at']) ) }}</td>
                                    <td data-label={{ __("Qtd Docmtos") }}>{{ $remessa['qtd_documentos'] }}</td>
                                    <td data-label={{ __("Situação") }}>{{ $remessa['status'] }}</span></td>
                                    <td data-label={{ __("Ação") }}>
                                        <div class="hidden space-x-8 sm:-my-px sm:ms-5 sm:flex">
                                            @if ($remessa['status'] == 'Registrada')
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                '<td>' + (item.categoria_id ? item.categoria.nome : 'N/A') + '</td>' +
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
    <script>
        $(document).ready(function() {
            $('#uploadBtn').on('click', function(e) {
                e.preventDefault();

                var fileInput = $('#jsonFile')[0];
                if (fileInput.files.length === 0) {
                    alert('Selecione um arquivo JSON para fazer upload.');
                    return;
                }

                var file = fileInput.files[0];
                var formData = new FormData();
                formData.append('jsonFile', file);

                // Envie o arquivo JSON para o backend
                $.ajax({
                    url: '/upload-remessa-json', // Defina a rota para o controlador de upload
                    type: 'POST',
                    data: formData,
                    processData: false, // impede que o jQuery processe os dados
                    contentType: false, // impede que o jQuery defina o cabeçalho Content-Type
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // token CSRF para segurança
                    },
                    success: function(response) {
                        // alert('Arquivo JSON enviado com sucesso!');
                        // Aqui você pode processar o JSON ou chamar uma função para usar o JSON em requisições
                        processRemessaData(response.data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro no upload do JSON:', error);
                    }
                });
            });
        });
    </script>
    <script>
        function processRemessaData(data) {
            // Primeiro, crie a Remessa
            $.ajax({
                url: '/remessa', // Rota para o método create da Remessa
                type: 'POST',
                data: {
                    exercicio_remessa: data.exercicio,
                    sequencial_remessa: data.sequencia,
                    qtd_documentos: '0',
                    status: 'Registrada',
                    log: 'Remessa: ' + data.exercicio.toString() + ' / ' + data.sequencia.toString(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(remessaResponse) {
                    var remessaId = remessaResponse.id;
                    // Agora, crie os itens de Remessa usando o ID retornado
                    data.documentos.forEach(function(item) {
                        $.ajax({
                            url: '/remessa/' + remessaId + '/item',
                            type: 'POST',
                            data: {
                                remessa_id: remessaId,
                                categoria: item.categoria,
                                periodo_referencia: item.periodo_referencia,
                                cod_documento: item.cod_documento,
                                titulo: item.titulo,
                                conteudo: item.conteudo,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(itemResponse) {
                                console.log('Item criado:', itemResponse);
                            },
                            error: function(xhr, status, error) {
                                console.error('Erro ao criar item:', error);
                            }
                        });
                    });
                },
                error: function(xhr, status, error) {
                    reme = data.exercicio + ' | ' + data.sequencia;
                    msg  = 'Remessa: ' + reme + ' já existente !!!'
                    alert(msg);
                    //console.error('Erro ao criar Remessa:', error);
                }
            });
        }
    </script>
@endsection
