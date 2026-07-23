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

## License

This project is open-sourced under the MIT license.
