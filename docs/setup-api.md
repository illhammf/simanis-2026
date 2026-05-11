# Setup API dengan `rupadana/filament-api-service`

Dokumentasi implementasi REST API otomatis pada proyek Laravel + FilamentPHP ini.

> **Catatan:** `dca` adalah alias untuk `docker exec trial_php php artisan`

---

## Daftar Isi

- [Setup API dengan `rupadana/filament-api-service`](#setup-api-dengan-rupadanafilament-api-service)
  - [Daftar Isi](#daftar-isi)
  - [1. Prasyarat](#1-prasyarat)
  - [2. Instalasi Package](#2-instalasi-package)
  - [3. Setup Laravel Sanctum](#3-setup-laravel-sanctum)
  - [4. Daftarkan Plugin di Panel Provider](#4-daftarkan-plugin-di-panel-provider)
  - [5. Publish Konfigurasi](#5-publish-konfigurasi)
  - [6. Generate API Service per Resource](#6-generate-api-service-per-resource)
    - [Contoh isi `SiswaApiService.php`:](#contoh-isi-siswaapiservicephp)
  - [7. Implementasi Filtering \& Sorting di Model](#7-implementasi-filtering--sorting-di-model)
    - [Contoh pada Model `Siswa`:](#contoh-pada-model-siswa)
    - [Contoh pada Model `Produk`:](#contoh-pada-model-produk)
    - [Penggunaan di URL:](#penggunaan-di-url)
  - [8. Membuat Transformer (Opsional)](#8-membuat-transformer-opsional)
  - [9. Membuat Custom Handler (Opsional)](#9-membuat-custom-handler-opsional)
    - [Contoh: Membuat endpoint publik (tanpa autentikasi)](#contoh-membuat-endpoint-publik-tanpa-autentikasi)
  - [10. Uji Coba Endpoint](#10-uji-coba-endpoint)
    - [Jalankan Docker (jika belum berjalan):](#jalankan-docker-jika-belum-berjalan)
    - [Test menggunakan cURL:](#test-menggunakan-curl)
    - [Test menggunakan Postman / Insomnia:](#test-menggunakan-postman--insomnia)
  - [11. Autentikasi API (Login \& Logout)](#11-autentikasi-api-login--logout)
    - [Generate API Token Manual via Filament Panel:](#generate-api-token-manual-via-filament-panel)
    - [Mengaktifkan menu Token di Sidebar:](#mengaktifkan-menu-token-di-sidebar)
  - [12. Daftar Endpoint yang Dihasilkan](#12-daftar-endpoint-yang-dihasilkan)
  - [13. Konfigurasi Lanjutan](#13-konfigurasi-lanjutan)
    - [A. Nonaktifkan prefix panel](#a-nonaktifkan-prefix-panel)
    - [B. Tambahkan Middleware Custom](#b-tambahkan-middleware-custom)
    - [C. Ubah Group Route Name (Prefix URL)](#c-ubah-group-route-name-prefix-url)
    - [D. Menonaktifkan Handler Tertentu](#d-menonaktifkan-handler-tertentu)
  - [14. Dokumentasi Otomatis (Scramble)](#14-dokumentasi-otomatis-scramble)
  - [15. Troubleshooting](#15-troubleshooting)
    - [❌ `Class not found` setelah generate](#-class-not-found-setelah-generate)
    - [❌ Token tidak bekerja / 401 Unauthenticated](#-token-tidak-bekerja--401-unauthenticated)
    - [❌ Route API tidak muncul](#-route-api-tidak-muncul)
    - [❌ Permission denied (403 Forbidden)](#-permission-denied-403-forbidden)
    - [❌ Error `Class "PersonalAccessToken" not found`](#-error-class-personalaccesstoken-not-found)
    - [❌ Cache config lama](#-cache-config-lama)
  - [Ringkasan Perintah](#ringkasan-perintah)

---

## 1. Prasyarat

- PHP >= 8.2
- Laravel 12 (proyek ini)
- FilamentPHP 3.3
- Docker + container `trial_php` berjalan
- Alias `dca` tersedia → `docker exec trial_php php artisan`

Verifikasi container berjalan:

```bash
docker exec trial_php php artisan --version
# Laravel Framework 12.8.1
```

---

## 2. Instalasi Package

✅ **Sudah terinstal** — `"rupadana/filament-api-service": "^3.4"` ada di `composer.json`.

Jika belum, jalankan:

```bash
docker exec trial_php composer require rupadana/filament-api-service
```

---

## 3. Setup Laravel Sanctum

✅ **Sudah selesai** — tabel `personal_access_tokens` sudah ada di database.

Jika perlu setup ulang dari awal:

```bash
# Publish migrasi personal_access_tokens
dca install:api

# Jalankan migrasi
dca migrate
```

> **Penting:** Pastikan model `User` menggunakan trait `HasApiTokens` (sudah ditambahkan di proyek ini):
>
> ```php
> use Laravel\Sanctum\HasApiTokens;
>
> class User extends Authenticatable
> {
>     use HasApiTokens, HasFactory, HasRoles, Notifiable;
> }
> ```

---

## 4. Daftarkan Plugin di Panel Provider

✅ **Sudah terdaftar** di `src/app/Providers/Filament/AdminPanelProvider.php`.

```php
use Rupadana\ApiService\ApiServicePlugin;

->plugins([
    // ... plugin lainnya ...
    ApiServicePlugin::make(),  // ← sudah ada
])
```

---

## 5. Publish Konfigurasi

✅ **Sudah di-publish** — file ada di `src/config/api-service.php`.

Jika perlu publish ulang:

```bash
dca vendor:publish --tag=api-service-config
```

Isi konfigurasi di `src/config/api-service.php`:

```php
return [
    'navigation' => [
        'token' => [
            'cluster' => null,
            'group' => 'User',
            'sort' => -1,
            'icon' => 'heroicon-o-key',
            'should_register_navigation' => false, // true agar token muncul di sidebar
        ],
    ],
    'models' => [
        'token' => [
            'enable_policy' => true,
        ],
    ],
    'route' => [
        'panel_prefix' => true,   // prefix route: /api/admin/...
        'use_resource_middlewares' => false,
    ],
    'tenancy' => [
        'enabled' => false,
        'awareness' => false,
    ],
    'login-rules' => [
        'email'    => 'required|email',
        'password' => 'required',
    ],
    'login-middleware' => [],
    'logout-middleware' => [
        'auth:sanctum',
    ],
    'use-spatie-permission-middleware' => true,
];
```

---

## 6. Generate API Service per Resource

✅ **Sudah di-generate untuk semua 12 resource.**

Jika perlu generate ulang atau untuk resource baru:

```bash
dca make:filament-api-service SiswaResource
dca make:filament-api-service BukuResource
dca make:filament-api-service DokterResource
dca make:filament-api-service PasienResource
dca make:filament-api-service KonsultasiResource
dca make:filament-api-service ProdukResource
dca make:filament-api-service TransaksiResource
dca make:filament-api-service KostumerResource
dca make:filament-api-service PeminjamResource
dca make:filament-api-service PinjamResource
dca make:filament-api-service TahunAjaranResource
dca make:filament-api-service UserResource
```

> **Catatan:** Route API **tidak didaftarkan di `routes/api.php`**. Package mendaftarkan route-nya sendiri melalui `ApiServiceServiceProvider` secara otomatis saat panel Filament diinisialisasi.

Setiap perintah akan menghasilkan file berikut (contoh untuk `SiswaResource`):

```
app/Filament/Admin/Resources/SiswaResource/Api/
├── SiswaApiService.php
└── Handlers/
    ├── CreateHandler.php
    ├── UpdateHandler.php
    ├── DeleteHandler.php
    ├── PaginationHandler.php
    └── DetailHandler.php
```

### Contoh isi `SiswaApiService.php`:

```php
<?php

namespace App\Filament\Admin\Resources\SiswaResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\SiswaResource;
use Illuminate\Routing\Router;

class SiswaApiService extends ApiService
{
    protected static string | null $resource = SiswaResource::class;

    public static function handlers(): array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class,
        ];
    }
}
```

---

## 7. Implementasi Filtering & Sorting di Model

Untuk mengaktifkan fitur filter, sort, dan field selection pada endpoint API, implementasikan contracts dari Spatie Query Builder di model.

### Contoh pada Model `Siswa`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Rupadana\ApiService\Contracts\HasAllowedSorts;

class Siswa extends Model implements HasAllowedFields, HasAllowedFilters, HasAllowedSorts
{
    use SoftDeletes;

    // ... fillable, casts, dsb. (tidak perlu diubah)

    public static function getAllowedFields(): array
    {
        return ['id', 'nama', 'nisn', 'nis', 'email', 'status_siswa', 'kelas_id', 'tingkat_id', 'jurusan_id'];
    }

    public static function getAllowedSorts(): array
    {
        return ['nama', 'nisn', 'nis', 'created_at', 'status_siswa'];
    }

    public static function getAllowedFilters(): array
    {
        return ['nama', 'nisn', 'nis', 'status_siswa', 'kelas_id', 'tingkat_id', 'jurusan_id'];
    }
}
```

### Contoh pada Model `Produk`:

```php
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Rupadana\ApiService\Contracts\HasAllowedSorts;

class Produk extends Model implements HasAllowedFields, HasAllowedFilters, HasAllowedSorts
{
    public static function getAllowedFields(): array
    {
        return ['id', 'nama', 'harga', 'stok', 'kategori'];
    }

    public static function getAllowedSorts(): array
    {
        return ['nama', 'harga', 'stok', 'created_at'];
    }

    public static function getAllowedFilters(): array
    {
        return ['nama', 'kategori'];
    }
}
```

### Penggunaan di URL:

```
# Filter
GET /api/admin/siswas?filter[status_siswa]=aktif

# Sort (ascending)
GET /api/admin/siswas?sort=nama

# Sort (descending)
GET /api/admin/siswas?sort=-nama

# Pilih field tertentu
GET /api/admin/siswas?fields[siswas]=id,nama,nisn

# Pagination
GET /api/admin/siswas?per_page=20&page=2

# Kombinasi
GET /api/admin/siswas?filter[status_siswa]=aktif&sort=-nama&per_page=15
```

---

## 8. Membuat Transformer (Opsional)

Transformer digunakan untuk mengontrol format data yang dikembalikan API.

```bash
dca make:filament-api-transformer Siswa
```

File dibuat di: `app/Filament/Admin/Resources/SiswaResource/Api/Transformers/SiswaTransformer.php`

```php
<?php

namespace App\Filament\Admin\Resources\SiswaResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SiswaTransformer extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'nama'         => $this->nama,
            'nisn'         => $this->nisn,
            'nis'          => $this->nis,
            'email'        => $this->email,
            'status_siswa' => $this->status_siswa,
            'kelas'        => $this->kelas?->nama,
            'jurusan'      => $this->jurusan?->nama,
            'tingkat'      => $this->tingkat?->nama,
            'created_at'   => $this->created_at?->toDateTimeString(),
        ];
    }
}
```

Daftarkan transformer di `SiswaResource.php`:

```php
use App\Filament\Admin\Resources\SiswaResource\Api\Transformers\SiswaTransformer;

class SiswaResource extends Resource
{
    // ... kode yang ada

    public static function getApiTransformer(): string
    {
        return SiswaTransformer::class;
    }
}
```

---

## 9. Membuat Custom Handler (Opsional)

Jika ingin mengkustomisasi logika endpoint tertentu:

```bash
# Generate semua handler sekaligus untuk satu resource
dca make:filament-api-handler SiswaResource

# Atau generate handler spesifik
dca make:filament-api-handler SiswaResource --type=Pagination
```

### Contoh: Membuat endpoint publik (tanpa autentikasi)

Edit `PaginationHandler.php` milik resource yang ingin dibuat publik:

```php
<?php

namespace App\Filament\Admin\Resources\SiswaResource\Api\Handlers;

use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Admin\Resources\SiswaResource;

class PaginationHandler extends Handlers
{
    public static string | null $uri = '/';
    public static string | null $resource = SiswaResource::class;

    // Jadikan endpoint ini publik (tidak perlu token)
    public static bool $public = true;

    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return static::getApiTransformer()::collection($query);
    }
}
```

---

## 10. Uji Coba Endpoint

### Jalankan Docker (jika belum berjalan):

```bash
docker compose up -d
```

### Test menggunakan cURL:

**1. Login dan dapatkan token:**

```bash
curl -X POST https://trial.test/api/auth/login \
  -H "Content-Type: application/json" \
  --insecure \
  -d '{"email":"admin@example.com","password":"password"}'
```

Response:

```json
{
  "data": {
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
  }
}
```

**2. Gunakan token untuk mengakses endpoint:**

```bash
# List semua siswa
curl -X GET https://trial.test/api/admin/siswas \
  -H "Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" \
  -H "Accept: application/json" \
  --insecure

# Detail siswa berdasarkan ID
curl -X GET https://trial.test/api/admin/siswas/1 \
  -H "Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" \
  --insecure

# Buat siswa baru
curl -X POST https://trial.test/api/admin/siswas \
  -H "Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" \
  -H "Content-Type: application/json" \
  --insecure \
  -d '{"nama":"Budi Santoso","nisn":"1234567890","email":"budi@example.com"}'

# Update siswa
curl -X PUT https://trial.test/api/admin/siswas/1 \
  -H "Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" \
  -H "Content-Type: application/json" \
  --insecure \
  -d '{"status_siswa":"nonaktif"}'

# Hapus siswa
curl -X DELETE https://trial.test/api/admin/siswas/1 \
  -H "Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" \
  --insecure

# Logout
curl -X POST https://trial.test/api/auth/logout \
  -H "Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" \
  --insecure
```

### Test menggunakan Postman / Insomnia:

1. Buat request `POST https://trial.test/api/auth/login`
2. Body (JSON): `{ "email": "...", "password": "..." }`
3. Copy token dari response
4. Untuk request berikutnya, tambahkan Header:  
   `Authorization: Bearer <token>` dan `Accept: application/json`
5. Jika menggunakan SSL self-signed, nonaktifkan verifikasi SSL di settings Postman

---

## 11. Autentikasi API (Login & Logout)

Package sudah menyediakan endpoint autentikasi bawaan:

| Method | URL | Deskripsi |
|--------|-----|-----------|
| POST | `/api/auth/login` | Login, kembalikan token Sanctum |
| POST | `/api/auth/logout` | Logout, hapus token aktif |

### Generate API Token Manual via Filament Panel:

1. Login ke `/admin`
2. Pergi ke menu **User > API Tokens** (jika `should_register_navigation` di-set `true`)
3. Klik **New Token**, beri nama, dan simpan token yang ditampilkan

### Mengaktifkan menu Token di Sidebar:

Di `src/config/api-service.php`:

```php
'navigation' => [
    'token' => [
        'should_register_navigation' => true, // ubah dari false ke true
        'group' => 'User',
    ],
],
```

---

## 12. Daftar Endpoint yang Dihasilkan

Setelah semua API Service di-generate, berikut endpoint lengkap yang tersedia:

> **Base URL:** `https://trial.test`  
> **Prefix:** `/api/admin/` (karena `panel_prefix = true` dan panel ID adalah `admin`)
> 
> Verifikasi route aktif (64 route terdaftar):
> ```bash
> dca route:list --path=api
> ```

| Method | URL | Deskripsi |
|--------|-----|-----------|
| **AUTH** | | |
| POST | `/api/auth/login` | Login |
| POST | `/api/auth/logout` | Logout |
| **SISWA** | | |
| GET | `/api/admin/siswas` | List semua siswa (paginated) |
| GET | `/api/admin/siswas/{id}` | Detail siswa |
| POST | `/api/admin/siswas` | Tambah siswa baru |
| PUT | `/api/admin/siswas/{id}` | Update siswa |
| DELETE | `/api/admin/siswas/{id}` | Hapus siswa |
| **BUKU** | | |
| GET | `/api/admin/bukus` | List semua buku |
| GET | `/api/admin/bukus/{id}` | Detail buku |
| POST | `/api/admin/bukus` | Tambah buku |
| PUT | `/api/admin/bukus/{id}` | Update buku |
| DELETE | `/api/admin/bukus/{id}` | Hapus buku |
| **DOKTER** | | |
| GET | `/api/admin/dokters` | List semua dokter |
| GET | `/api/admin/dokters/{id}` | Detail dokter |
| POST | `/api/admin/dokters` | Tambah dokter |
| PUT | `/api/admin/dokters/{id}` | Update dokter |
| DELETE | `/api/admin/dokters/{id}` | Hapus dokter |
| **PASIEN** | | |
| GET | `/api/admin/pasiens` | List semua pasien |
| GET | `/api/admin/pasiens/{id}` | Detail pasien |
| POST | `/api/admin/pasiens` | Tambah pasien |
| PUT | `/api/admin/pasiens/{id}` | Update pasien |
| DELETE | `/api/admin/pasiens/{id}` | Hapus pasien |
| **KONSULTASI** | | |
| GET | `/api/admin/konsultasis` | List konsultasi |
| GET | `/api/admin/konsultasis/{id}` | Detail konsultasi |
| POST | `/api/admin/konsultasis` | Tambah konsultasi |
| PUT | `/api/admin/konsultasis/{id}` | Update konsultasi |
| DELETE | `/api/admin/konsultasis/{id}` | Hapus konsultasi |
| **PRODUK** | | |
| GET | `/api/admin/produks` | List semua produk |
| GET | `/api/admin/produks/{id}` | Detail produk |
| POST | `/api/admin/produks` | Tambah produk |
| PUT | `/api/admin/produks/{id}` | Update produk |
| DELETE | `/api/admin/produks/{id}` | Hapus produk |
| **TRANSAKSI** | | |
| GET | `/api/admin/transaksis` | List transaksi |
| GET | `/api/admin/transaksis/{id}` | Detail transaksi |
| POST | `/api/admin/transaksis` | Buat transaksi |
| PUT | `/api/admin/transaksis/{id}` | Update transaksi |
| DELETE | `/api/admin/transaksis/{id}` | Hapus transaksi |
| **KOSTUMER** | | |
| GET | `/api/admin/kostumers` | List kostumer |
| GET | `/api/admin/kostumers/{id}` | Detail kostumer |
| POST | `/api/admin/kostumers` | Tambah kostumer |
| PUT | `/api/admin/kostumers/{id}` | Update kostumer |
| DELETE | `/api/admin/kostumers/{id}` | Hapus kostumer |
| **PEMINJAM** | | |
| GET | `/api/admin/peminjams` | List peminjam |
| GET | `/api/admin/peminjams/{id}` | Detail peminjam |
| POST | `/api/admin/peminjams` | Tambah peminjam |
| PUT | `/api/admin/peminjams/{id}` | Update peminjam |
| DELETE | `/api/admin/peminjams/{id}` | Hapus peminjam |
| **PINJAM** | | |
| GET | `/api/admin/pinjams` | List data pinjam |
| GET | `/api/admin/pinjams/{id}` | Detail data pinjam |
| POST | `/api/admin/pinjams` | Buat data pinjam |
| PUT | `/api/admin/pinjams/{id}` | Update data pinjam |
| DELETE | `/api/admin/pinjams/{id}` | Hapus data pinjam |
| **TAHUN AJARAN** | | |
| GET | `/api/admin/tahun-ajarans` | List tahun ajaran |
| GET | `/api/admin/tahun-ajarans/{id}` | Detail tahun ajaran |
| POST | `/api/admin/tahun-ajarans` | Tambah tahun ajaran |
| PUT | `/api/admin/tahun-ajarans/{id}` | Update tahun ajaran |
| DELETE | `/api/admin/tahun-ajarans/{id}` | Hapus tahun ajaran |
| **USER** | | |
| GET | `/api/admin/users` | List user |
| GET | `/api/admin/users/{id}` | Detail user |
| POST | `/api/admin/users` | Tambah user |
| PUT | `/api/admin/users/{id}` | Update user |
| DELETE | `/api/admin/users/{id}` | Hapus user |

---

## 13. Konfigurasi Lanjutan

### A. Nonaktifkan prefix panel

Jika ingin URL `/api/siswas` tanpa `/admin/`:

```php
// config/api-service.php
'route' => [
    'panel_prefix' => false,
],
```

### B. Tambahkan Middleware Custom

Di `AdminPanelProvider.php`:

```php
ApiServicePlugin::make()
    ->middleware([
        \App\Http\Middleware\CustomApiMiddleware::class,
    ]),
```

Atau per resource di kelas Resource:

```php
// Aktifkan dulu di config
// 'use_resource_middlewares' => true,

class SiswaResource extends Resource
{
    protected static string | array $routeMiddleware = [
        'throttle:60,1',
    ];
}
```

### C. Ubah Group Route Name (Prefix URL)

Di `SiswaApiService.php`:

```php
class SiswaApiService extends ApiService
{
    protected static string | null $resource = SiswaResource::class;
    protected static string | null $groupRouteName = 'siswa'; // custom prefix
}
```

### D. Menonaktifkan Handler Tertentu

Hapus handler yang tidak diperlukan dari array `handlers()`:

```php
public static function handlers(): array
{
    return [
        // Handlers\CreateHandler::class,  // ← dinonaktifkan
        // Handlers\UpdateHandler::class,  // ← dinonaktifkan
        // Handlers\DeleteHandler::class,  // ← dinonaktifkan
        Handlers\PaginationHandler::class,  // hanya read-only
        Handlers\DetailHandler::class,
    ];
}
```

---

## 14. Dokumentasi Otomatis (Scramble)

✅ **Sudah terinstal** — `dedoc/scramble` ada di `vendor/dedoc/`.

Akses dokumentasi di: **`https://trial.test/docs/api`**

Jika perlu install ulang:

```bash
docker exec trial_php composer require dedoc/scramble
dca vendor:publish --provider="Dedoc\Scramble\ScrambleServiceProvider"
```

---

## 15. Troubleshooting

### ❌ `Class not found` setelah generate

```bash
docker exec trial_php composer dump-autoload
```

### ❌ Token tidak bekerja / 401 Unauthenticated

- Pastikan `HasApiTokens` sudah ada di model `User` (sudah diperbaiki di proyek ini)
- Pastikan tabel `personal_access_tokens` ada: `dca migrate:status`
- Pastikan request menggunakan header: `Accept: application/json`

### ❌ Route API tidak muncul

```bash
dca route:clear
dca route:list --path=api
```

Pastikan `ApiServicePlugin::make()` sudah terdaftar di `AdminPanelProvider`.

> **Ingat:** Route API tidak ada di `routes/api.php` — didaftarkan otomatis oleh package.

### ❌ Permission denied (403 Forbidden)

- Jika menggunakan Filament Shield, pastikan role memiliki permission untuk resource tersebut
- Atau nonaktifkan policy di config:
  ```php
  'models' => [
      'token' => ['enable_policy' => false],
  ],
  ```

### ❌ Error `Class "PersonalAccessToken" not found`

Pastikan `HasApiTokens` sudah di-use di model `User`:

```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;
}
```

### ❌ Cache config lama

```bash
dca optimize:clear
```

---

## Ringkasan Perintah

> Semua perintah di bawah sudah dijalankan. Dokumentasi ini sebagai referensi jika perlu setup ulang.

```bash
# 1. Install API (Sanctum) — sudah selesai
dca install:api

# 2. Publish konfigurasi — sudah selesai
dca vendor:publish --tag=api-service-config

# 3. Generate API service untuk semua resource — sudah selesai
dca make:filament-api-service SiswaResource
dca make:filament-api-service BukuResource
dca make:filament-api-service DokterResource
dca make:filament-api-service PasienResource
dca make:filament-api-service KonsultasiResource
dca make:filament-api-service ProdukResource
dca make:filament-api-service TransaksiResource
dca make:filament-api-service KostumerResource
dca make:filament-api-service PeminjamResource
dca make:filament-api-service PinjamResource
dca make:filament-api-service TahunAjaranResource
dca make:filament-api-service UserResource

# 4. (Opsional) Generate transformer
dca make:filament-api-transformer NamaModel

# 5. Autoload ulang
docker exec trial_php composer dump-autoload

# 6. Clear cache
dca optimize:clear

# 7. Cek semua route API (hasil: 64 routes)
dca route:list --path=api
```
