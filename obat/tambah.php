<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama_obat']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $stok   = (int) $_POST['stok'];

    mysqli_query($koneksi, "INSERT INTO obat (nama_obat, satuan, stok) VALUES ('$nama', '$satuan', '$stok')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Obat</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <aside class="sidebar">
        <a href="../index.php" class="sidebar-brand">🏥 Rekam Medis</a>
        <ul class="sidebar-menu">
            <li><a href="../index.php">🏠 Dashboard</a></li>
            <li><a href="../pasien/index.php">👤 Data Pasien</a></li>
            <li><a href="../dokter/index.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="index.php" class="active">💊 Data Obat</a></li>
            <li><a href="../rekam_medis/index.php">📋 Rekam Medis</a></li>
        </ul>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <h1>Kelola Data Obat</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel">
                <a href="index.php" class="btn btn-back">← Kembali ke Daftar</a>
                <form method="POST">
                    <div class="form-group">
                        <label>Nama Obat:</label>
                        <input type="text" name="nama_obat" placeholder="Contoh: Paracetamol 500mg" required>
                    </div>
                    <div class="form-group">
                        <label>Satuan:</label>
                        <input type="text" name="satuan" placeholder="Tablet / Kapsul / Sirup" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Stok:</label>
                        <input type="number" name="stok" placeholder="Stok Obat" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">+ Simpan Obat</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>