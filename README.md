# 🚀 Comparte DUOC 🚀

<center>
<img src="public/app/img/comparte-logo2.svg" width="100px">
</center>

## Descripción

Plataforma de registro de tomas de salas en horarios disponibles

## Requisitos

- PHP 8>
- MySQL

## Tecnologías

- [Bootstrap 5.3](https://getbootstrap.com/docs/5.1/getting-started/introduction/)
- [VUE 3](https://v3.vuejs.org/guide/introduction.html)

## start project 🚀

in your terminal run:

```shell
git clone https://github.com/CITTSJ/comparte-duoc comparte

cd comparte

composer install

npm install

npm run build

php artisan storage:link

```
### create database

In the file .env.example change the name to .env and change the following lines:

```shell
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=planificador
  DB_USERNAME=root
  DB_PASSWORD=
```
once the changes are made, run the following command:

```shell
php artisan migrate
```

if you reinstall the database, run the following command: 😄

```shell
php artisan migrate:fresh
```

### Others

 * CoreUI - HTML, CSS, and JavaScript UI Components Library
 * @version v4.2.6
 * @link https://coreui.io/
 * Copyright (c) 2022 creativeLabs Łukasz Holeczek
 * License MIT  (https://coreui.io/license/)

## License
MIT License (MIT). Please see [License File](LICENSE.md) for more information.
