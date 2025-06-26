<?php
include 'koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM anggota");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
    <style>
        body { background: #0f111a; color: #00ff99; font-family: 'Fira Code', monospace; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #00ff99; padding: 10px; text-align: left; }
        a { color: #00ffcc; text-decoration: none; margin-right: 10px; }
        .btn { margin-top: 20px; display: inline-block; padding: 10px; background: #00ff99; color: #0f111a; border-radius: 5px; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <h2>👥 Daftar Anggota Komunitas</h2>
    <a href="anggota_add.php" class="btn">+ Tambah Anggota</a>
    <table>
        <tr>
            <th>No</th><th>Nama</th><th>Email</th><th>Keahlian</th><th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['keahlian'] ?></td>
            <td>
                <a href="anggota_edit.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                <a href="anggota_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">🗑️ Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>