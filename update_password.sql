-- Cara Paling Mudah: Buat user baru dengan password plain text
-- Lalu kita akan update password via PHP

USE dpr_gaji_db;

-- Hapus user lama
DELETE FROM users;

-- Insert user baru dengan password yang akan kita hash via aplikasi
-- Untuk sementara, kita set password simple dulu
INSERT INTO users (username, password, nama_depan, nama_belakang, role) VALUES
('admin', 'admin123', 'Admin', 'Sistem', 'admin'),
('user', 'user123', 'User', 'Demo', 'user');

SELECT * FROM users;

