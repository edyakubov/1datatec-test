<p align="center">Test Task</p>
<a href="https://docs.google.com/document/u/0/d/1eAwb3kqRVEuvwDfxUiQdgnTnUIqAz6VcrtTudZx_gFU/mobilebasic">link on task</a>

It is a default laravel 11 application.
Make sure you have configured you local environment with installed PHP 8.3, composer v2

## Installation

### Install dependencies

```bash
composer install
```

### Create env file

```bash
scp .env.example .env
```

### Generate Application key

```bash
php artisan key:generate
```

### Fill the configuration

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-test
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=sync

```

### Run the migrates

```bash
php artisan migrate
```

### Run the tests

```bash
php artisan test
```

### Run the server

```bash
php artisan serve
```

Test the endpoints with Postman or any other tool.
curl example:

```bash
curl -X POST http://127.0.0.1:8000/api/submit \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "email": "johnDoe@data.inc", "message": "Hi there!"}'
```
