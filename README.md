<img src="https://banners.beyondco.de/Laravel%20List%20Name%20Bank%20Indonesia.png?theme=light&packageManager=composer+require&packageName=andes2912%2Findobank&pattern=architect&style=style_1&description=Package+Laravel+Daftar+Bank+di+Indonesia&md=1&showWatermark=0&fontSize=100px&images=credit-card" />

[![Latest Stable Version](http://poser.pugx.org/andes2912/indobank/v)](https://packagist.org/packages/andes2912/indobank) 
[![Total Downloads](http://poser.pugx.org/andes2912/indobank/downloads)](https://packagist.org/packages/andes2912/indobank) 
[![License](http://poser.pugx.org/andes2912/indobank/license)](https://packagist.org/packages/andes2912/indobank)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andes2912/indobank/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andes2912/indobank/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/andes2912/indobank/badges/build.png?b=master)](https://scrutinizer-ci.com/g/andes2912/indobank/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/andes2912/indobank/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

```andes2912/indobank``` adalah sebuah package Laravel untuk menyimpan data Nama Bank yang ada di Indonesia. Package akan menambahkan migrations, seeder (untuk import data ke database) dan Model pada project Anda.

Semua data akan disimpan di database, untuk mengambil data tersebut sama dengan mengambil data lewat Model pada umum-nya (Lihat bagian Usage).

Data diambil dari **Tabel Sandi Bank resmi BCA per 31 Maret 2026** (https://pustaka.bca.co.id/bisnis/layanan/e-banking-bisnis/klikbca-bisnis/data-bank-update-31-maret-2026.pdf). Berisi 123 entri bank umum + Unit Usaha Syariah, termasuk bank digital terbaru (Super Bank, Krom Bank, Bank Saqu, Allo Bank, Bank Jago, dll).

Catatan: Beberapa kode bank (`sandi_bank`) tidak unik — misalnya `022` digunakan oleh Bank CIMB Niaga konvensional & Unit Usaha Syariah-nya. Karena itu kolom `sandi_bank` di-index, bukan unique.

## Quick Instalation

Buka Command Line kemudian jalankan perintah dibawah untuk melakukan instalasi package:
```
composer require andes2912/indobank
```

## Supported Versions

| Laravel Version | Version | Composer Installation |
|---- |----|----|
| 6, 7, 8, 9, 10, 11, 12 | >= 0.8 | ```composer require andes2912/indobank``` |

### Register Service Provider

#### Laravel

Jika Anda menggunakan Laravel versi 5.5 keatas Anda bisa skip bagian ini karena package indo-bank sudah menggunakan Package Auto Discovery.  
  
Tapi jika kebetulan Project yang Anda kerjakan masih menggunakan versi dibawah 5.5 maka silahkan untuk membuka file **config/app.php** lalu tambahkan Class ```IndoBankServiceProvider``` kedalam array Service Providers:
```
// Provider Lain
Andes2912\IndoBank\IndoBankServiceProvider::class,
```

#### Lumen

Jika Anda ingin menggunakan Package ini pada project Lumen, maka Anda harus melakukan register Service Provider pada file ```bootstrap/app.php``` dengan menambahkan ini:

```
$app->register(Andes2912\IndoBank\IndoBankServiceProvider::class);
```

### Publish File

Cara yang direkomendasikan (standard Laravel `vendor:publish`):

```
# Publish semua (migrations + seeders + model)
php artisan vendor:publish --tag=indobank

# Atau publish per-bagian:
php artisan vendor:publish --tag=indobank-migrations
php artisan vendor:publish --tag=indobank-seeders
php artisan vendor:publish --tag=indobank-models
```

Atau cara lama (masih didukung untuk backward-compatibility):

```
php artisan indobank:publish
```

Saat perintah diatas dijalankan, indobank akan menyalin:

* Files migration dari ```/vendor/andes2912/indobank/src/database/migrations``` ke ```/database/migrations```
* Files seeder dari ```/vendor/andes2912/indobank/src/database/seeders``` ke ```/database/seeders```
* Files model dari ```/vendor/andes2912/indobank/src/database/models``` ke ```/app/Models```

Setelah itu jalankan perintah dibawah:
```
composer dump-autoload
```

> Catatan: package ini juga otomatis `loadMigrationsFrom()`, jadi Anda bisa langsung `php artisan migrate` tanpa publish jika tidak perlu meng-custom migration.

### Migrate and Seeder
Jalankan perintah dibawah untuk menjalankan migration dan seeder:
```
php artisan migrate

# Import semua data Nama Bank
php artisan db:seed --class=IndoBankSeeder 

```

## Basic Usage
Anda bisa gunakan class dibawah seperti model pada umum-nya.
  
```
<?php

use App\Models\Bank;

// Get semua data
$bank = Bank::all();

// Cari berdasarkan nama bank
$bank = Bank::where('nama_bank', 'BANK BRI')->first();
$bank = Bank::where('nama_bank', 'LIKE', '%BANK BRI%')->first();

```

## Tanpa Database (CSV Helper)

Jika Anda tidak ingin menggunakan database (mis. hanya butuh list bank di form), package ini juga menyediakan helper yang membaca langsung dari CSV bawaan:

```
<?php

use Andes2912\IndoBank\IndoBank;

$indo = app(IndoBank::class);

// Semua bank
$banks = $indo->getBanks();

// Pencarian (partial, case-insensitive)
$result = $indo->searchBanks('BRI');

// Pencarian exact berdasarkan kolom
$bca = $indo->findBank('sandi_bank', '014');
```
