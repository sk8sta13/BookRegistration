# BookRegistration
Segundo sistema de gerenciamento de livraria.

## Descrição

Este projeto é um gerenciamento simples de uma livraria com cadastro de autores, assuntos e livros.

A persistência dos dados é feita utilizando **MySQL**.

## Como Configurar

1. Clone o repositório entre na pasta e execute os containers:

   ```bash
   git clone git@github.com:sk8sta13/BookRegistration.git
   cd BookRegistration/
   docker compose up -d
   ```
2. Entre no container br-fpm para instalar o laravel:

  ```bash
   docker exec -ti br-fpm bash
   cd app
   composer install
   ```

3. Edite o .env com os dado de conexão com o banco e execute o migrate para criação das tabelas:

   ```bash
   DB_CONNECTION=mysql
   DB_HOST=br-database
   DB_PORT=3306
   DB_DATABASE=bookesbookstore
   DB_USERNAME=root
   DB_PASSWORD=101010
   ```  
_A ideia é só editar os dados do banco, as demais configs não_

   ```bash
   php artisan migrate
   ```

3. Só acessar o sistema no navegardo pelo "http://localhost"
