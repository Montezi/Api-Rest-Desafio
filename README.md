# Api-Rest-Desafio

   Este Desafio consistia em construir uma API REST utilizando: 
   * Framework Codeigniter 3 (PHP) e Banco de dados MySQL.
   * Entrada e saída de dados em json
   A API deveria expor endpoints para CRUD de cidade e estado e realizar as operações mínimas (Inserir,Alterar,Excluir,
Listar (incluir ordenação e filtro de busca))   

### Pré requisitos

* PHP 5.4 ou superior
* Apache 2.4
* Banco de dados MySQL

### Instalação

  * Descompacte a pasta api_rest_desafio no diretório do Apache(www/html) 
  *  Crie o banco de dados api_rest e importe e restaure o arquivo api_rest.sql
  * Para editar a conexão do Banco de Dados acesse o arquivo /api_rest_desafio/application/config/database.php e
    edite as seguintes linhas : 
    

```

   'hostname' => '< o ip do seu banco>',
	'username' => ' seu usuario do banco',
	'password' => 'a senha do seu banco de dados',
	'database' => 'api_rest', example

```
  
### Testando a API



 Para acessar a API é necessário efetuar o Login. 
 O header deve ser preenchido com Content-Type = application/json
```
   Login
   [POST] <host>/index.php/ApiRest/login {username:admin, "password" : "Admin123$"} 
   
   O mesmo retornará o token e o id necessários para as demais páginas
   Exemplo :
   {
    "status": 200,
    "message": "Login realizado com sucesso!",
     "id": "1",
     "token": "$1$desafio$n4g1BQ6qNo8KQkvkjEaPG1"
}  
    
```
  Para acessar os demais endpoints será necessário preencher o Header com as seguintes informações:
  Content-Type = application/json
  x-api-key = token
  User-ID = id
  
  
```
Estado
[GET]  <host>/index.php/ApiRest/estados
[GET]  <host>/index.php/ApiRest/estados/:id
[GET]  <host>/index.php/ApiRest/estados?nome=value&abreviacao=value(filtro, podendo ser utilizados outros campos da tabela)
[GET]  <host>/index.php/ApiRest/estados?orderField=campo(ordenação)&sortType=asc(ou desc)
[POST] <host>/index.php/ApiRest/estados {nome:xxxx, abreviacao:xx}
[PUT] <host>/index.php/ApiRest/estados/:id {nome:xxxx, abreviacao:xx}
[DELETE] <host>/index.php/ApiRest/estados/:id 

Cidade
[GET]  <host>/index.php/ApiRest/cidades
[GET]  <host>/index.php/ApiRest/cidades/:id
[GET]  <host>/index.php/ApiRest/cidades?nome=value&abreviacao=value(filtro, podendo ser utilizados outros campos da tabela)
[GET]  <host>/index.php/ApiRest/cidades?orderField=campo(ordenação)&sortType=asc(ou desc)
[POST] <host>/index.php/ApiRest/cidades {nome:xxxx, idestado:1}
[PUT] <host>/index.php/ApiRest/cidades/:id {nome:xxxx, abreviacao:xx}
[DELETE] <host>/index.php/ApiRest/cidades/:id 

Logout
[POST] <host>/index.php/ApiRest/logout
```
 ## Maiores informações 
 Documentação: https://app.swaggerhub.com/apis/Montezi/api_rest_desafio/1.0.0#/


## Licença

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


   


   
   
   
  
