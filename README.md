# RoyalTech Jewellery CRM

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 13" />
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.4" />
  <img src="https://img.shields.io/badge/TailwindCSS-v4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js" />
  <img src="https://img.shields.io/badge/Vite-8-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 8" />
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License" />
</p>

**RoyalTech Jewellery CRM** is a jewellery showroom management system for Indian retail operations. It covers live metal rates, vault inventory, jewellery POS, old gold exchange, karigar workshop, gold savings schemes, multi-branch control, and GST-ready billing.

**Demo shop name:** Shree Aurum Jewellers  
**Powered by:** [RoyalTech Innovation](https://github.com/Royaltechinnovation-1)

---

## Table of Contents

1. [Technology Stack](#technology-stack)
2. [System Architecture](#system-architecture)
3. [Key Modules](#key-modules)
4. [Project Structure](#project-structure)
5. [Prerequisites](#prerequisites)
6. [Local Installation](#local-installation)
7. [Demo Login Credentials](#demo-login-credentials)
8. [Environment Variables](#environment-variables)
9. [Deployment (Render Free)](#deployment-render-free)
10. [Testing](#testing)
11. [License](#license)

---

## Technology Stack

### Backend
| Technology | Version | Purpose |
|---|---|---|
| **PHP** | 8.3+ / 8.4 | Server-side language |
| **Laravel** | 13.x | Application framework (routing, auth, ORM, queues) |
| **Eloquent ORM** | Built-in | Database models & relationships |
| **Blade** | Built-in | Server-rendered templates |
| **SQLite / MySQL** | — | Database (SQLite for demo/free deploy, MySQL for production) |
| **Composer** | 2.x | PHP dependency manager |

### Frontend
| Technology | Version | Purpose |
|---|---|---|
| **Blade + HTML5** | — | UI pages |
| **Tailwind CSS** | v4 | Utility-first styling |
| **Alpine.js** | 3.x | Lightweight interactivity |
| **Chart.js** | 4.x | Dashboard charts (rates, sales vs purchase) |
| **Vite** | 8.x | Asset bundler / build tool |
| **Laravel Vite Plugin** | 3.x | Laravel ↔ Vite integration |

### DevOps / Deploy
| Technology | Purpose |
|---|---|
| **Docker** | Container image for cloud deploy |
| **Apache (PHP 8.4)** | Web server inside Docker |
| **Render** | Free-tier cloud hosting |
| **GitHub** | Source control & deploy trigger |
| **Nixpacks config** | Optional Railway-oriented build helpers |

### Security & App Features
- Laravel session + CSRF protection
- Role-based access (`admin`, `manager`, `cashier`, `salesperson`, `artisan`)
- Audit / login history support
- HTTPS-aware proxy trust (for Render / reverse proxies)

---

## System Architecture

```text
Browser (Login / Dashboard / POS)
        │
        ▼
 Apache (Docker)  →  public/index.php
        │
        ▼
 Laravel 13 (Routes → Controllers → Models/Services)
        │
        ▼
 SQLite (demo)  or  MySQL / MariaDB (production)
```

**Frontend assets flow**
```text
resources/css + resources/js
        │  (Vite build)
        ▼
public/build/*  → loaded by Blade via @vite
```

---

## Key Modules

1. **Dashboard & Analytics** — today sales, stock valuation, charts, branch/staff leaderboard  
2. **Metal Rates** — gold/silver/platinum rates with karat derivation  
3. **Product Master & Vault Inventory** — piece-level weight, barcode/QR, consumables  
4. **BIS HUID / Diamonds** — hallmark & stone tracking  
5. **Jewellery POS** — making/wastage charges, GST, split payments, invoices  
6. **Old Gold Exchange** — purity, deductions, valuation  
7. **Workshop** — karigar job-work, custom orders, repairs  
8. **Gold Savings Schemes** — installment plans (e.g. 11+1 style)  
9. **CRM & Loyalty** — customers, campaigns, wishlists  
10. **Purchases & Suppliers** — procurement flow  
11. **Finance** — accounts / expenses / vouchers  
12. **Admin** — staff, branches, approvals, audit, BI reports, settings  

---

## Project Structure

```text
app/
  Http/Controllers/     # Feature controllers (POS, CRM, Dashboard, etc.)
  Models/               # Eloquent models
  Services/             # Pricing, rates, audit helpers
database/
  migrations/           # Schema
  seeders/              # Demo users & sample data
resources/
  views/                # Blade UI (auth, dashboard, POS, ...)
  css/ / js/            # Tailwind + Alpine + Chart.js entrypoints
public/
  logo.jpeg             # RoyalTech logo
  images/               # Login background assets
  build/                # Compiled Vite assets (generated)
docker/
  entrypoint.sh         # Container start (migrate/seed + Apache)
Dockerfile              # Production image for Render
render.yaml             # Render service blueprint
routes/web.php          # Application routes
```

---

## Prerequisites

- PHP **8.3+** (8.4 recommended)
- Composer 2.x
- Node.js **18+** and npm
- SQLite **or** MySQL 8.x / MariaDB

---

## Local Installation

```bash
# 1) Clone
git clone https://github.com/Royaltechinnovation-1/royaltech-crm-jewlery-.git
cd royaltech-crm-jewlery-

# 2) PHP dependencies
composer install

# 3) Environment
cp .env.example .env
php artisan key:generate

# 4) Database (SQLite example)
# Ensure DB_CONNECTION=sqlite in .env
# Create empty DB file if needed:
#   New-Item database/database.sqlite   (Windows PowerShell)
#   touch database/database.sqlite      (Linux/macOS)
php artisan migrate --seed

# 5) Frontend
npm install
npm run build

# 6) Run
php artisan serve
```

Open: [http://127.0.0.1:8000](http://127.0.0.1:8000)

For local Vite hot reload:

```bash
npm run dev
```

---

## Demo Login Credentials

All demo accounts use password: **`password`**

| Role | Email | Access |
|---|---|---|
| Admin / Owner | `admin@jewelerp.in` | Full access |
| Branch Manager | `manager@jewelerp.in` | POS, inventory, rates, approvals, reports |
| Cashier | `cashier@jewelerp.in` | POS, checkout, schemes, repairs |
| Salesperson | `ananya@jewelerp.in` | POS, CRM, custom orders |
| Artisan (Karigar) | `rahim@jewelerp.in` | Workshop / manufacturing / repairs |

---

## Environment Variables

| Variable | Example | Notes |
|---|---|---|
| `APP_NAME` | `Shree Aurum Jewellers` | Business display name |
| `APP_ENV` | `production` / `local` | Environment |
| `APP_DEBUG` | `false` in production | Never leave `true` live |
| `APP_KEY` | `base64:...` | Required (`php artisan key:generate --show`) |
| `APP_URL` | `https://your-app.onrender.com` | Must match live HTTPS URL |
| `DB_CONNECTION` | `sqlite` or `mysql` | Demo uses sqlite |
| `DB_DATABASE` | `/app/database/database.sqlite` | SQLite path in Docker |
| `SESSION_DRIVER` | `file` / `database` | |
| `SESSION_SECURE_COOKIE` | `true` | Required on HTTPS hosts |
| `CACHE_STORE` | `file` / `database` | |
| `QUEUE_CONNECTION` | `sync` | Simple for demo |
| `LOG_CHANNEL` | `stderr` | Cloud log visibility |

---

## Deployment (Render Free)

This project includes Docker deploy files for **Render Free** (demo-friendly SQLite).

### Included deploy files
- `Dockerfile` — PHP 8.4 Apache image
- `docker/entrypoint.sh` — migrate + seed on boot
- `render.yaml` — service blueprint

### Steps
1. Push code to GitHub.
2. Create a **Web Service** on [Render](https://render.com).
3. Connect repo `Royaltechinnovation-1/royaltech-crm-jewlery-`.
4. Runtime: **Docker**, plan: **Free**.
5. Set environment variables (`APP_KEY`, `APP_URL`, sqlite settings, `SESSION_SECURE_COOKIE=true`).
6. Deploy and open `/login`.

### Notes for free hosting
- Free instances may **sleep** when idle; first request can be slow.
- SQLite data on free containers can reset after rebuilds/restarts (acceptable for demo).
- For production, use MySQL/Postgres + persistent storage.

---

## Testing

```bash
php artisan test
```

Covers authentication, pricing/GST math, and route security checks.

---

## License

MIT License.

---

## Credits

Built and customized for jewellery retail workflows.  
**Powered by RoyalTech Innovation**
