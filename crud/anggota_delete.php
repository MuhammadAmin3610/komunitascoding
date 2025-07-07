<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit;
}

require 'koneksi.php';

$id = $_GET['id'];
$result = $conn->query("SELECT nama_file FROM buku WHERE id = $id");
$row = $result->fetch_assoc();

if ($row) {
    unlink("uploads/" . $row['nama_file']); // hapus file fisik
    $conn->query("DELETE FROM buku WHERE id = $id"); // hapus dari DB
}

header("Location: daftar_buku.php");
exit;
