<?php
$host = 'localhost';        // atau '127.0.0.1'
$db   = 'crypto_db';        // ganti dengan nama database kamu
$user = 'root';             // username database kamu (default: root)
$pass = '';                 // password database kamu (default kosong di XAMPP)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // error muncul sebagai exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // hasil fetch berupa array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // menggunakan prepared statement asli
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>
