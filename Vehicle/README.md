# MyVehicle Laravel Project

## Project Overview
MyVehicle is a Laravel-based web application designed to manage vehicle-related data efficiently. This project provides features for vehicle registration, user authentication, and administrative management through a clean and intuitive interface.

## Features
- User registration and authentication
- Vehicle management (create, read, update, delete)
- Admin dashboard for managing users and vehicles
- Responsive UI with Blade templates
- Image upload and management for vehicles

## Requirements
- PHP >= 8.0
- Composer
- Node.js and npm
- MySQL or compatible database
- Laravel 10.x

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd Vehicle
   ```

2. Install PHP dependencies using Composer:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Copy the example environment file and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Configure your database settings in the `.env` file.

7. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

8. Build frontend assets:
   ```bash
   npm run build
   ```

## Usage

- Start the development server:
  ```bash
  php artisan serve
  ```

- Access the application at `http://localhost:8000`

## Testing

- Run PHPUnit tests:
  ```bash
  php artisan test
  ```

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for review.

## License

This project is open-source and available under the MIT License.
