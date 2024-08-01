# PlaceHub API

PlaceHub API é um projeto simples construído com Laravel para gerenciar lugares.

## Especificações

- Laravel 10
- PHP 8.2
- PostgreSQL 16

## Configurações Iniciais

1. **Clone o repositório:**
   ```sh
   git clone https://github.com/sarev17/placehub-api.git

2. **Instale as dependências com Composer:**
   ```sh
   composer install

3. **Atualize o arquivo .env:**
    Configure as variáveis de ambiente para o seu banco de dados PostgreSQL e outras configurações necessárias.
    Exemplos de variáveis de ambiente para o banco de dados:
    ```sh
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=placehub
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha

4. **Verifique a conexão com o banco de dados:**
    Certifique-se de que o serviço do PostgreSQL está em execução e que as credenciais no arquivo .env estão corretas.

5. **Inicialize o banco de dados:**
    Crie o banco de dados:
    ```sh
    php artisan db:create

6. **Execute as migrações:**
    Para criar as tabelas no banco de dados:
    ```sh
    php artisan migrate


7. **Executando a Aplicação**
    Para iniciar o servidor de desenvolvimento do Laravel, utilize o comando:
    ```sh
    php artisan serve
    Acesse a aplicação em http://localhost:8000.

:⚠ Ao enviar a solicitação, certifique-se de que o cabeçalho Accept: application/json está presente. 
 
 ## Testanto a API
 Para testar a API, você pode utilizar ferramentas como Postman ou cURL, porém a aplicação disponibiliza uma interface no próprio navegador usando swagger.
 Para isso acesse ``http://localhost:8000/api/documentation``

 <img src="https://github.com/sarev17/placehub-api/blob/main/public/images/Captura%20de%20tela%202024-08-01%20000841.png"></img>

 
