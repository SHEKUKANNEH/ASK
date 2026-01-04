# Sneaker Store

A simple and modern sneaker e-commerce website built with Laravel, featuring user authentication and product browsing.

## Features

- 🏃 Browse 5 different sneaker models
- 👤 User registration and login
- 🔐 Secure authentication with Laravel Fortify
- 📱 Responsive design
- 🎨 Modern UI with Flux components

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm
- SQLite (or MySQL)
- Herd (or any PHP server)

## Installation

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd sneakerapp11
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Build frontend assets**
   ```bash
   npm run build
   ```

5. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed --class=SneakerSeeder
   ```

## Running the Application

If using **Herd**, the application should be automatically available at `http://sneakerapp11.test`

For other servers:
```bash
php artisan serve
```
Then visit `http://localhost:8000`

## Default Login

- **Email:** test@example.com
- **Password:** password

## Project Structure

- **Models:** User, Sneaker, Order
- **Controllers:** SneakerController
- **Views:** `resources/views/sneakers/`
- **Routes:** `routes/web.php`

## Development

For development with hot reload:
```bash
npm run dev
```

## Technologies

- Laravel 12
- Laravel Fortify (Authentication)
- Livewire Flux (UI Components)
- Tailwind CSS
- Vite
- SQLite

## License

MIT

