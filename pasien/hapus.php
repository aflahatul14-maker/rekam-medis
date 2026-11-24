<?php
include '../koneksi.php';
mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien = '$_GET[id]'");
header("Location: index.php");
exit;
?>