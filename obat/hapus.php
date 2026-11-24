<?php
include '../koneksi.php';
mysqli_query($koneksi, "DELETE FROM obat WHERE id_obat = '$_GET[id]'");
header("Location: index.php");
exit;
?>