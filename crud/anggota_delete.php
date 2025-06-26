<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM anggota WHERE id=$id");
header("Location: anggota_list.php");
?>