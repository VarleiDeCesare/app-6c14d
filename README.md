## Instruções e dados da aplicação

- Técnologias utilizadas
    - Laravel Framework 8.75.0
    - PHP 7.4
    - MySQL 5.7


### Instruções para a utilização da aplicação:

- Subir a aplicação do Mysql com o docker rodando o seguinte comando no terminal -> "docker-compose up"
    - A aplicação do banco de dados irá ser rodado na porta 3038 localmente, para que não haja interferência na mesma porta do MySQL instalado na máquina que costuma ser a 3036.
    - As credências para acesso podem ser alteradas no arquivo docker-compose.yml, por hora tanto o user como password estão setadas como "root"
    - Existe uma pasta chamada "db" na raiz do projeto na qual contém os dados para a aplicação do container do MySQL.

- O servidor local utilizado para a criação da aplicação foi o Laragon, com isso os EndPoints atendem com o nomedapasta.test/api/endpoint (caso o servidor local for outro, utilizar o mapeamento de acordo com a aplicação), também pode-se subir a aplicação com o servidor do laravel utilizando o seguinte comando no terminal "php artisan serve" 

###EndPoints:
- /products
    - Método POST, para a criação de um novo produto, passando no corpo da requisição o nome e a quantidade com as seguintes respectivas nomemclaturas "name" e "quantity".
    - Método PUT, para a movimentação de um produto, passando na URL o sku de um produto, e no corpo da requisição passando a quantidade e a operação que deseja fazer, (remove) para retirar, ou "add" para adicionar a quantia, dados passados via json com as nomenclaturas "quantity" e "operation".
- /movimentations
    - Método GET, para retornar um array com todas as movimentações cadastradas no banco de dados.
