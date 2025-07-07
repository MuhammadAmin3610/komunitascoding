<?php
session_start();
require_once "koneksi.php";

// Redirect jika sudah login
if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
$success = "";

// Cek apakah yang dikirim adalah form register atau login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Form login vs register dibedakan berdasarkan tombol yang diklik
    if (isset($_POST["login"])) {
        // ====== LOGIN LOGIC ======
        $email = $_POST["email"] ?? '';
        $password = $_POST["password"] ?? '';

        $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["username"] = $user["nama"];
            $_SESSION["role"] = $user["role"];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Email atau password salah!";
        }
    } elseif (isset($_POST["register"])) {
        // ====== REGISTER LOGIC ======
        $username = $_POST["username"] ?? '';
        $email = $_POST["email"] ?? '';
        $password = $_POST["password"] ?? '';

        // Cek apakah email sudah digunakan
        $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $error = "❌ Email sudah terdaftar!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $koneksi->prepare("INSERT INTO pengguna (nama, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed]);

            $success = "✅ Berhasil mendaftar! Silakan login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hash Techie Official</title>
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<video autoplay muted loop class="background-video">
    <source src="assets/hero5.mp4" type="video/mp4" />
</video>

<header class="header">
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="portofolio.html">Portfolio</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
        <a href="modul.php">Modul</a>
    </nav>
    <form action="" class="search-bar">
        <input type="text" placeholder="Search...">
        <button><i class='bx bx-search'></i></button>
    </form>
</header>

<div class="background"></div>
<div class="container">
    <div class="item">
        <h2 class="logo"><i class='bx bxl-xing'></i> Amin77</h2>
        <div class="text-item">
            <h2 style="color: yellow;">Welcome! <br><span style="color: yellow;">BlockVerse x AM77</span></h2>
            <p>BlockVerse adalah sebuah platform edukatif digital yang menghadirkan modul buku investasi dan teknologi masa depan dalam format online dan terstruktur, yang dirancang khusus untuk masyarakat Indonesia. Tujuan utama dari BlockVerse adalah mengubah mindset masyarakat agar lebih sadar, paham, dan siap menghadapi transformasi digital serta kemajuan teknologi di masa depan..</p>
            <div class="social-icon">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-whatsapp'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
    </div>

    <div class="login-section">
        <div class="form-box login">
            <form method="POST" action="">
                <h2>Sign In</h2>
                <?php if ($error): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-password">
                    <label><input type="checkbox">Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Log In</button>
                <div class="create-account">
                    <p>Create a new account? <a href="#" class="register-link">Sign Up</a></p>
                </div>
            </form>
        </div>

        <!-- Register form tidak aktif di sini, tapi bisa dikembangkan -->
        <div class="form-box register">
            <form action="index.php" method="POST">
                <h2>Sign Up</h2>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-user'></i></span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-password">
                    <label><input type="checkbox" required> I agree to the terms</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="create-account">
                    <p>Already have an account? <a href="#" class="login-link">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="index.js"></script>
</body>
</html>
