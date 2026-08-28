# AGENTS.md

Panduan untuk sesi OpenCode di repository ini.

## Cara Memulai
- Pastikan Laragon sudah berjalan dengan MySQL pada port 3306
- Database aktif adalah `db_tiket_wisata_copy` (lihat `application/config/database.php`)
- Jalankan PHP built-in server: `php -S localhost:8000`
- Akses aplikasi di: `http://localhost/etiket-pkl` (atau `http://localhost:8000` jika pakai PHP server)

## Akses Database
- MySQL berada di Laragon bin: `D:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe`
- Akses database: `mysql -u root -e "USE db_tiket_wisata_copy; SHOW TABLES;"`
- Password root database menggunakan Laragon default (normalnya kosong)

## Architektur Aplikasi
- CodeIgniter 3 (PHP Framework)
- MVC pattern: controllers, models, views
- Entry point: `index.php`
- Default controller: Auth (login)

## Struktur Direktori Kunci
- `application/controllers/` - Logic utama aplikasi
- `application/models/` - Database models
- `application/views/` - Template dan halaman HTML
- `application/config/` - Konfigurasi aplikasi
- `db_tiket_wisata_copy.sql` - Backup database aktif
- `uploads/objek_wisata/` - Foto objek wisata (buat jika belum ada)

## Peran Pengguna
- **Admin**: Akses penuh ke semua fitur
- **Kasir**: Penjualan tiket + validasi
- **Petugas**: Hanya validasi tiket

## Penting Sebelum Mengembangkan
1. Pastikan database `db_tiket_wisata_copy` sudah ter-import
2. Folder upload harus dibuat: `mkdir application/uploads/objek_wisata`
3. CSRF protection sudah aktif - semua form AJAX perlu token
4. Password di-hash dengan `password_hash()` dan diverifikasi dengan `password_verify()`

## Debugging
- Periksa log di `application/logs/`
- Gunakan `php -l <file>` untuk cek syntax error
- Gunakan MySQL untuk inspeksi data: `SELECT * FROM tbl_transaksi LIMIT 5;`
