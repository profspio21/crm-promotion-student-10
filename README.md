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

# Setting Up a Task in Windows Task Scheduler

Follow these steps to set up a task in Windows Task Scheduler to run a Laravel schedule:

1. **Open Task Scheduler**
   - Press the Windows key, search for "Task Scheduler," and open it.

2. **Create a New Task**
   - In the Task Scheduler library, right-click and choose "Create Task..." from the context menu or use the Action menu to select "Create Task...".

3. **General Tab**
   - Give your task a name, e.g., "Laravel Schedule Runner".
   - Optionally, provide a description.
   - Choose "Run whether user is logged on or not" if you want it to run in the background, or "Run only when the user is logged on" for testing purposes.
   - Check "Run with highest privileges" for the task to have Administrator permissions, which might be necessary for certain operations.

4. **Triggers Tab**
   - Click "New..." to create a new trigger.
   - Set the task to begin "On a schedule".
   - Choose "Daily" and set it to recur every 1 day.
   - Click on "Repeat task every:" and select "1 minute" from the dropdown, for a duration of "Indefinitely".
   - Ensure "Enabled" is checked at the bottom of the window.
   - Click "OK" to save the trigger.

5. **Actions Tab**
   - Click "New..." to create a new action.
   - Set "Action" to "Start a program".
   - In "Program/script", enter the path to your PHP executable, e.g., `C:\php\php.exe`.
   - In "Add arguments (optional)", enter `artisan schedule:run`.
   - In "Start in (optional)", enter the full path to your Laravel project's root directory (where the artisan file is located), e.g., `C:\path\to\your\project`.
   - Click "OK" to save the action.

6. **Conditions and Settings Tabs**
   - Review these tabs for additional settings that might be useful for your specific setup, such as running the task only if the computer is idle, on AC power, etc.
   - Under Settings, you might want to ensure "Stop the task if it runs longer than:" is set to a suitable value, like "1 hour", to prevent a stuck task from running indefinitely.

7. **Save the Task**
   - Enter the password for your user account if prompted (required if you selected "Run whether user is logged on or not").
   - Click "OK" to save the task.
