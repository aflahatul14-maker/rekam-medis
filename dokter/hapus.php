<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM dokter WHERE id_dokter = '$id'");
}

echo "<script>alert('Data dokter berhasil dihapus!'); window.location.href='index.php';</script>";
exit;
?>