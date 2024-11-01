![Logo AI Solutions](http://aisolutions.tec.br/wp-content/uploads/sites/2/2019/04/logo.png)

# AI Solutions

## Implementação do Projeto segundo análise de Marcos Aurélio Nobre

### Descrição da implementação

Esta implementação utiliza: Laravel 10, Php 8.2 e SQlite-3

O projeto objetiva a formação de uma base de dados de Documentos, que são
adicionados por meio do processamento de importação de Remessas (lotes) de documentos,
em arquivos JSON.

As remessas podem conter documentos em Remessa (integral) ou Remessa Parcial. Uma
remessa é identificada unicamente, por ano_exercicio e um sequencial_exercicio. Esta
chave impede a re-importação de uma remessa.

Cada Documento contido numa remessa, detem um COD_DOCUMENTO que é único na base de dados.

Após a importação, uma remessa pode ser encontrar nos seguintes estados :
1. Processada
2. A Processar
3. Com Problemas

O fluxo operacional do sistema é dado por :
1. -> Remessas -> Importar Remessa - na importação a Remessa e seus Documentos são validados segundos as regras***
2. -> Processar -> Encaminhar Remessas válidas / sem Problemas, para a FILA DE PROCESSAMENTO
3. -> Fila de Tarefas -> Processar a Remessa para a atualização da base de dados de Documentos
4. -> Documentos -> Navegar na base de Documentos
5. -> Logs de Processamento -> Navegar nos Logs de processamento das Remessas


### Descrição Técnica:

O Projeto implementa 04 processos :
1. Remessas
2. Tarefas
3. Documentos
4. Logs

No modelo de dados do Projeto encontram-se o seguintes objetos :
. Categoria
. Remessa / RemessaItem
. Tarefa
. Documento / DocumentoItem
. Log de Remessa é uma "visão"

### Descrição Técnica Operacional:

Para executar o sistema é necessário a execução dos seguintes passos (no terminal):
1. #>git clone https://github.com/marcosanobre/aisolutions-teste-php-laravel.git
2. #>cd aisolutions-teste-php-laravel
3. #>composer install
4. #>npm install jquery
5. #>npm run build
6. #>php artisan migrate:fresh
7. #>php artisan db:seed --class=CategoriaSeeder
8. #>php artisan serve
9. #> no chrome ou firefox : [ http://127.0.0.1:8000 ]


### REGRAS de validação (implementadas na importação-de-remessa):

1. Um arquivo de remessa (json) pode ter no máximo 10240 bytes de tamanho
2. O campo CONTEUDO de um Documento pode ter no máximo 2048 bytes de tamnho
3. Se a CATEGORIA do Documento for "Remessa" o campo PERIODO_DE_REFERENCIA deve conter a palavra "semestre", caso contrário um erro de registro inválido será gerado no LOG do documento.
4. Se a CATEGORIA do Documento for "Remessa Parcial", o campo PERIODO_DE_REFERENCIA deve conter o nome de um mês(Janeiro, Fevereiro, etc), caso contrário um erro de registro inválido será gerado no LOG do documento.

