<?php
$host = 'localhost';
$db   = 'komunitascoding';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Gunakan nama variabel $koneksi sesuai yang kamu pakai di index.php
    $koneksi = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
