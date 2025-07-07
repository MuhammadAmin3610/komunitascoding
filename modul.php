<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "komunitascoding");

// Upload file
if (isset($_POST['upload'])) {
    $judul = $_POST['judul'];
    $nama_file = basename($_FILES['file']['name']);
    $lokasi_file = $_FILES['file']['tmp_name'];
    $folder = "modul/";

    // Pastikan folder modul ada
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Validasi file PDF
    $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    if ($ekstensi != "pdf") {
        echo "<script>alert('Hanya file PDF yang diperbolehkan!');</script>";
    } else {
        $tujuan = $folder . $nama_file;
        if (move_uploaded_file($lokasi_file, $tujuan)) {
            $koneksi->query("INSERT INTO buku (judul, file_pdf) VALUES ('$judul', '$nama_file')");
            header("Location: modul.php");
            exit;
        } else {
            echo "<script>alert('Gagal upload file. Cek permission folder modul/');</script>";
        }
    }
}

// Hapus file
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $ambil = $koneksi->query("SELECT file_pdf FROM buku WHERE id = $id");
    $data = $ambil->fetch_assoc();
    $filepath = "modul/" . $data['file_pdf'];
    if (file_exists($filepath)) {
        unlink($filepath);
    }
    $koneksi->query("DELETE FROM buku WHERE id = $id");
    header("Location: modul.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modul - BlockVerse</title>
    <link rel="stylesheet" href="index.css"> <!-- Tetap gunakan CSS yang sama -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        input, button {
            padding: 10px;
            margin: 5px;
        }
        table {
            background: rgba(0,0,0,0.5);
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            color: white;
            text-align: center;
            padding: 10px;
        }
        table th {
            color: yellow;
        }
        table a {
            color: yellow;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <video autoplay muted loop class="background-video">
        <source src="assets/perkotaan9.mp4" type="video/mp4" />
        Browser Anda tidak mendukung video.
    </video>

    <header class="header">
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="portofolio.html">Portfolio</a>
            <a href="modul.php" class="active">Modul</a>
            <a href="contact.html">Contact</a>
        </nav>
        <form action="" class="search-bar">
            <input type="text" placeholder="Search...">
            <button><i class='bx bx-search'></i></button>
        </form>
    </header>

    <div class="container" style="color:white; padding: 20px;">
        <h1 style="text-align: center; color: yellow;">Daftar Modul Buku</h1>

        <!-- Form Upload -->
        <form method="POST" enctype="multipart/form-data" style="text-align: center; margin-bottom: 30px;">
            <input type="text" name="judul" placeholder="Judul Modul" required>
            <input type="file" name="file" accept="application/pdf" required>
            <button type="submit" name="upload">Upload</button>
        </form>

        <!-- Tabel Modul -->
        <table border="1">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Download</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $ambil = $koneksi->query("SELECT * FROM buku ORDER BY id DESC");
            while ($data = $ambil->fetch_assoc()) {
                $file_path = "modul/" . $data['file_pdf'];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['judul']) ?></td>
                <td>
                    <?php if (file_exists($file_path)) { ?>
                        <a href="<?= $file_path ?>" download>Download</a>
                    <?php } else { ?>
                        <span style="color:red;">File tidak ditemukan</span>
                    <?php } ?>
                </td>
                <td>
                    <a href="modul.php?hapus=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin hapus modul ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>
