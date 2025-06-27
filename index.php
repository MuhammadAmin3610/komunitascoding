<?php
session_start();
require_once "config.php"; // file koneksi ke database

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau password salah!";
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
    <source src="hero1.mp4" type="video/mp4" />
</video>

<header class="header">
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="portfolio.html">Portfolio</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
        <a href="#">Help</a>
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
            <h2>Welcome! <br><span>Crypto Academy Center</span></h2>
            <p>Providing learning materials on various aspects of crypto, such as Bitcoin, Ethereum, and other altcoins.</p>
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
            <form action="register.php" method="POST">
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
