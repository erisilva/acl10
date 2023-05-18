## ACL10 - Access Control System

This project in Laravel 10 implements an ACL system. An access control list (ACL) contains rules that grant or deny access to certain digital environments.

Each role in the system has a customizable set of permissions. A role can be assigned to one or more users. A user can have multiple roles.

## Built With

- [Laravel 10.x](https://laravel.com/docs/10.x)
- [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)

## Prerequisites

The requirements to run this system can be found at the link: [documentação oficial do laravel](https://laravel.com/docs/10.x):

- Laravel 10.x requires a minimum PHP version of 8.1
- Enable extension=gd extension in php.ini (for captcha)
- Enable extension=zip extension in php.ini (for captcha)

## Dependencies

- [Captcha for Laravel](https://github.com/mewebstudio/captcha), Note: Enable extension=gd extension in php.ini
- [Laravel DomPdf](https://github.com/barryvdh/laravel-dompdf)
- [laravel excel export lib](https://laravel-excel.com/)
- [typeahead](https://github.com/corejavascript/typeahead.js) Component jquery for creating autocomplete field. (Not used in this version)
- [bootstrap-datepicker](https://github.com/uxsolutions/bootstrap-datepicker)
- [Inputmask](https://github.com/RobinHerbots/Inputmask) 
- [Bootstrap Multiselect](https://github.com/davidstutz/bootstrap-multiselect)
- I use the themes of the site: [Bootswatch](https://bootswatch.com/)

## Installation

### Clone the repository

```
git clone https://github.com/erisilva/acl80.git
```

Use composer to install project dependencies:

```
composer update
```

### Create the database

This configuration shown below uses MySQL as the database. This configuration is for a development environment, therefore not recommended for production.

```
CREATE DATABASE nome_do_banco_de_dados CHARACTER SET utf8 COLLATE utf8_general_ci;
```

### Configure the environment

Create the settings .env file:

```
php -r "copy('.env.example', '.env');"
```

Edit the .env file in the root folder of the project with the database configuration data. More info in [documentação oficial do laravel](https://laravel.com/docs/10.x/configuration#environment-configuration):
    
```
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### Generate the application key

```
php artisan key:generate
```
### Configure the storage if necessary

```
php artisan storage:link
```

### Migration

Executar a migração das tabelas com o comando seed:

```
php artisan migrate --seed
```

### Language

The default language is Brazilian Portuguese. To change the language, edit the file config/app.php:

```
'locale' => 'en',
```

## Usage

To run the system, use the command:

```
php artisan serve
```

### Users

Login: adm@mail.com 
Login: gerente@mail.com 
Login: operador@mail.com
Login: leitor@mail.com

Note: The password for all users is 123456. By default, the migration generates users with names in Brazilian Portuguese.

## Contact

- E-mail: erivelton.silva@proton.me
- Discord: gixeph#0658

## Licenças

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details, except for the libraries used.

## Acknowledgments

- [Laravel](https://laravel.com/)
