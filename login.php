<!-- login.php -->
<?php
session_start();
require_once "koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    $stmt = $koneksi->prepare("SELECT * FROM pengguna WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["username"] = $user["nama"];
        $_SESSION["role"] = $user["role"];
        header("Location: index.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - BlockVerse</title>
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
    .form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        padding: 40px;
        border-radius: 20px;
        max-width: 400px;
        width: 100%;
        color: #fff;
        z-index: 10;
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .input-box {
        position: relative;
        width: 100%;
        height: 50px;
        margin-bottom: 30px;
        border-bottom: 2px solid #fff;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        padding-left: 10px;
        font-size: 16px;
    }

    .input-box label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        pointer-events: none;
        transition: .5s;
        color: #fff;
    }

    .input-box input:focus ~ label,
    .input-box input:valid ~ label {
        top: -10px;
        font-size: 14px;
        color: #f72d7a;
    }

    .icon {
        position: absolute;
        right: 10px;
        top: 13px;
        color: #fff;
        font-size: 20px;
    }

    .btn {
        width: 100%;
        height: 45px;
        background: #f72d7a;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn:hover {
        background: #d61c63;
    }

    .form-container p {
        text-align: center;
        margin-top: 10px;
    }

    .form-container a {
        color: yellow;
        text-decoration: none;
    }

    .form-container a:hover {
        text-decoration: underline;
    }
</style>
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

<div class="form-container">
    <h2>Login</h2>
    <?php if ($error): ?><p style="color: red; text-align:center; font-weight:bold; font-size:14px; margin-bottom:10px;">
        <?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST" action="">
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
        <button type="submit" class="btn">Login</button>
        <p style="text-align:center;">Belum punya akun? <a href="register.php" style="color: yellow;">Daftar</a></p>
    </form>
</div>
</body>
</html>
