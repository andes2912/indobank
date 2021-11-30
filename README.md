<img src="https://banners.beyondco.de/Laravel%20List%20Name%20Bank%20Indonesia.png?theme=light&packageManager=composer+require&packageName=andes2912%2Findobank&pattern=architect&style=style_1&description=Package+Laravel+Daftar+Bank+di+Indonesia&md=1&showWatermark=0&fontSize=100px&images=credit-card" />

[![Latest Stable Version](http://poser.pugx.org/andes2912/indobank/v)](https://packagist.org/packages/andes2912/indobank) 
[![Total Downloads](http://poser.pugx.org/andes2912/indobank/downloads)](https://packagist.org/packages/andes2912/indobank) 
[![Latest Unstable Version](http://poser.pugx.org/andes2912/indobank/v/unstable)](https://packagist.org/packages/andes2912/indobank) 
[![License](http://poser.pugx.org/andes2912/indobank/license)](https://packagist.org/packages/andes2912/indobank)

```andes2912/indobank``` adalah sebuah package Laravel untuk menyimpan data Nama Bank yang ada di Indonesia. Package akan menambahkan migrations, seeder (untuk import data ke database) dan Model pada project Anda.

Semua data akan disimpan di database, untuk mengambil data tersebut sama dengan mengambil data lewat Model pada umum-nya (Lihat bagian Usage).

Data ini diambil dari situs FLIP (https://flip.id/kode-bank/) pada 11 Agustus 2021 & ATM Bersama (http://www.atmbersama.com/layanan).

## Quick Instalation

Buka Command Line kemudian jalankan perintah dibawah untuk melakukan instalasi package:
```
composer require andes2912/indobank
```

## Supported Versions

| Laravel Version | Version | Composer Installation |
|---- |----|----|
| 6,7,8 | >= 0.3 | ```composer require andes2912/indobank``` |

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
Jalankan perintah dibawah di Command Line:

```
php artisan indobank:publish
``` 
  
Saat perintah diatas dijalankan, indobank akan menyalin:

* Files migration dari ```/packages/andes2912/indobank/src/database/migrations``` ke ```/database/migrations```
* Files seeder dari ```/packages/andes2912/indobank/src/database/seeds``` ke ```/database/seeds```
* Files model dari ```/packages/andes2912/indobank/src/database/models``` ke ```/app/Models```

Setelah itu jalankan perintah dibawah:
```
composer dump-autoload
```

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
