## Project 6 Pemrograman Berbasis Web Lanjutan FST UIN Sumatera Utara

PHP MVC sederhana: login, dashboard, kategori, produk (dengan foto), dan user.

## Cara menjalankan
1. Pastikan Apache dan MySQL (XAMPP) aktif, lalu taruh folder ini di `htdocs`.
2. Jalankan `database.sql` di phpMyAdmin (membuat database `dbproject6`).
3. Sesuaikan koneksi di `app/core/Model.php` jika user/password MySQL berbeda (bawaan: root / root).
4. Buka `http://localhost/project7/` (alamat otomatis menyesuaikan folder, tidak perlu mengubah `inc/config.php`).
5. Login dengan akun awal:
   * Email: `admin@mail.com`
   * Password: `admin`

## Struktur
* app/core - Bootstrap (router), Controller, Model, Error
* app/controllers - Index (login), Dashboard, Kategori, Produk, User
* app/models - Kategori, Produk, User
* app/views - tampilan tiap halaman
* layouts - dashboard.php (setelah login) dan login.php
* inc/config.php - konfigurasi URL, session, autoload, Whoops

## Alamat uji
```
http://localhost/project7/
http://localhost/project7/dashboard
http://localhost/project7/kategori
http://localhost/project7/produk
http://localhost/project7/user
```

## Composer
Folder `vendor/` sudah disertakan. Jika hilang: `composer install`.
