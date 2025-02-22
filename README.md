# Laravel Books API

## Requirements
- Docker & Docker Compose
- PHP 8.2+
- MySQL 8.0+
- Composer

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/your-repo/books-api.git
   cd books-api
   ```

2. Copy the environment configuration:
   ```sh
   cp .env.example .env
   ```
   Update `.env` with your database settings if needed.

3. Start the application using Docker:
   ```sh
   docker-compose up -d --build
   ```

4. Run migrations and seed the database:
   ```sh
   docker exec -it laravel_app php artisan migrate --seed
   ```

5. Generate the application key:
   ```sh
   docker exec -it laravel_app php artisan key:generate
   ```

## API Documentation
The full API documentation is available at:
```
http://localhost/api/documentation
```

## Logs
To view logs, use:
```sh
docker logs laravel_app -f
```
Or inside the container:
```sh
docker exec -it laravel_app tail -f storage/logs/laravel.log
```

## Stopping the Application
To stop and remove the containers, run:
```sh
docker-compose down
```

