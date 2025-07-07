<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

// Cek role user
$is_admin = ($_SESSION["role"] === "admin"); // pastikan $_SESSION["role"] diset saat login
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Crypto Academy</title>
    <link rel="stylesheet" href="index.css"> <!-- gunakan tema utama -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .dashboard-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            color: white;
            text-align: center;
            backdrop-filter: blur(6px);
        }
        .dashboard-box {
            background: rgba(255, 255, 255, 0.08);
            padding: 40px;
            border-radius: 16px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 0 10px rgba(255,255,255,0.2);
        }
        .dashboard-box h1 {
            margin-bottom: 10px;
        }
        .dashboard-box p {
            margin-bottom: 30px;
        }
        .dashboard-box a {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            background: #f72d7a;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }
        .dashboard-box a:hover {
            background: #c72060;
        }
    </style>
</head>
<body>

<!-- Background video -->
<video autoplay muted loop class="background-video">
    <source src="hero1.mp4" type="video/mp4">
    Browser Anda tidak mendukung video.
</video>

<!-- Navbar -->
<header class="header">
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="about.html">About</a>
        <a href="portfolio.html">Portfolio</a>
        <a href="contact.html">Contact</a>
        <a href="logout.php" class="btn">Logout</a>
    </nav>
    <form action="" class="search-bar">
        <input type="text" placeholder="Search...">
        <button><i class='bx bx-search'></i></button>
    </form>
</header>

<!-- Dashboard Content -->
<div class="dashboard-wrapper">
    <div class="dashboard-box">
        <h1>Selamat Datang, <?= htmlspecialchars($_SESSION["username"]) ?>!</h1>
        <p>Anda masuk sebagai <strong><?= $is_admin ? "Admin" : "User" ?></strong>.</p>

        <?php if ($is_admin): ?>
            <a href="tambah_buku.php">➕ Tambah Buku</a>
            <a href="daftar_buku.php">📚 Lihat Semua Buku</a>
        <?php else: ?>
            <a href="daftar_buku.php">📥 Download Buku</a>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
