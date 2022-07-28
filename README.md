# iQanat School

Админ панель и api iQanat School

Используемый стек:
- PHP 8.1
- Laravel 9
- Starter Kit 4.0
- i18n exporter
- PostgreSQL 12

## Installation

1. `git clone git@gitlab.ibecsystems.kz:iqanat/iqanat-backend.git && cd iqanat-backend`
2. `composer install`
3. `php artisan migrate`
4. `php artisan core:create-roles-and-permissions --tty`
5. `php artisan core:add-super-user`

## Usage

Админка доступна по ссылке [/iqanatcp](http://localhost:8001/iqanatcp)

## Development

Для разработки используйте кастомную команду: 
```shell
php artisan s
```
то же самое, что и `php artisan serve --port=8001`

## API docs

Документация для API находится в файле `./openapi.yml`, что посмотреть, можно:
- открыть этот файл в [гитлабе](https://gitlab.ibecsystems.kz/iqanat/iqanat-backend/-/blob/master/openapi.yaml)
- скопировать и вставить в [Swagger Editor](https://editor.swagger.io)
- скопировать и вставить в Postman API
