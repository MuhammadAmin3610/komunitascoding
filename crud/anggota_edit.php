<?php
include 'koneksi.php';

// Cek apakah parameter "id" tersedia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ ID tidak ditemukan atau tidak valid.");
}

$id = $_GET['id'];

// Ambil data anggota berdasarkan ID
$result = $koneksi->query("SELECT * FROM anggota WHERE id=$id");

// Cek apakah data ada
if (!$result || $result->num_rows === 0) {
    die("❌ Data anggota tidak ditemukan.");
}

$anggota = $result->fetch_assoc();

// Proses jika form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $keahlian = $_POST['keahlian'];

    $koneksi->query("UPDATE anggota SET nama='$nama', email='$email', keahlian='$keahlian' WHERE id=$id");
    header("Location: anggota_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
    <style>
        body { background: #0f111a; color: #00ff99; font-family: 'Fira Code', monospace; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box { background: #1a1d2b; padding: 20px; border-radius: 10px; box-shadow: 0 0 20px #00ff99; width: 350px; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #0f111a; border: 1px solid #00ff99; color: #00ff99; border-radius: 5px; }
        input[type="submit"] { background: #00ff99; color: #0f111a; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h2>✏️ Edit Anggota</h2>
        <form method="post">
            <input type="text" name="nama" value="<?= $anggota['nama'] ?>" required>
            <input type="email" name="email" value="<?= $anggota['email'] ?>" required>
            <input type="text" name="keahlian" value="<?= $anggota['keahlian'] ?>" required>
            <input type="submit" value="> Update">
        </form>
    </div>
</body>
</html>
