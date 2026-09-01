# Panduan Instalasi SIAP Panakkukang

## Kebutuhan Sistem

| Komponen | Versi Minimal |
|----------|---------------|
| PHP | 8.3+ |
| Composer | 2.x |
| Node.js | 18+ |
| MySQL | 8.0+ |
| npm | 9+ |

### Ekstensi PHP yang Diperlukan

```
openssl, pdo, mbstring, tokenizer, xml, ctype, json, bcmath, gd, curl, zip, fileinfo
```

---

## Instalasi Cepat

```bash
# 1. Clone repository
git clone <url-repo>
cd SIAP-Kantor-Camat-Panakkukang

# 2. Jalankan setup otomatis
composer setup

# 3. Jalankan server development
composer dev
```

Aplikasi bisa diakses di `http://localhost:8000`

---

## Instalasi Manual

### 1. Copy Environment

```bash
cp .env.example .env
```

### 2. Konfigurasi Database

Buka file `.env` dan isi:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siap_panakkukang
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Buat Database MySQL

```sql
CREATE DATABASE siap_panakkukang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Install Dependencies

```bash
composer install
npm install --ignore-scripts
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Jalankan Migrasi

```bash
php artisan migrate
```

### 7. Build Frontend

```bash
npm run build
```

### 8. Jalankan Server

```bash
php artisan dev
```

---

## Konfigurasi WebSocket (Laravel Reverb)

Edit `.env`:

```
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=789456
REVERB_APP_KEY=siap_key
REVERB_APP_SECRET=siap_secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

Jalankan Reverb server:

```bash
php artisan reverb:start
```

---

## Menjalankan Test

```bash
# Semua test
composer test

# Test spesifik
php artisan test --compact --filter=QueueServiceTest
```

---

## Perintah Penting

| Perintah | Kegunaan |
|----------|----------|
| `composer setup` | Install semua dependencies + migrasi + build |
| `composer dev` | Jalankan dev server (php artisan dev) |
| `composer test` | Jalankan semua test |
| `npm run dev` | Jalankan Vite dev server (hot reload) |
| `npm run build` | Build frontend untuk production |
| `vendor/bin/pint --format agent` | Format kode PHP |

---

## Struktur Project

```
app/
├── Events/          # Broadcast events (QueueCalled, QueueCompleted)
├── Http/
│   ├── Controllers/
│   └── Requests/    # Form request validation
├── Livewire/        # Komponen UI (AdminDashboard, PetugasDashboard, PublicDisplay)
├── Models/          # Eloquent models (Queue, Service, Counter, User, dll)
├── Services/        # Business logic (QueueService)
└── View/Components/ # Blade view components

resources/views/livewire/  # Template Blade untuk Livewire
routes/web.php             # Definisi route
database/                  # Migrations, seeders, factories
tests/                     # Unit & Feature tests
```

---

## Login Default

Buat akun admin melalui tinker:

```bash
php artisan tinker
```

```php
use App\Models\User;
User::create([
    'name' => 'Admin',
    'email' => 'admin@panakkukang.go.id',
    'password' => bcrypt('password'),
    'role' => 'ADMIN',
]);
```

Buat akun petugas:

```php
use App\Models\Counter;
use App\Models\User;

$counter = Counter::create(['name' => 'Ruang Pelayanan 1', 'status' => true]);

User::create([
    'name' => 'Petugas',
    'email' => 'petugas@panakkukang.go.id',
    'password' => bcrypt('password'),
    'role' => 'PETUGAS',
    'counter_id' => $counter->id,
]);
```

---

## Role Pengguna

| Role | Akses |
|------|-------|
| ADMIN | `/admin` — Kelola layanan, counter, petugas, pengumuman |
| PETUGAS | `/petugas` — Panggil & kelola antrean |
| Umum | `/display` — Monitor tampilan antrean (tanpa login) |

---

## Troubleshooting

### Error "Vite manifest not found"
```bash
npm install --ignore-scripts
npm run build
```

### Error "Application key not set"
```bash
php artisan key:generate
```

### Database connection refused
- Pastikan MySQL berjalan
- Periksa konfigurasi `DB_*` di file `.env`

### WebSocket tidak connect
- Pastikan Reverb server berjalan: `php artisan reverb:start`
- Periksa konfigurasi `REVERB_*` di file `.env`

### Session expired / logout otomatis
- Pastikan table `sessions` sudah dibuat (jalankan `php artisan migrate`)
