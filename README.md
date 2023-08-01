# Task Management - Laravel Project

This is a Task Management Laravel project that provides a platform to efficiently manage tasks.

## Directory Structure

- `app`: Contains the core application files, including controllers and models.
- `bootstrap`: Holds the framework bootstrap files.
- `config`: Contains all the configuration files.
- `database`: Contains the migration files and seeders for the database.
- `public`: Contains the front controller and public assets like CSS, JS, and images.
- `resources`: Holds the views and language files.
- `routes`: Contains the route definition files.
- `storage`: Contains the application's cache, logs, and uploaded files.
- `tests`: Holds the application's test cases.
- `vendor`: Contains the Composer dependencies.
- `.env`: Environment configuration file. You'll need to configure this file before running the project.
- `artisan`: Laravel's command-line interface.

## Setup

### Package Command
To set up the project's packages, run the following command:
composer install

This command will execute all the pending database migrations.
### Migrate Command
To set up the project's database, run the following command:
php artisan migrate

This command will execute all the pending database migrations.

### Server Command
To run the Laravel development server, use the following command:
php artisan serve

This will start the server at http://localhost:8000.

### .env Configuration
Before running the project, make sure to set up the `.env` file. Rename the `.env.example` file to `.env` and update the following configurations:

APP_NAME=Task Management
APP_ENV=local
APP_KEY=YOUR_APP_KEY
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=YOUR_DB_HOST
DB_PORT=YOUR_DB_PORT
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USERNAME
DB_PASSWORD=YOUR_DB_PASSWORD


Set the `APP_KEY` to a unique 32-character string. Fill in the database connection details according to your setup. Save the changes and then run the migration command to set up the database.

**Note**: Ensure that your server meets the minimum requirements for running Laravel.

## Credits
This Task Management Laravel project is developed by [Your Name] and licensed under [License Type].

## Video Link
[Watch Demo Video](https://drive.google.com/file/d/1qJWViEAlzaq_oP3OXQj1K9lUQDEXUeOg/view?usp=sharing)
