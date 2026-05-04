-- Membuat database mini_kasir
CREATE DATABASE IF NOT EXISTS mini_kasir;

-- Menggunakan database
USE mini_kasir;

-- Tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role ENUM('admin', 'kasir') NOT NULL
);

-- Tabel barang
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL
);

-- Tabel transaksi
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATETIME NOT NULL,
    total INT NOT NULL,
    bayar INT NOT NULL,
    kembalian INT NOT NULL,
    user_id INT NOT NULL
);

-- Insert data contoh untuk users
INSERT INTO users (username, password, role) VALUES ('admin', 'admin123', 'admin');
INSERT INTO users (username, password, role) VALUES ('kasir', 'kasir123', 'kasir');

-- Insert data contoh untuk barang
INSERT INTO barang (nama_barang, harga, stok) VALUES ('Buku', 5000, 100);
INSERT INTO barang (nama_barang, harga, stok) VALUES ('Pensil', 2000, 50);