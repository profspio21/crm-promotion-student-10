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


## Installation

To get started with the project, follow these steps:

Clone the repository:
    git clone https://github.com/profspio21/crm-promotion-student-10.git

Navigate into the project directory:
    cd crm-promotion-student-10

Install dependencies using Composer:
    composer install

Renave .env.example to .env :
    mv .env.example .env

Generate keygen :
    php artisan key:gen

By default laravel menggunakan email untuk autentikasi login.
Untuk mengubah parameter email menjadi username, lakukan langkah berikut : 
    1.  Buka folder vendor/laravel/ui/auth-backend/AuthenticateUsers
    2.  Ubah parameter username()
        public function username()
        {
            return 'username';
        }

Setup env (.env)
Database :
    DB_CONNECTION=mysql
    DB_HOST=your_host
    DB_PORT=your_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    
Email :
    MAIL_MAILER=smtp
    MAIL_HOST=your_email_host
    MAIL_PORT=465
    MAIL_USERNAME=your_email_username
    MAIL_PASSWORD=your_email_password
    MAIL_FROM_ADDRESS=your_email
    MAIL_FROM_NAME="${APP_NAME}"

Run migration only :
    php artisan migrate

Run seeder database
    php artisan db:seed

To run server :
    php artisan serve

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
