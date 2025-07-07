<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'koneksi.php';
$result = $conn->query("SELECT * FROM buku ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
</head>
<body>
    <h2>Daftar Modul PDF</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>File</th>
            <?php if ($_SESSION["role"] === "admin"): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row["judul"]) ?></td>
            <td><a href="uploads/<?= urlencode($row["nama_file"]) ?>" target="_blank">Download</a></td>
            <?php if ($_SESSION["role"] === "admin"): ?>
                <td><a href="hapus_buku.php?id=<?= $row["id"] ?>" onclick="return confirm('Hapus buku ini?')">Hapus</a></td>
            <?php endif; ?>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
