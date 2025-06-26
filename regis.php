<?php
include 'koneksi.php';
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST["nama"]);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $result = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
    $result->bind_param("s", $email);
    $result->execute();
    $check = $result->get_result();

    if ($check->num_rows > 0) {
        $error = "❌ Email sudah digunakan!";
    } else {
        $query = $koneksi->prepare("INSERT INTO pengguna (nama, email, password) VALUES (?, ?, ?)");
        $query->bind_param("sss", $nama, $email, $password);
        if ($query->execute()) {
            $success = "✅ Registrasi berhasil! Silakan login.";
        } else {
            $error = "❌ Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Komunitas Coding</title>
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
            <li><a href="login.php" class="btn">Login</a></li>
            <li><a href="regis.php" class="btn btn-outline">Register</a></li>
        </ul>
    </nav>
</header>

<div class="login-box">
    <h2>📝 Registrasi</h2>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="nama" placeholder="> Nama Lengkap" required>
        <input type="email" name="email" placeholder="> Email" required>
        <input type="password" name="password" placeholder="> Password" required>
        <input type="submit" value="> Daftar">
    </form>
    <div class="footer">Sudah punya akun? <a href="login.php">Login di sini</a></div>
</div>
</body>
</html>
