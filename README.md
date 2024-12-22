# Task Management System

## Project Description
The Task Management System is a web application that allows users to manage their tasks efficiently. It includes features for user authentication, task creation, updating, deletion, and filtering. Users can filter tasks by status (e.g., Pending, In Progress, Completed) and sort them by due date.

## Features
- **Register, Login, and Logout**
- **Create, Read, Update, and Delete tasks**
- **Filter tasks by status (Pending, In Progress, Completed)**
- **Sort tasks by due date**
- **Fully functional UI optimized for desktop**


## Tech Stack
- **PHP**: 8.2
- **Backend Framework**: Laravel 10x
- **Frontend**: Blade templates (or Javascript/jQuery if applicable)
- **Database**: MySQL
- **Authentication**: Laravel UI Auth
- **Deployment**: Localhost or any hosting platform supporting PHP and Laravel

## Installation Instructions
1. Clone the repository:

   ```bash
    git clone https://github.com/sujonmia019/Task-Management-System.git

2. Navigate to the project directory

    ```bash
    cd Task-Management-System

3. Install dependencies using Composer

    ```bash
    composer install

4. Copy the .env.example file to .env

    ```bash
    cp .env.example .env

5. Generate the application key

    ```bash
    php artisan key:generate

6. Set up your database connection in the .env file

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

7. Generate the application key

    ```bash
    php artisan migrate

8. Start the development server

    ```bash
    php artisan migrate







