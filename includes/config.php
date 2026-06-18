<?php
// Konfigurasi Database
// Untuk tahap lokal gunakan localhost. Nanti saat di AWS, ubah DB_HOST menjadi IP Private EC2 DB.
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Sesuaikan dengan user XAMPP
define('DB_PASS', '');     // Sesuaikan dengan password XAMPP
define('DB_NAME', 'db_cloud');

// Membuat koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi Database Gagal: " . $conn->connect_error);
}
?>
