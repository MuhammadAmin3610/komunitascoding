<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $user['nama'];
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "❌ Password salah!";
            }
        } else {
            $error = "❌ Email tidak ditemukan!";
        }
    } else {
        $error = "❗ Harap isi semua kolom!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Komunitas Coding</title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
  <body>
  <video autoplay muted loop class="bg-video">
    <source src="hero1.mp4" type="video/mp4" />
    Browser Anda tidak mendukung video tag.
  </video>


<header class="navbar">
    <div class="logo"><img src="assets/Kali Linux.png" alt="Logo"></div>
    <nav class="menu">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#">Layanan</a></li>
            <li><a href="#">Kontak</a></li>
            <li><a href="login.php" class="btn">Login</a></li>
            <li><a href="regis.php" class="btn btn-outline">Register</a></li>
        </ul>
    </nav>
</header>

<div class="login-box">
    <h2>🔐 Login Komunitas</h2>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="email" name="email" placeholder="> Email" required>
        <input type="password" name="password" placeholder="> Password" required>
        <input type="submit" value="> Login">
    </form>
    <div class="footer">Belum punya akun? <a href="regis.php">Daftar di sini</a></div>
</div>
</body>
</html>
