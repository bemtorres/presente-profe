# 🚀 PRESENTE PROFE 🚀

<center>
<img src="public/app/img/comparte-logo2.svg" width="100px">
</center>

https://chromewebstore.google.com/detail/presente-profe/cdlobfdkmnceddliohfkoiijnifbebgm?hl=es

## Descripción

La extension que a todo profe le gustaría tener para pasar la lista de clase de forma didactica y entretenida

El problema de pasar la asistencia en clases es ir gritando el nombre y apellido de cada alumnos. Esta extensión facilita de forma visual una tarjeta dinamica del nombre de cada uno de los alumnos. Moviendose con las flechas puedes pasar la asistencia de manera rapida y agil. 

En la actualización v1.2 agregamos audio para hacer esta tarea mas fácil!!!!

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
