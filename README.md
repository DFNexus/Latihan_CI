# Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/). Sistem ini menyediakan beberapa fungsionalitas untuk toko online, termasuk manajemen produk, keranjang belanja, dan sistem transaksi.

## Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)

## Fitur

-Autentikasi User & Admin
  -Login dan Logout
  -Role berbasis session (admin / user)

-Manajemen Produk
  -Kategori Produk
  -Detail Produk
  -Gambar & Harga Produk
  
-Keranjang Belanja (Cart)
  -Tambah produk ke keranjang
  -Edit jumlah item
  -Hapus item dari keranjang

-Transaksi Pembelian
  -Simpan transaksi dan detail item
  -Hitung total harga dan diskon otomatis

-Manajemen Diskon
  -Diskon harian berdasarkan tanggal (diskon.tanggal)
  -Ditampilkan otomatis di header jika tersedia
  -Hanya admin yang bisa menambah/mengedit/hapus diskon
  -Validasi: Tidak boleh ada tanggal duplikat

-Dashboard Webservice
  -Menggunakan curl ke endpoint API
  -Menampilkan data pembelian dan jumlah item tiap transaksi

-Seeder & Migration
  -Seeder DiskonSeeder otomatis isi 10 diskon dari tanggal hari ini
  -Migration Diskon untuk membuat tabel diskon


TABEL DATABASE YABG DIGUNAKAN :
-users (login, role)
-produk (produk dan harga)
-transactions (data utama transaksi)
-transaction_details (item per transaksi)
-diskon (tanggal, nominal diskon harian)

FITUR TAMBAHAN :
-Penyesuaian waktu dengan timezone Asia/Jakarta
-Session menyimpan nilai diskon dan otomatis digunakan di keranjang dan transaksi
-Hitung subtotal setelah dikurangi diskon (benar di database dan tampilan)

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Web server (XAMPP)

## Instalasi

1. **Clone repository ini**
   ```bash
   git clone [URL repository]
   cd belajar-ci-tugas
   ```
2. **Install dependensi**
   ```bash
   composer install
   ```
3. **Konfigurasi database**

   - Start module Apache dan MySQL pada XAMPP
   - Buat database **db_ci4** di phpmyadmin.
   - copy file .env dari tutorial https://www.notion.so/april-ns/Codeigniter4-Migration-dan-Seeding-045ffe5f44904e5c88633b2deae724d2

4. **Jalankan migrasi database**
   ```bash
   php spark migrate
   ```
5. **Seeder data**
   ```bash
   php spark db:seed ProductSeeder
   ```
   ```bash
   php spark db:seed UserSeeder
   ```
6. **Jalankan server**
   ```bash
   php spark serve
   ```
7. **Set Timezone**
  ```bash
  date_default_timezone_set('Asia/Jakarta');
  ```
8. **Akses aplikasi**
   Buka browser dan akses `http://localhost:8080` untuk melihat aplikasi.

## Struktur Proyek

Proyek menggunakan struktur MVC CodeIgniter 4:

- app/Controllers - Logika aplikasi dan penanganan request
  - AuthController.php - Autentikasi pengguna
  - ProdukController.php - Manajemen produk
  - TransaksiController.php - Proses transaksi
- app/Models - Model untuk interaksi database
  - ProductModel.php - Model produk
  - UserModel.php - Model pengguna
- app/Views - Template dan komponen UI
  - v_produk.php - Tampilan produk
  - v_keranjang.php - Halaman keranjang
- public/img - Gambar produk dan aset
- public/NiceAdmin - Template admin
- app/Controllers - Logika aplikasi dan penanganan request
  - AuthController.php - Autentikasi pengguna dan set session diskon
  - TransaksiController.php - Proses keranjang, checkout, simpan transaksi dan diskon
  - ApiController.php - Webservice API untuk dashboard (mengirim jumlah item)
  - DiskonController.php - CRUD diskon (khusus admin)

- app/Models - Model untuk interaksi database
  - UserModel.php - Model pengguna
  - ProductModel.php - Model produk
  - TransactionModel.php - Model transaksi utama
  - TransactionDetailModel.php - Model detail item dalam transaksi
  - DiskonModel.php - Model untuk diskon harian

- app/Views - Template dan komponen UI
  - v_produk.php - Tampilan produk
  - v_keranjang.php - Halaman keranjang
  - v_checkout.php - Checkout sebelum transaksi
  - v_diskon.php - Tampilan kelola diskon (admin)
  - components/header.php - Menampilkan diskon harian di header jika tersedia

- app/Database/Migrations - Struktur tabel database
  - 2025-07-04-184415_Diskon.php - Tabel "diskon" (tanggal, nominal, timestamps)

- app/Database/Seeds - Data awal (dummy)
  - DiskonSeeder.php - Isi 10 diskon untuk 10 hari mulai hari ini (100000, 200000, 300000 berulang)

- public - Akses frontend dan dashboard
  - index.php - Dashboard webservice (dengan curl dan Bootstrap)
  - img/ - Gambar produk
  - NiceAdmin/ - Template admin panel
