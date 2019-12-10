 Agenda Rest Api - Laravel Framework
=============

Aplicação composta por módulo de agenda (CRUD), com registros das atividades dos usuários.


Instale as dependências do projeto
-----------

```
npm install
```

Gere o autoload via composer
-----------

```
composer dump-autoload
```

Crie as tabelas no banco de dados
-----------

```
php artisan migrate
```

Registre alguns Usuários e Status no banco de dados
-----

```
php artisan db:seed
```

Inicie um servidor de desenvolvimento
-----------

```
php artisan serve
```

Configure o nome do banco de dados para rodar os Testes da aplicação em:
-----------

```
phpunit.xml
```
```
<server name="DB_DATABASE" value="db_name"/>
```

Execute os testes automatizados:
-----------

```
vendor/bin/phpunit
```

Documentação da API
------------

Disponível em [Documentação](https://documenter.getpostman.com/view/1615734/SWE56dw6?version=latest).
