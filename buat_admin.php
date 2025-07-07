<?php
include 'koneksi.php';

$nama = "Admin Crypto";
$email = "admin@crypto.com";
$password = password_hash("admin123", PASSWORD_DEFAULT);
$role = "admin";

$stmt = $koneksi->prepare("INSERT INTO pengguna (nama, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $email, $password, $role);
$stmt->execute();

echo "Admin berhasil ditambahkan!";
