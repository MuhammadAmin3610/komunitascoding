<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $file = $_FILES['pdf'];

    if ($file['type'] === 'application/pdf') {
        $nama_file = basename($file['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $nama_file;

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            require 'koneksi.php'; // koneksi ke database
            $stmt = $conn->prepare("INSERT INTO buku (judul, nama_file) VALUES (?, ?)");
            $stmt->bind_param("ss", $judul, $nama_file);
            $stmt->execute();
            echo "Buku berhasil diunggah!";
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Hanya file PDF yang diperbolehkan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
</head>
<body>
    <h2>Upload Modul PDF</h2>
    <form method="post" enctype="multipart/form-data">
        Judul: <input type="text" name="judul" required><br><br>
        File PDF: <input type="file" name="pdf" accept="application/pdf" required><br><br>
        <button type="submit">Upload</button>
    </form>
    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
