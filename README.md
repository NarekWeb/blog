# API

-   [Technical requirements](#technical-requirements)
-   [Installation](#installation)
-   [CI/CD](#cicd)
-   [HTTP](#http)
-   [Testing](#testing)
    -   [Testing prerequisites](#testing-prerequisites)
-   [Zen](#zen)
-   [Todo](#todo)

### Technical requirements

-   [nginx ^1.19](https://www.nginx.com/) + [php-fpm (^8.1)](https://www.php.net/manual/ru/install.fpm.php)
-   [php-cli ^8.1](https://www.php.net/manual/en/install.php)
-   [composer ^2](https://getcomposer.org/)
-   [postgres ^13.1](https://www.postgresql.org/download/)

For composer platform requirements run `composer check-platform-reqs` command.

## Installation

-   Run `composer install` command.
-   Setup [Application environment](#application-environment).
-   Setup [Admin Configurations](#admin-configurations).
-   Run `php artisan app:install` command.

**IMPORTANT!** The `php artisan app:install` command is designed only for initial project installation. It drops and rebuilds the database schema, configurations and application cache.

### Installation prerequisites

-   [Database configuration](https://laravel.com/docs/9.x/database#configuration)
-   [Cache configuration](https://laravel.com/docs/9.x/cache#configuration)
-   [Mail configuration](https://laravel.com/docs/9.x/mail#configuration)
-   [Queue driver prerequisites](https://laravel.com/docs/9.x/queues#driver-prerequisites)
-   [Filesystem configuration](https://laravel.com/docs/9.x/filesystem#configuration)

### Application environment

Copy `.env.example` file to `.env` in the root folder, see [Laravel Environment Configuration Documentation](https://laravel.com/docs/9.x/configuration#environment-configuration) for more detailed information.

### Admin Configurations

Super Admin configurations are used to seed `ADMIN` user **once** during application installation.
Setup following configurations in the [Application environment configurations](https://laravel.com/docs/9.x/configuration#environment-configuration):

| Key                        |
| -------------------------- |
| **ADMIN_INITIAL_EMAIL**    |
| **ADMIN_INITIAL_PASSWORD** |

## CI/CD

### Production workflow

-   Run `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev` command.
-   Run `php artisan app:ci -p` command.

## HTTP

See the latest **API DOCUMENTATION** using `/docs` uri.

## Testing

-   Run `composer test` command.

### Testing prerequisites

-   [Project dependencies installed](#installation)
-   [Database connection](https://laravel.com/docs/9.x/database)

### Manual setup

-   Copy `.env.testing.example` to `.env.testing` in project root directory.
-   Setup [Database connection configuration](https://laravel.com/docs/9.x/database#configuration)

## Zen

-   Explicit is better than implicit!
-   Simple is better than complex!
-   Complex is better than complicated!
-   Flat is better than nested!
-   Immutable is better than mutable!
-   `CQRS` is better than mess!
-   Low cohesion and high coupling! Not opposite!
-   Active record is better Repository & Entity over Active record!
-   Repository & Entity is better than Active record!
-   Events are better than direct calls!
-   `ACID` is better than `BASE`!
-   `Partition tolerance` is prior over `Consistency` and `Availability`!
-   Idempotency for scalability!
