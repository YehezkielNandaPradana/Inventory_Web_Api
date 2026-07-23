<div align="center">

# Stokku — Inventory Management System

[![Laravel](https://img.shields.io/badge/Laravel-13.x-red?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Pest](https://img.shields.io/badge/Pest-4-CB3F3F?logo=pest&logoColor=white)](https://pestphp.com)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

A comprehensive inventory management system with **REST API** backend for mobile apps and a **web admin dashboard**.

</div>

---

## Overview

Stokku is a dual-interface inventory management application built with Laravel 13. It provides a **JSON REST API** for Flutter (or any mobile/client app) and a **Blade + Tailwind CSS** web dashboard for administrators.

### Core Features (Implemented)

- **Barang (Items)** — Full CRUD with stock tracking, minimum stock alerts, soft deletes, and image upload
- **Kategori (Categories)** — Organize items by category with per-category stock status breakdown
- **Stok Movement** — Record stock-in (`masuk`) and stock-out (`keluar`) transactions with automatic quantity updates
- **Stock Status** — Automatic status calculation: *Aman* (Safe), *Menipis* (Low), *Habis* (Empty)
- **Dashboard** — Real-time overview with total items, categories, stock value, and low-stock warnings
- **REST API** — 17 endpoints covering all core CRUD and stock history operations
- **Web Admin** — Session-based dashboard with full CRUD management

### Planned Features (Scaffolded)

The following modules have been scaffolded with models, migrations, controllers, views, and tests ready for implementation:

| Module | Description |
|--------|-------------|
| Barang Masuk | Incoming goods receipt |
| Barang Keluar | Outgoing goods dispatch |
| Barang Rusak | Damaged goods / write-off |
| Peminjaman & Pengembalian | Item borrowing and return |
| Supplier & Merk | Vendor and brand management |
| Lokasi | Warehouse/storage locations (building, room, rack) |
| Purchase Request & Order | Procurement lifecycle |
| Invoice | Billing and invoicing |
| Stock Opname | Physical stock counting |
| Maintenance | Equipment maintenance scheduling |
| Notifikasi | In-app notifications |
| Role & Permission | Role-based access control |
| Audit Log | Activity trail |
| User Management | User account management |
| Laporan | Reporting and analytics |

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Framework** | Laravel 13.x |
| **Language** | PHP 8.3 |
| **Database** | MySQL / SQLite |
| **Frontend** | Blade + Tailwind CSS 4 + Vite 8 |
| **API** | REST JSON (Session-based auth) |
| **Testing** | Pest PHP 4 |
| **Dev Tools** | Laravel Pint, Laravel Pail, Laravel Boost |

## Getting Started

### Prerequisites

- PHP ^8.3
- Composer
- Node.js & NPM
- MySQL or SQLite

### Installation

```bash
# Clone the repository
git clone https://github.com/your-username/inventory_api.git
cd inventory_api

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure database in .env, then run:
php artisan migrate --seed

# Build frontend assets
npm run build
```

### Development Server

```bash
# Start all services (server, queue, logs, Vite) concurrently
composer run dev
```

### Testing

```bash
composer test
```

## API Endpoints

All API endpoints are prefixed with `/api/`.

### Authentication

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/login` | Authenticate via username/password |

### Kategori (Categories)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/kategoris` | List all categories |
| POST | `/api/kategoris` | Create a category |
| GET | `/api/kategoris/{id}` | Show category with its items |
| PUT | `/api/kategoris/{id}` | Update a category |
| DELETE | `/api/kategoris/{id}` | Delete a category |

### Barang (Items)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/barangs` | List all items (includes kategori) |
| POST | `/api/barangs` | Create an item |
| GET | `/api/barangs/{id}` | Show item with kategori and stock movements |
| PUT | `/api/barangs/{id}` | Update an item |
| DELETE | `/api/barangs/{id}` | Delete an item (soft delete) |
| GET | `/api/barangs/{id}/history` | Get stock movement history for an item |

### Stok Movement (Stock Transactions)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/stok-movements` | List all stock movements |
| POST | `/api/stok-movements` | Record a stock movement (auto-updates stock) |
| GET | `/api/stok-movements/{id}` | Show a movement |
| PATCH | `/api/stok-movements/{id}` | Update a movement |
| DELETE | `/api/stok-movements/{id}` | Delete a movement |

### Health

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/health` | Health check |

## Database Schema

### Core Tables

| Table | Description |
|-------|-------------|
| `users` | User accounts with username, email, and role |
| `kategoris` | Item categories |
| `barangs` | Items/products with stock tracking and soft deletes |
| `stok_movements` | Stock transaction log (tipe: `masuk`/`keluar`) |

### Key Behaviors

- **Stock auto-update** — Creating a `masuk` movement increments item stock; `keluar` decrements it
- **Status calculation** — `stok === 0` → *Habis*, `stok <= stok_minimum` → *Menipis*, otherwise *Aman*
- **Cascade deletes** — Deleting a kategori removes its items; deleting an item removes related movements
- **Soft deletes** — Items are soft-deleted; stock movements use hard deletes

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/          # JSON API controllers
│   │   │   └── Web/          # Web dashboard controllers
│   │   └── Requests/         # Form request validation
│   ├── Models/               # Eloquent models
│   ├── Services/             # Business logic layer
│   ├── Policies/             # Authorization policies
│   └── Enums/                # Enum classes
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   └── views/                # Blade templates
├── routes/
│   ├── api.php               # API routes
│   └── web.php               # Web routes
└── tests/
    ├── Feature/              # Feature tests
    └── Unit/                 # Unit tests
```

## Docker

Project ini dilengkapi konfigurasi Docker untuk menjalankan seluruh stack (App, Nginx, MySQL, Redis, Mailpit) dengan satu perintah.

### Struktur Docker

```
Dockerfile
docker-compose.yml
.dockerignore
.env.docker
.docker/
  nginx/
    default.conf
  php/
    php.ini
    docker-entrypoint.sh
  mysql/
    init/
      01-init-db.sql
```

### Prerequisites

- Docker Engine 20.10+
- Docker Compose v2.0+

### Menjalankan

```bash
# Salin environment file Docker
cp .env.docker .env

# Build image
docker compose build

# Jalankan semua container di background
docker compose up -d

# Jalankan migrasi & seeder
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --force

# Generate app key (jika belum ada)
docker compose exec app php artisan key:generate --force

# Buat storage symlink (jika belum ada)
docker compose exec app php artisan storage:link
```

Aplikasi dapat diakses di `http://localhost` (default port 80).

### Perintah Umum

```bash
# Lihat status container
docker compose ps

# Lihat log
docker compose logs -f

# Lihat log service tertentu
docker compose logs -f app
docker compose logs -f nginx
docker compose logs -f mysql

# Masuk ke container app
docker compose exec app bash

# Masuk ke container app sebagai root
docker compose exec --user root app bash

# Restart service tertentu
docker compose restart app
```

### Migrasi & Seeder

```bash
# Jalankan migrasi
docker compose exec app php artisan migrate --force

# Rollback migrasi terakhir
docker compose exec app php artisan migrate:rollback --force

# Refresh migrasi (drop semua tabel, lalu migrate ulang)
docker compose exec app php artisan migrate:fresh --force

# Jalankan seeder
docker compose exec app php artisan db:seed --force

# Migrasi + seeder sekaligus
docker compose exec app php artisan migrate:fresh --seed --force
```

### Menghentikan

```bash
# Hentikan container (data tetap tersimpan di volume)
docker compose down

# Hentikan container + hapus volume (DATA HILANG)
docker compose down -v
```

### Reset Database

```bash
# Hapus dan buat ulang database
docker compose exec app php artisan migrate:fresh --seed --force

# Atau hapus volume MySQL lalu restart
docker compose down -v
docker compose up -d
docker compose exec app php artisan migrate --force
```

### Membersihkan Seluruh Container & Volume

```bash
# Hentikan dan hapus container + volume + network
docker compose down -v --remove-orphans

# Hapus image yang terbentuk
docker compose build --no-cache
```

### Konfigurasi Port

Ubah port via environment variable saat menjalankan:

```bash
# Ganti host port 80 ke 8080
APP_PORT=8080 docker compose up -d

# Ganti port database
DB_PORT=3307 docker compose up -d

# Ganti port Mailpit
MAILPIT_HTTP_PORT=8026 docker compose up -d
```

### Environment Docker

Konfigurasi aplikasi di dalam container dibaca dari file `.env.docker`. Jangan masukkan credential asli di file ini. Ganti nilai default sesuai kebutuhan.

**Catatan:** `.env` lokal tidak dibaca di dalam container. Gunakan `.env.docker` sebagai environment Docker.

### Troubleshooting

```bash
# Rebuild ulang dari scratch
docker compose build --no-cache
docker compose up -d

# Jika permission error di storage
docker compose exec app chown -R www-data:www-data storage bootstrap/cache

# Jika perlu clear cache
docker compose exec app php artisan optimize:clear

# Cek koneksi database dari container
docker compose exec app php artisan db:show
```

### Developer Experience

Project mendukung development flow berikut:

```bash
docker compose build
docker compose up -d
docker compose logs -f
docker compose exec app bash
docker compose down
```

Untuk hot-reload aset frontend (Vite), jalankan di host:

```bash
npm run dev
```

Atau build sekali saja untuk production assets:

```bash
npm run build
```

### Healthcheck

Setiap container dilengkapi healthcheck agar Compose tahu status layanan:

| Service   | Health Check                                 |
|-----------|-----------------------------------------------|
| app       | `php-fpm -t`                                  |
| nginx     | HTTP request ke localhost                     |
| mysql     | `mysqladmin ping`                             |
| redis     | `redis-cli ping`                              |
| mailpit   | HTTP request ke port 8025                     |

### Volume

| Volume         | Deskripsi                              |
|----------------|----------------------------------------|
| `mysql_data`   | Data MySQL (persisten)                 |
| `redis_data`   | Data Redis (persisten)                 |
| Project mount  | Source code tersinkron ke container    |

## License

This project is open-sourced under the MIT license.
