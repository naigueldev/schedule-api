 Schedule Rest Api - Laravel Framework
=============

Aplicação composta por módulo de agenda (CRUD), com registros das atividades do usuário.


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

Rodando o projeto
-----

Registre os Status disponíveis com o comando:

```
php artisan db:seed
```

Inicie um servidor de desenvolvimento em http: // localhost: 8000
-----------

```
php artisan serve
```

Execute os testes automatizados
-----------

```
vendor/bin/phpunit
```

Documentação da API
------------

Disponível em [Documentação](https://documenter.getpostman.com/view/1615734/SWE56dw6?version=latest).
