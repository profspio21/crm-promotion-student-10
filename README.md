<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About PMB-Notification

Aplikasi ini bertujuan sebagai pusat informasi PMB UKDW

- Informasi Seleksi
- Informasi Kegiatan
- Pengelolaan Expo
- Pengelolaan Calon Mahasiswa Baru
- Reporting
- Grafik dashboard

## Requirement
- PHP 8.1 or above
- Composer 2

## Installation

To get started with the project, follow these steps:

1. Clone the repository:

    ```sh
    git clone https://github.com/profspio21/crm-promotion-student-10.git
    ```

2. Navigate into the project directory:

    ```sh
    cd crm-promotion-student-10
    ```

3. Install dependencies using Composer:

    ```sh
    composer install
    ```

4. Rename `.env.example` to `.env`:

    ```sh
    mv .env.example .env
    ```

5. Generate application key:

    ```sh
    php artisan key:generate
    ```

By default, Laravel uses email for login authentication. To change the parameter to use a username, follow these steps:

1. Open the file `vendor/laravel/ui/auth-backend/AuthenticateUsers`.

2. Change the `username()` method:

    ```php
    public function username()
    {
        return 'username';
    }
    ```

Setup env (.env)

1. Database:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=your_host
    DB_PORT=your_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```
    
2. Email :

    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=your_email_host
    MAIL_PORT=465
    MAIL_USERNAME=your_email_username
    MAIL_PASSWORD=your_email_password
    MAIL_FROM_ADDRESS=your_email
    MAIL_FROM_NAME="${APP_NAME}"
    ```

## Migration and seeding database

1. Run migration :

    ```php
    php artisan migrate
    ```

2. Run seeder database :

    ```php
    php artisan db:seed
    ```

3. To run server :

    ```php
    php artisan serve
    ```

## Thanks to
- [Laravel 10](https://laravel.com/docs/11.x)
- UI [Admin LTE v3](https://adminlte.io/docs/3.0/index.html)
    
## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
