<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    // Menggunakan id_rekam sesuai struktur tabel LKPD
    $hapus = mysqli_query($koneksi, "DELETE FROM rekam_medis WHERE id_rekam = '$id'");

    if ($hapus) {
        echo "<script>
                alert('Data rekam medis berhasil dihapus!');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}
?>