-- =============================================
-- Database: dpr_gaji_db
-- Sistem Informasi Penggajian Anggota DPR RI
-- =============================================

-- Buat database
CREATE DATABASE IF NOT EXISTS `dpr_gaji_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dpr_gaji_db`;

-- =============================================
-- Tabel: users (untuk autentikasi)
-- =============================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabel: anggota (data anggota DPR)
-- =============================================
CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) DEFAULT NULL,
  `gelar_depan` varchar(50) DEFAULT NULL,
  `gelar_belakang` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) NOT NULL,
  `status_pernikahan` enum('Belum Menikah','Menikah','Cerai') DEFAULT 'Belum Menikah',
  `jumlah_anak` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabel: komponen_gaji
-- =============================================
CREATE TABLE IF NOT EXISTS `komponen_gaji` (
  `id_komponen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_komponen` varchar(100) NOT NULL,
  `jenis` enum('Gaji Pokok','Tunjangan','Potongan') NOT NULL,
  `nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_komponen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabel: penggajian
-- =============================================
CREATE TABLE IF NOT EXISTS `penggajian` (
  `id_penggajian` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `gaji_pokok` decimal(15,2) DEFAULT 0.00,
  `total_tunjangan` decimal(15,2) DEFAULT 0.00,
  `total_potongan` decimal(15,2) DEFAULT 0.00,
  `gaji_bersih` decimal(15,2) DEFAULT 0.00,
  `status` enum('Draft','Diproses','Dibayar') DEFAULT 'Draft',
  `tanggal_bayar` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_penggajian`),
  KEY `fk_anggota` (`id_anggota`),
  CONSTRAINT `fk_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabel: detail_penggajian
-- =============================================
CREATE TABLE IF NOT EXISTS `detail_penggajian` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_penggajian` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_detail`),
  KEY `idx_penggajian` (`id_penggajian`),
  KEY `idx_komponen` (`id_komponen`),
  CONSTRAINT `fk_detail_komponen` FOREIGN KEY (`id_komponen`) REFERENCES `komponen_gaji` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_penggajian` FOREIGN KEY (`id_penggajian`) REFERENCES `penggajian` (`id_penggajian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- INSERT DATA AWAL
-- =============================================

-- Insert default admin user
-- Password: admin123 (hashed dengan password_hash)
INSERT INTO `users` (`username`, `password`, `nama_depan`, `nama_belakang`, `role`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'Sistem', 'admin'),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'User', 'Demo', 'user');

-- Insert contoh data anggota
INSERT INTO `anggota` (`nama_depan`, `nama_belakang`, `gelar_depan`, `gelar_belakang`, `jabatan`, `status_pernikahan`, `jumlah_anak`) VALUES
('Ahmad', 'Budiman', 'Dr.', 'S.H., M.H.', 'Ketua DPR', 'Menikah', 2),
('Siti', 'Nurhaliza', 'Ir.', 'M.T.', 'Wakil Ketua DPR', 'Menikah', 3),
('Budi', 'Santoso', '', 'S.E., M.M.', 'Anggota Komisi I', 'Menikah', 1),
('Dewi', 'Lestari', 'Dra.', 'M.Pd.', 'Anggota Komisi II', 'Belum Menikah', 0),
('Rahman', 'Hakim', 'H.', 'S.Ag., M.H.I.', 'Anggota Komisi III', 'Menikah', 4);

-- Insert komponen gaji
INSERT INTO `komponen_gaji` (`nama_komponen`, `jenis`, `nominal`, `keterangan`) VALUES
('Gaji Pokok Ketua DPR', 'Gaji Pokok', 62000000.00, 'Gaji pokok untuk Ketua DPR'),
('Gaji Pokok Wakil Ketua', 'Gaji Pokok', 56000000.00, 'Gaji pokok untuk Wakil Ketua DPR'),
('Gaji Pokok Anggota', 'Gaji Pokok', 45000000.00, 'Gaji pokok untuk Anggota DPR'),
('Tunjangan Jabatan', 'Tunjangan', 15000000.00, 'Tunjangan jabatan struktural'),
('Tunjangan Keluarga', 'Tunjangan', 5000000.00, 'Tunjangan untuk keluarga'),
('Tunjangan Anak', 'Tunjangan', 2000000.00, 'Tunjangan per anak (maksimal 3 anak)'),
('Tunjangan Kinerja', 'Tunjangan', 10000000.00, 'Tunjangan berdasarkan kinerja'),
('Potongan BPJS', 'Potongan', 500000.00, 'Potongan BPJS Kesehatan'),
('Potongan Pajak', 'Potongan', 8000000.00, 'Potongan Pajak Penghasilan (PPh 21)'),
('Potongan Lain-lain', 'Potongan', 1000000.00, 'Potongan administrasi dan lain-lain');

-- Insert contoh data penggajian
INSERT INTO `penggajian` (`id_anggota`, `bulan`, `tahun`, `gaji_pokok`, `total_tunjangan`, `total_potongan`, `gaji_bersih`, `status`, `tanggal_bayar`) VALUES
(1, 1, 2026, 62000000.00, 32000000.00, 9500000.00, 84500000.00, 'Dibayar', '2026-01-25'),
(2, 1, 2026, 56000000.00, 25000000.00, 9500000.00, 71500000.00, 'Dibayar', '2026-01-25'),
(3, 1, 2026, 45000000.00, 17000000.00, 9500000.00, 52500000.00, 'Diproses', NULL),
(4, 1, 2026, 45000000.00, 15000000.00, 9500000.00, 50500000.00, 'Draft', NULL),
(5, 1, 2026, 45000000.00, 23000000.00, 9500000.00, 58500000.00, 'Draft', NULL);

-- =============================================
-- SELESAI
-- =============================================
