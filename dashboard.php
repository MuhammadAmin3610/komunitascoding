<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Komunitas Coding</title>
    <link rel="stylesheet" href="LRD.css">
</head>
<body>
<header class="navbar">
    <div class="logo"><img src="assets/Kali Linux.png" alt="Logo"></div>
    <nav class="menu">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#">Layanan</a></li>
            <li><a href="#">Kontak</a></li>
            <li><a href="logout.php" class="btn">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="dashboard-content">
    <h1>Selamat Datang, <?= htmlspecialchars($_SESSION["username"]) ?>!</h1>
    <p>Ini adalah halaman dashboard komunitas coding.</p>
</div>
</body>
</html>
