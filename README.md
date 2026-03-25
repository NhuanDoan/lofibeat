# LofiBeat API

Backend service for managing LoFi / V-Pop songs, built with Laravel.

---

## 1. Overview

LofiBeat provides RESTful APIs for:

- Songs
- Artists
- Categories

Features:

- CRUD operations
- Search & filtering
- Pagination

---

## 2. Tech Stack

- Laravel ^13
- PHP ^8.3
- Laravel Sanctum (API Auth)
- Vite, TailwindCSS, AlpineJS
- SQLite (default), MySQL/PostgreSQL supported

---

## 3. Project Structure

```
app/
  Http/Controllers/Api/
  Models/

database/
  migrations/
  seeders/

routes/
  api.php
```

---

## 4. Requirements

- PHP >= 8.3
- Composer >= 2.x
- Node.js >= 20
- NPM >= 10

---

## 5. Setup

### Quick Setup

```bash
composer setup
composer dev
```

### Manual Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed

npm install
npm run dev

php artisan serve
```

---

## 6. Environment Configuration

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lofibeat_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 7. Authentication

Using Laravel Sanctum.

Protected APIs require:

```
Authorization: Bearer {token}
```

Example:

```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
http://127.0.0.1:8000/api/songs
```

---

## 8. API Base URL

```
http://127.0.0.1:8000/api
```

---

## 9. Endpoints

### Songs

- GET /songs
- POST /songs
- GET /songs/{id}
- PUT /songs/{id}
- DELETE /songs/{id}

### Artists

- GET /artists
- POST /artists
- GET /artists/{id}
- PUT /artists/{id}
- DELETE /artists/{id}

### Categories

- GET /categories
- POST /categories
- GET /categories/{id}
- PUT /categories/{id}
- DELETE /categories/{id}

---

## 10. Query Parameters

### Songs

- `q`: search by title or slug
- `artist_id`
- `category_id`
- `is_active`
- `per_page` (default: 10)
- `page`

---

## 11. Seeding

```bash
php artisan migrate:fresh --seed
```

---

## 12. Development Commands

```bash
php artisan serve
php artisan migrate
php artisan route:list
composer test
./vendor/bin/pint
```

---

## 13. Security

- Do not commit `.env`
- Set `APP_DEBUG=false` in production
- Use HTTPS
- Protect APIs using Sanctum

---

## 14. Troubleshooting

### Reset DB

```bash
php artisan migrate:fresh --seed
```

### Clear cache

```bash
php artisan config:clear
php artisan cache:clear
```

### Fix autoload

```bash
composer dump-autoload
```

---

## 15. Future Improvements

- Swagger / OpenAPI docs
- Postman collection
- CI/CD pipeline
- Role-based authorization