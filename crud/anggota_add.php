<?php
include 'koneksi.php';

if ($_POST) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $keahlian = $_POST['keahlian'];
    mysqli_query($koneksi, "INSERT INTO anggota (nama, email, keahlian) VALUES ('$nama', '$email', '$keahlian')");
    header("Location: anggota_list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>
    <style>
        body { background: #0f111a; color: #00ff99; font-family: 'Fira Code', monospace; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box { background: #1a1d2b; padding: 20px; border-radius: 10px; box-shadow: 0 0 20px #00ff99; width: 350px; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #0f111a; border: 1px solid #00ff99; color: #00ff99; border-radius: 5px; }
        input[type="submit"] { background: #00ff99; color: #0f111a; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h2>➕ Tambah Anggota</h2>
        <form method="post">
            <input type="text" name="nama" placeholder="> Nama" required>
            <input type="email" name="email" placeholder="> Email" required>
            <input type="text" name="keahlian" placeholder="> Keahlian" required>
            <input type="submit" value="> Simpan">
        </form>
    </div>
</body>
</html>