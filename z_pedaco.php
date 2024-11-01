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
                        const url = "/remessas";
                        $(location).attr('href',url);
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




<thead>
                            <tr>
                                <th>Documento</th>
                                <th>Título</th>
                                <th>Conteúdo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Itens de Remessa serão carregados aqui via AJAX -->
                        </tbody>
