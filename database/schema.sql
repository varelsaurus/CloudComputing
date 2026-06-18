-- Create Database
CREATE DATABASE IF NOT EXISTS db_cloud;
USE db_cloud;

-- Create Users Table for Authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL
);

-- Insert Default Admin User (Password is 'password123' using MD5 for simplicity in local dev)
-- For production, bcrypt/password_hash should be used.
INSERT INTO users (username, password, nama_lengkap) 
VALUES ('admin', MD5('password123'), 'Administrator');

-- Create Anggota Kelompok Table
CREATE TABLE IF NOT EXISTS anggota_kelompok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    peran VARCHAR(50) NOT NULL,
    foto VARCHAR(255) DEFAULT 'https://via.placeholder.com/150'
);

-- Insert 5 Members of SI4703
INSERT INTO anggota_kelompok (nim, nama, peran, foto) VALUES
('102022300018', 'Muhammad Fadli Deandri Putra', 'Project Manager', 'assets/images/fadli.jpg'),
('102022300287', 'Naswa Gyna Sahira', 'UI Front-End', 'assets/images/gyna.jpg'),
('102022300088', 'Muhammad Varel Arifianta', 'Backend & DB', 'assets/images/varel.jpg'),
('102022330095', 'Mellafesa Rofida', 'Cloud Web Tier', 'assets/images/mella.jpg'),
('102022300011', 'Andi Meuthia Rionawita', 'Cloud Network & DB Tier', 'assets/images/meuthia.jpg');
