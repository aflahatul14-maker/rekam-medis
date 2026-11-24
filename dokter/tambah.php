<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama_dokter']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);

    $sql = "INSERT INTO dokter (nama_dokter, spesialisasi) VALUES ('$nama', '$spesialisasi')";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data dokter berhasil disimpan!'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Dokter</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <aside class="sidebar">
        <a href="../index.php" class="sidebar-brand">🏥 Rekam Medis</a>
        <ul class="sidebar-menu">
            <li><a href="../index.php">🏠 Dashboard</a></li>
            <li><a href="../pasien/index.php">👤 Data Pasien</a></li>
            <li><a href="index.php" class="active">👨‍⚕️ Data Dokter</a></li>
            <li><a href="../obat/index.php">💊 Data Obat</a></li>
            <li><a href="../rekam_medis/index.php">📋 Rekam Medis</a></li>
        </ul>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <h1>Kelola Data Dokter</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel form-panel">
                <a href="index.php" class="btn btn-back">← Kembali ke Daftar</a>
                <form method="POST">
                    <div class="form-group">
                        <label>Nama Dokter:</label>
                        <input type="text" name="nama_dokter" placeholder="Contoh: dr. Andi Wijaya" required>
                    </div>
                    <div class="form-group">
                        <label>Spesialisasi:</label>
                        <input type="text" name="spesialisasi" placeholder="Contoh: Spesialis Penyakit Dalam" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">+ Simpan Dokter</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>