# Sistem Informasi Penggajian Anggota DPR RI

## 📋 Informasi Mahasiswa

| Attribute | Keterangan |
|-----------|-----------|
| **Nama** | Ersya Hasby Satria |
| **NIM** | 241511072 |
| **Kelas** | 2C |
| **Mata Kuliah** | Desain dan Pemrograman Web |

## 📝 Deskripsi Proyek

Sistem Informasi Penggajian Anggota DPR RI adalah aplikasi web berbasis CodeIgniter 4 yang dirancang untuk mengelola data anggota Dewan Perwakilan Rakyat (DPR) RI beserta sistem penggajiannya. Aplikasi ini memiliki fitur lengkap untuk mengelola data anggota, komponen gaji, dan proses penggajian dengan antarmuka yang user-friendly.

## ✨ Fitur Utama

### 🔐 Sistem Autentikasi
- Login untuk admin
- Logout
- Session management
- Protected routes dengan filter

### 👥 Manajemen Anggota DPR
- Tambah data anggota (nama depan, nama belakang, gelar, jabatan, status pernikahan, jumlah anak)
- Edit data anggota
- Hapus data anggota
- Pencarian anggota berdasarkan nama dan jabatan
- View daftar anggota untuk publik dan admin

### 💰 Manajemen Komponen Gaji
- Tambah komponen gaji baru
- Edit komponen gaji
- Hapus komponen gaji
- Daftar semua komponen gaji

### 💵 Manajemen Penggajian
- Input data penggajian anggota
- Edit data penggajian
- Hapus data penggajian
- Lihat detail penggajian lengkap
- View penggajian untuk publik

### 📊 Dashboard
- Dashboard admin dengan informasi ringkasan
- Dashboard publik untuk melihat data

## 🛠️ Teknologi yang Digunakan

- **Framework**: CodeIgniter 4
- **Database**: MySQL
- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP 8.1+
- **Server**: XAMPP (Apache + MySQL)

## 📂 Struktur Database

### Tabel `anggota`
- `id_anggota` (Primary Key)
- `nama_depan`
- `nama_belakang`
- `gelar_depan`
- `gelar_belakang`
- `jabatan`
- `status_pernikahan`
- `jumlah_anak`

### Tabel `komponen_gaji`
- Data komponen gaji (gaji pokok, tunjangan, dll)

### Tabel `penggajian`
- Data penggajian anggota

### Tabel `users`
- Data pengguna untuk autentikasi

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.1
- MySQL/MariaDB
- XAMPP atau web server lainnya
- Composer (optional)

### Langkah Instalasi

1. **Clone atau Download Repository**
   ```bash
   git clone <repository-url>
   cd DPR_241511072_2C_ErsyaHasbySatria
   ```

2. **Konfigurasi Database**
   - Buat database baru di phpMyAdmin
   ```sql
   CREATE DATABASE db_dpr;
   ```
   
3. **Setting Database di CodeIgniter**
   - Buka file `app/Config/Database.php`
   - Sesuaikan konfigurasi database:
   ```php
   public array $default = [
       'hostname' => 'localhost',
       'username' => 'root',
       'password' => '',
       'database' => 'db_dpr',
       'DBDriver' => 'MySQLi',
   ];
   ```

4. **Import Database**
   - Import file SQL yang tersedia (jika ada) atau buat tabel sesuai struktur di atas

5. **Jalankan Aplikasi**
   - Pastikan XAMPP sudah running (Apache & MySQL)
   - Akses melalui browser:
   ```
   http://localhost/DPR_241511072_2C_ErsyaHasbySatria/public/
   ```

## 🔗 Routing & URL

### Public Routes
- `/` - Halaman utama
- `/login` - Halaman login
- `/anggota-publik` - Daftar anggota (akses publik)
- `/penggajian-publik` - Data penggajian (akses publik)

### Admin Routes (Perlu Login)
- `/admin/dashboard` - Dashboard admin
- `/admin/anggota` - Manajemen anggota
- `/admin/komponen-gaji` - Manajemen komponen gaji
- `/admin/penggajian` - Manajemen penggajian

## 👤 Default Login

```
Username: admin
Password: admin123
```
*(Sesuaikan dengan data yang ada di tabel users)*

## 📸 Screenshot

*(Tambahkan screenshot aplikasi di sini jika diperlukan)*

## 🎯 Fitur Keamanan

- Filter autentikasi untuk halaman admin
- Session management
- CSRF Protection (bawaan CodeIgniter 4)
- Validasi input data
- Password hashing

## 📱 Responsive Design

Aplikasi ini menggunakan Bootstrap untuk memastikan tampilan responsif di berbagai ukuran layar (desktop, tablet, mobile).

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik.

## 👨‍💻 Pengembang

**Ersya Hasby Satria**  
NIM: 241511072  
Kelas: 2C

---

© 2026 - Sistem Informasi Penggajian Anggota DPR RI
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
