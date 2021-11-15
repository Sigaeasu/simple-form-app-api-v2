# simple-form-app-api-v2

## Project setup
```
composer install
cp .env.example .env
php artisan key:generate
```

Create Database : dummy_db

## Database setup
```
php artisan migrate:fresh --seed
```

### Compiles and hot-reloads for development
```
php -S localhost:8000
```
