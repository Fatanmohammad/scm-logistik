# SCM Logistik

Platform berbasis web untuk manajemen rantai pasok/logistik sederhana. Aplikasi ini membantu pengelolaan produk, stok barang, pengiriman, laporan mutasi, laporan stok, serta manajemen pengguna berdasarkan role.

Dibangun menggunakan Laravel 13 + Blade + Tailwind CSS + Vite, dengan sistem autentikasi dan pembatasan akses berbasis role seperti `admin`, `manager`, dan `staf`.

> Project aplikasi SCM Logistik berbasis Laravel.

---

## Fitur Unggulan

- **Manajemen Inventaris**: CRUD produk dengan kategori dan pelacakan stok real-time.
- **Integrasi Stok & Pengiriman**: 
    - Stok otomatis berkurang saat status pengiriman diubah menjadi `delivered`.
    - Validasi otomatis untuk mencegah pengiriman melebihi stok yang tersedia.
    - Pengembalian stok otomatis (*rollback*) jika pengiriman dibatalkan atau data pengiriman dihapus.
- **Riwayat Mutasi**: Setiap perubahan stok (masuk/keluar/pengiriman) dicatat secara otomatis dalam tabel mutasi untuk audit trail.
- **Keamanan**: Password visibility toggle dan autentikasi berbasis role.
- **UI Modern**: Desain premium menggunakan Tailwind CSS dengan nuansa gelap (*dark mode*) dan navigasi yang intuitif.

---

## Daftar Isi

- Stack & Konvensi
- Cara Menjalankan
- Struktur Aplikasi

---

## Stack & Konvensi

| Aspek | Pilihan |
| --- | --- |
| Framework | Laravel 13 |
| Bahasa Backend | PHP 8.3+ |
| Database | MySQL / database Laravel sesuai konfigurasi `.env` |
| Frontend | Blade + Tailwind CSS |
| Build Tool | Vite |
| Package Manager PHP | Composer |
| Package Manager JS | npm |
| Auth | Login/Register manual melalui `AuthController` |
| Authorization | Role-based access menggunakan `RoleMiddleware` |
| UI Component | Blade Components bawaan Laravel/Breeze |

### Role Aplikasi

- `admin` — akses penuh, termasuk manajemen user.
- `manager` — akses laporan stok, mutasi, dan manajemen produk.
- `staf` — akses pengelolaan produk, stok, dan pengiriman.

### Aturan visual penting

- Tampilan menggunakan Blade dan Tailwind CSS.
- Komponen form dan tombol menggunakan Blade Components seperti `primary-button`, `secondary-button`, `danger-button`, `input-label`, dan `text-input`.
- Layout utama aplikasi berada di folder `resources/views/layouts/`.

---

## Cara Menjalankan

### Prasyarat

- PHP 8.3+
- Composer
- Node.js dan npm
- MySQL atau database lain yang sesuai dengan konfigurasi Laravel

### Setup awal

```bash
# 1. Install dependency PHP
composer install

# 2. Install dependency frontend
npm install

# 3. Copy file environment
copy .env.example .env

# 4. Generate application key
php artisan key:generate
```

### Konfigurasi database

Buat database baru, misalnya:

```sql
CREATE DATABASE scm_logistik;
```

Lalu sesuaikan konfigurasi database di file `.env`:

```env
DB_DATABASE=scm_logistik
DB_USERNAME=root
DB_PASSWORD=
```

Setelah itu jalankan migrasi dan seeder:

```bash
php artisan migrate:fresh --seed
```

### Jalankan dev server

Buka 2 terminal:

```bash
# Terminal 1 — Laravel
php artisan serve
```

```bash
# Terminal 2 — Vite
npm run dev
```

Buka aplikasi di:

```text
http://127.0.0.1:8000
```

### Akun seed

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@gmail.com` | `password123` |

Seeder juga menambahkan kategori awal seperti `Elektronik` dan `Logistik Umum`.

---

## Struktur Aplikasi

```text
app/
├─ Http/
│  ├─ Controllers/
│  │  ├─ AuthController.php          ← Login, register, dan logout manual
│  │  ├─ ProductController.php       ← CRUD produk/barang
│  │  ├─ StockController.php         ← Update stok produk secara manual
│  │  ├─ ShipmentController.php      ← Pengelolaan pengiriman & auto-stok logic
│  │  ├─ ReportController.php        ← Laporan mutasi dan laporan stok
│  │  ├─ UserController.php          ← Manajemen user oleh admin
│  │  └─ ProfileController.php       ← Edit, update, dan hapus profil user
│  ├─ Middleware/
│  │  └─ RoleMiddleware.php          ← Pembatasan akses berdasarkan role
│  └─ Requests/
│     └─ ProfileUpdateRequest.php    ← Validasi update profil
├─ Models/
│  ├─ User.php                       ← Model user dan role pengguna
│  ├─ Category.php                   ← Model kategori produk
│  ├─ Product.php                    ← Model produk/barang
│  ├─ StockMovement.php              ← Model riwayat pergerakan stok
│  └─ Shipment.php                   ← Model data pengiriman (product_id, quantity)
├─ Observers/                        ← Observer model jika ada logic otomatis
├─ Providers/                        ← Service provider aplikasi
└─ View/Components/                  ← Class component Blade

resources/views/
├─ layouts/                          ← Layout utama aplikasi
├─ components/                       ← Komponen Blade reusable
│  ├─ primary-button.blade.php       ← Tombol utama
│  ├─ secondary-button.blade.php     ← Tombol sekunder
│  ├─ danger-button.blade.php        ← Tombol aksi berbahaya
│  ├─ input-label.blade.php          ← Label form
│  ├─ text-input.blade.php           ← Input form
│  ├─ input-error.blade.php          ← Pesan error validasi
│  ├─ dropdown.blade.php             ← Dropdown menu
│  ├─ nav-link.blade.php             ← Link navigasi desktop
│  └─ responsive-nav-link.blade.php  ← Link navigasi responsive
├─ auth/                             ← Halaman login/register
├─ admin/users/                      ← Halaman manajemen user
├─ products/                         ← Halaman CRUD produk
├─ shipments/                        ← Halaman pengiriman (Product & Quantity)
├─ reports/                          ← Halaman laporan mutasi & stok
├─ profile/                          ← Halaman profil user
├─ dashboard.blade.php               ← Dashboard setelah login
└─ welcome.blade.php                 ← Halaman default Laravel

database/
├─ migrations/
│  ├─ create_users_table.php         ← Tabel user + role
│  ├─ create_categories_table.php    ← Tabel kategori produk
│  ├─ create_products_table.php      ← Tabel produk
│  ├─ create_stock_movements_table.php ← Tabel riwayat stok
│  ├─ create_shipments_table.php     ← Tabel pengiriman (Tracking, Product, Quantity)
│  ├─ create_sessions_table.php      ← Tabel session Laravel
│  └─ create_cache_table.php         ← Tabel cache Laravel
└─ seeders/
   ├─ DatabaseSeeder.php             ← Seeder utama akun admin & kategori awal
   ├─ UserSeeder.php                 ← Seeder contoh user beberapa role
   └─ ProductSeeder.php              ← Seeder produk

routes/
├─ web.php                           ← Route utama aplikasi web
├─ auth.php                          ← Route auth/profile tambahan
└─ console.php                       ← Route command console Laravel
```
