CREATE DATABASE IF NOT EXISTS rt05_lokcari CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rt05_lokcari;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  nama VARCHAR(150) NOT NULL,
  role ENUM('ketua','bendahara','sekretaris','warga') DEFAULT 'warga',
  nik VARCHAR(30),
  no_hp VARCHAR(30),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE warga (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nik VARCHAR(20) UNIQUE,
  no_kk VARCHAR(20),
  nama VARCHAR(150),
  ttl VARCHAR(100),
  jk ENUM('L','P'),
  alamat TEXT,
  rt VARCHAR(10),
  rw VARCHAR(10),
  agama VARCHAR(50),
  status_perkawinan VARCHAR(50),
  pendidikan VARCHAR(100),
  pekerjaan VARCHAR(150),
  status_tinggal VARCHAR(50),
  no_hp VARCHAR(30),
  tanggal_masuk DATE,
  foto VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE iuran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  warga_id INT,
  jenis VARCHAR(100),
  bulan TINYINT,
  tahun SMALLINT,
  nominal DECIMAL(15,2),
  status ENUM('lunas','belum') DEFAULT 'belum',
  bayar_tanggal DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE surat (
  id INT AUTO_INCREMENT PRIMARY KEY,
  warga_id INT,
  jenis VARCHAR(100),
  nomor_surat VARCHAR(100),
  isi TEXT,
  file_pdf VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE pengumuman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(200),
  isi TEXT,
  tanggal DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE dokumen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(200),
  file_path VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- admin: admin_rt05 / rt05admin
INSERT INTO users (username,password,nama,role,no_hp) VALUES
('admin_rt05','$2y$10$u1k8nA1qfZ4kqQk7bZkQXOZ6.1J9q6j8bF6zTB3dQKzGx9H1a7eG6','Joko Susanto','ketua','08123456789');