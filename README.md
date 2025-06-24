# Proyek Kantin R6J

Ini adalah aplikasi web sederhana untuk sistem pemesanan di "Kantin R6J". Aplikasi ini dibuat menggunakan PHP native, Bootstrap, dan JavaScript.

## Fitur
- Melihat daftar menu makanan dan minuman.
- Menambahkan item ke dalam keranjang belanja secara dinamis (AJAX).
- Mengupdate dan menghapus item dari keranjang.
- Melakukan checkout pesanan.
- Menyimpan data pesanan ke database.

## Prasyarat
- Web Server (contoh: XAMPP, Nginx)
- PHP 7.4 atau lebih baru
- MySQL atau MariaDB

## Cara Instalasi
1.  **Clone repositori ini:**
    ```bash
    git clone https://github.com/VladR382/web-kantin-rj.git
    ```
2.  **Pindah ke direktori proyek:**
    ```bash
    cd web-kantin-rj
    ```
3.  **Buat Database:**
    - Buat database baru di MySQL (misalnya dengan nama `kantin_r6j`).
    - Impor file `database_schema.sql` (Anda perlu membuat file ini, lihat poin berikutnya) ke dalam database yang baru Anda buat.

4.  **Konfigurasi Koneksi:**
    - Salin file `config.example.php` menjadi `config.php`.
    - Buka file `config.php` dan sesuaikan kredensial database (`$db_host`, `$db_user`, `$db_pass`, `$db_name`) dengan konfigurasi Anda.

5.  **Jalankan Aplikasi:**
    - Pindahkan folder proyek ke dalam direktori `htdocs` (jika menggunakan XAMPP) atau direktori root web server Anda.
    - Buka browser dan akses `http://localhost/nama-folder-proyek`.

## Struktur Folder
- `img/`: Berisi semua gambar untuk produk dan tampilan.
- `cart_actions.php`: Logika untuk menangani aksi pada keranjang (tambah, hapus).
- `checkout.php`: Halaman untuk mengisi data pembeli dan metode pembayaran.
- `config.php`: (DIIABAIKAN oleh Git) Berisi koneksi ke database.
- `index.php`: Halaman utama yang menampilkan menu.
- `simpan.php`: Skrip untuk menyimpan pesanan ke database.
- `style.css`: File styling untuk tampilan.
