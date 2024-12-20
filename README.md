# Setia Furniture Jepara

Sistem manajemen e-commerce untuk toko furnitur yang dibangun menggunakan PHP dan MongoDB.

## 📋 Deskripsi

Setia Furniture Jepara adalah platform e-commerce yang menyediakan berbagai produk furnitur berkualitas dari Jepara. Website ini memungkinkan pelanggan untuk melihat katalog produk, melakukan pemesanan, dan administrator dapat mengelola produk, kategori, serta pesanan.

## 🚀 Fitur Utama

- Manajemen Produk
- Manajemen Kategori
- Sistem Pemesanan
- Manajemen Pelanggan
- Interface yang Modern dan Responsif

## 💻 Teknologi yang Digunakan

- PHP
- MongoDB
- Bootstrap 5
- Font Awesome
- Composer (PHP Package Manager)

## 📁 Struktur Proyek

```
furniture/
├── assets/          # File statis (CSS, JS, gambar)
├── categories/      # Manajemen kategori
├── config/         # File konfigurasi
├── customers/      # Manajemen pelanggan
├── includes/       # File-file yang dapat digunakan ulang
├── orders/         # Manajemen pesanan
├── products/       # Manajemen produk
├── vendor/         # Dependensi pihak ketiga
├── .htaccess      # Konfigurasi Apache
├── collections.php # Manajemen koleksi
├── composer.json   # Konfigurasi dependensi
├── config.php     # Konfigurasi utama
├── index.php      # Halaman utama
└── init_db.php    # Inisialisasi database
```

## ⚙️ Prasyarat

- PHP 7.4 atau lebih tinggi
- MongoDB
- Composer
- Web Server (Apache/Nginx)

## 🛠️ Instalasi

1. Clone repositori ini:
```bash
git clone [url-repositori]
```

2. Masuk ke direktori proyek:
```bash
cd furniture
```

3. Install dependensi menggunakan Composer:
```bash
composer install
```

4. Konfigurasi MongoDB:
   - Buat database baru bernama 'furniture'
   - Sesuaikan konfigurasi koneksi di `config.php`

5. Inisialisasi database:
```bash
php init_db.php
```

6. Konfigurasi web server:
   - Arahkan document root ke direktori proyek
   - Pastikan mod_rewrite diaktifkan (untuk Apache)

7. Akses aplikasi melalui browser:
```
http://localhost/furniture
```

## 🗃️ Struktur Database

Database MongoDB terdiri dari beberapa koleksi:
- `Categories`: Menyimpan kategori produk
- `Customers`: Data pelanggan
- `Orders`: Informasi pesanan
- `Products`: Data produk furnitur

## 🔒 Keamanan

- Gunakan environment variables untuk kredensial sensitif
- Pastikan folder `vendor` dan file konfigurasi tidak dapat diakses publik
- Selalu update dependensi ke versi terbaru yang aman

## 📝 Lisensi

[Sesuaikan dengan lisensi proyek]

## 👥 Kontributor

[Daftar kontributor proyek]

## 📞 Kontak

Untuk pertanyaan dan dukungan, silakan hubungi:
- Email: [email]
- Website: [website]
- Alamat: [alamat toko] 