# IT Device Maintenance App

Aplikasi web berbasis **Laravel 13** untuk manajemen maintenance perangkat IT. Mencakup pencatatan inventaris, sistem tiket perbaikan, penjadwalan maintenance, pelaporan, dan QR Code identifikasi perangkat.

## Tech Stack

| Komponen | Teknologi |
|---|---|
| **Backend** | Laravel 13, PHP 8.4 |
| **Frontend** | Blade, Alpine.js, Tailwind CSS v4 |
| **Database** | TiDB Cloud (MySQL-compatible) |
| **Build Tool** | Vite 8 |
| **Auth** | Laravel Breeze |
| **PDF Export** | DomPDF |
| **QR Code** | Simple QrCode (BaconQrCode) |

## Fitur

### Role-based Access
- **Admin** — akses penuh ke semua fitur
- **Teknisi** — CRUD inventaris, tiket, maintenance, laporan
- **User** — lihat perangkat, buat tiket, lihat tiket sendiri

### Modul
- **Inventaris Perangkat** — CRUD + tracking status (available, in_use, under_maintenance, retired)
- **Kategori Perangkat** — pengelompokan perangkat (Desktop, Laptop, Printer, Network, Server, Peripheral)
- **Tiket Maintenance** — request, assign, resolve, close + filter status/priority
- **Log Maintenance** — pencatatan perbaikan, biaya, spare parts yang digunakan
- **Spare Parts** — manajemen stok dengan indikator stok menipis
- **Dashboard** — statistik, chart status device/ticket, recent activity
- **Laporan** — filterable + export PDF (devices, maintenance, tickets)
- **QR Code** — identifikasi perangkat via QR

## Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js 20+
- MySQL / TiDB Cloud

### Langkah

```bash
# 1. Clone repositori
git clone <repo-url> it-maintenance-app
cd it-maintenance-app

# 2. Install dependensi PHP
composer install

# 3. Copy & konfigurasi environment
cp .env.example .env
php artisan key:generate
```

### Konfigurasi Database (.env)

**MySQL / TiDB Cloud:**
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=it_maintenance_app
DB_USERNAME=root
DB_PASSWORD=
```

**TiDB Cloud Serverless (SSL required):**
```dotenv
DB_CONNECTION=mysql
DB_HOST=gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com
DB_PORT=4000
DB_DATABASE=it_maintenance_app
DB_USERNAME=xxx.root
DB_PASSWORD=xxx
MYSQL_ATTR_SSL_CA=/path/to/tidb-ca.pem
```

### Setup Frontend & Migrasi

```bash
# 4. Install dependensi Node & build
npm install
npm run build

# 5. Jalankan migrasi & seeder
php artisan migrate --seed

# 6. Buat storage link
php artisan storage:link
```

## Menjalankan Aplikasi

```bash
# Terminal 1 — Laravel
php artisan serve

# Terminal 2 — Vite hot reload (development)
npm run dev
```

Akses: `http://localhost:8000`

## Akun Default (Seeder)

| Role | Email | Password |
|---|---|---|
| **Admin** | admin@example.com | password |
| **Teknisi** | teknisi@example.com | password |
| **User** | user@example.com | password |

## Struktur Database

### Diagram Relasi

```
users
  ├── tickets (user_id)          — tiket yang dibuat user
  ├── tickets (assigned_to)      — tiket yang ditugaskan
  └── maintenance_logs (user_id) — log maintenance oleh teknisi

categories
  └── devices (category_id)

devices
  ├── tickets (device_id)
  └── maintenance_logs (device_id)

tickets
  └── maintenance_logs (ticket_id)

maintenance_logs
  └── maintenance_log_spare_part (pivot)
        └── spare_parts
```

### Daftar Tabel

| Tabel | Keterangan |
|---|---|
| `users` | User + role (admin, technician, user) |
| `categories` | Kategori perangkat |
| `devices` | Inventaris perangkat IT |
| `tickets` | Tiket maintenance |
| `maintenance_logs` | Riwayat perbaikan |
| `spare_parts` | Manajemen stok spare part |
| `maintenance_log_spare_part` | Pivot — spare part yg digunakan |

## Routes

### Web (Autentikasi)
| Method | URI | Controller | Middleware |
|---|---|---|---|
| GET | `/dashboard` | DashboardController | auth, verified |
| GET/POST | `/login` | Auth | guest |
| GET/POST | `/register` | Auth | guest |
| GET | `/profile` | ProfileController | auth |

### Perangkat (Semua Role)
| Method | URI | Aksi |
|---|---|---|
| GET | `/devices` | Index |
| POST | `/devices` | Store |
| GET | `/devices/create` | Create form |
| GET | `/devices/{id}` | Show (detail + QR) |
| PUT | `/devices/{id}` | Update |
| DELETE | `/devices/{id}` | Delete |
| GET | `/devices/{id}/qr` | QR Code PNG |

### Tiket (Semua Role)
| Method | URI | Aksi |
|---|---|---|
| GET | `/tickets` | Index (filter) |
| POST | `/tickets` | Store |
| GET | `/tickets/{id}` | Detail + actions |
| PATCH | `/tickets/{id}/assign` | Assign teknisi |
| PATCH | `/tickets/{id}/resolve` | Tandai selesai |
| PATCH | `/tickets/{id}/close` | Tutup tiket |

### Admin / Teknisi Only
| Resource | Keterangan |
|---|---|
| `/categories` | CRUD kategori |
| `/spare-parts` | CRUD spare parts |
| `/maintenance-logs` | CRUD + spare parts pivot |
| `/reports` | Laporan + export PDF |

## Export PDF

Laporan dapat di-export ke PDF dari halaman laporan:
- `/reports/export/devices?status=&category_id=`
- `/reports/export/maintenance?date_from=&date_to=&device_id=`
- `/reports/export/tickets?status=&priority=&date_from=&date_to=`

## Lisensi

MIT
