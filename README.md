# Setia Furniture Jepara 🪑

Sistem manajemen e-commerce untuk toko furnitur yang dibangun menggunakan PHP dan MongoDB. Website ini dirancang khusus untuk mengelola dan memasarkan produk furnitur berkualitas dari Jepara.

## 📋 Deskripsi

Setia Furniture Jepara adalah platform e-commerce yang menghadirkan keindahan dan kualitas furnitur Jepara ke dunia digital. Sistem ini menyediakan antarmuka yang mudah digunakan untuk pelanggan dalam menjelajahi dan membeli produk, serta panel admin yang komprehensif untuk pengelolaan toko.

## 🚀 Fitur Utama

- **Katalog Produk**
  - Tampilan produk yang menarik dengan gambar berkualitas tinggi
  - Pencarian dan filter produk
  - Kategorisasi produk yang terstruktur
  
- **Manajemen Pesanan**
  - Sistem keranjang belanja
  - Pelacakan status pesanan
  - Riwayat pembelian
  - Cetak invoice

- **Panel Admin**
  - Dashboard informatif
  - Manajemen produk dan kategori
  - Pengelolaan pesanan
  - Manajemen pelanggan

- **Keamanan**
  - Autentikasi pengguna
  - Enkripsi data sensitif
  - Validasi input

## 💻 Teknologi yang Digunakan

- **Backend**
  - PHP 7.4+
  - MongoDB 4.4+
  - Composer (Package Manager)

- **Frontend**
  - HTML5
  - Bootstrap 5
  - JavaScript
  - Font Awesome 6

- **Tools & Library**
  - MongoDB PHP Driver
  - PSR Log
  - Symfony Polyfills

## 📁 Struktur Proyek

```
furniture/
├── assets/          # File statis (CSS, JS, gambar)
│   └── img/         # Gambar produk dan aset visual
├── categories/      # Modul kategori produk
├── config/         # Konfigurasi aplikasi
├── customers/      # Manajemen pelanggan
├── includes/       # File-file yang dapat digunakan ulang
├── orders/         # Sistem pemesanan
├── products/       # Manajemen produk
└── vendor/         # Dependensi pihak ketiga
```

## ⚙️ Prasyarat

- PHP versi 7.4 atau lebih tinggi
- MongoDB versi 4.4 atau lebih tinggi
- MongoDB PHP Driver
- Composer
- Web Server (Apache/Nginx)
- Web Browser modern

## 🛠️ Panduan Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/NoHeart6/furnitur-jepara.git
   cd furnitur-jepara
   ```

2. **Install Dependensi**
   ```bash
   composer install
   ```

3. **Konfigurasi Database**
   - Buat database MongoDB baru bernama 'furniture'
   - Sesuaikan konfigurasi di `config/config.php`:
     ```php
     $db = (new MongoDB\Client)->furniture;
     ```

4. **Inisialisasi Database**
   ```bash
   php init_db.php
   ```

5. **Konfigurasi Web Server**
   - Arahkan document root ke direktori proyek
   - Pastikan mod_rewrite diaktifkan untuk Apache
   - Sesuaikan permission folder:
     ```bash
     chmod 755 -R assets/img/products/
     ```

6. **Akses Aplikasi**
   - Buka browser dan akses: `http://localhost/furniture`
   - Login admin default:
     - Username: admin
     - Password: admin123

## 🔒 Keamanan

- Gunakan HTTPS untuk produksi
- Ubah kredensial default setelah instalasi
- Batasi akses ke folder sensitif
- Update dependensi secara berkala
- Backup database secara rutin

## 🤝 Kontribusi

Kami sangat menghargai kontribusi Anda. Untuk berkontribusi:

1. Fork repository
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📝 Lisensi

Hak Cipta © 2024 Setia Furniture Jepara. Dilindungi Undang-undang.

## 📞 Kontak & Dukungan

- **Website**: [www.setiafurniturejepara.com](http://www.setiafurniturejepara.com)
- **Email**: info@setiafurniturejepara.com
- **WhatsApp**: +62 812-3456-7890
- **Alamat**: Jl. Raya Jepara No. 123, Jepara, Jawa Tengah

## 🙏 Penghargaan

Terima kasih kepada semua pengrajin furnitur Jepara yang telah memberikan produk berkualitas tinggi untuk dipasarkan melalui platform ini.