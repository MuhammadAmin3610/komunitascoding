<?php
session_start();

// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Koneksi database
$koneksi = new mysqli("localhost", "root", "", "komunitascoding");

// Ambil data modul
if (!isset($_GET['id'])) {
    echo "ID modul tidak ditemukan!";
    exit;
}

$id = (int)$_GET['id'];
$ambil = $koneksi->query("SELECT * FROM buku WHERE id = $id");
$data = $ambil->fetch_assoc();

if (!$data) {
    echo "Data modul tidak ditemukan!";
    exit;
}

// Proses update
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $nama_file = $data['file_pdf']; // default

    // Jika file baru diupload
    if (!empty($_FILES['file']['name'])) {
        $nama_baru = basename($_FILES['file']['name']);
        $lokasi = $_FILES['file']['tmp_name'];
        $ekstensi = strtolower(pathinfo($nama_baru, PATHINFO_EXTENSION));

        if ($ekstensi != 'pdf') {
            echo "<script>alert('File harus PDF!');</script>";
        } else {
            $folder = "modul/";
            $tujuan = $folder . $nama_baru;

            // Hapus file lama
            if (file_exists($folder . $data['file_pdf'])) {
                unlink($folder . $data['file_pdf']);
            }

            if (move_uploaded_file($lokasi, $tujuan)) {
                $nama_file = $nama_baru;
            } else {
                echo "<script>alert('Gagal upload file.');</script>";
            }
        }
    }

    $koneksi->query("UPDATE buku SET judul='$judul', file_pdf='$nama_file' WHERE id=$id");
    header("Location: modul.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Modul</title>
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .form-edit {
            max-width: 500px;
            margin: 100px auto;
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            color: white;
        }
        .form-edit input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        .form-edit button {
            padding: 10px 20px;
            background: yellow;
            color: black;
            border: none;
            cursor: pointer;
        }
        .form-edit a {
            color: yellow;
            text-decoration: underline;
        }
                body {
            margin: 0;
            padding: 0;
            height: 100vh;
            position: relative;
            font-family: Arial, sans-serif;
        }

        .form-edit {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px;
            width: 90%;
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .form-edit h2 {
            margin-bottom: 20px;
            color: yellow;
        }

        .form-edit input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        .form-edit button {
            padding: 10px 20px;
            background: yellow;
            color: black;
            border: none;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        .form-edit a {
            color: yellow;
            display: block;
            margin-top: 15px;
            text-align: center;
            text-decoration: underline;
        }

    </style>
</head>
<body>

<video autoplay muted loop class="background-video">
    <source src="assets/perkotaan9.mp4" type="video/mp4" />
</video>

<header class="header">
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="portofolio.html">Portfolio</a>
        <a href="modul.php">Modul</a>
        <a href="contact.html">Contact</a>
    </nav>
    <form action="" class="search-bar">
        <input type="text" placeholder="Search...">
        <button><i class='bx bx-search'></i></button>
    </form>
</header>

<div class="form-edit">
    <h2>Edit Modul Buku</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required>

        <label>File PDF (Kosongkan jika tidak ingin mengganti)</label>
        <input type="file" name="file" accept="application/pdf">

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
    <br>
    <a href="modul.php">← Kembali ke Daftar Modul</a>
</div>

</body>
</html>
