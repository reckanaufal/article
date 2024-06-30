# Framework-Laravel

## Installation

To run this project locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/reckanaufal/article.git
   cd article
Install dependencies using Composer:

composer install
Copy .env.example to .env and configure your database:


cp .env.example .env
Edit .env and set your database credentials:


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
Generate application key:

php artisan key:generate

php artisan migrate --seed
Start the development server:

php artisan serve
Access the application in your browser at http://localhost:8000.