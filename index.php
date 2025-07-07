<?php
session_start();
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

        <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
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
            <p>BlockVerse adalah sebuah platform edukatif digital yang menghadirkan modul buku investasi dan teknologi masa depan dalam format online dan terstruktur, yang dirancang khusus untuk masyarakat Indonesia. Tujuan utama dari BlockVerse adalah mengubah mindset masyarakat agar lebih sadar, paham, dan siap menghadapi transformasi digital serta kemajuan teknologi di masa depan.</p>
            <div class="social-icon">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-whatsapp'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
