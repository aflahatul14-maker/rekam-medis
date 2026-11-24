<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $no_rm  = mysqli_real_escape_string($koneksi, $_POST['no_rm']);
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $jk     = $_POST['jenis_kelamin'];
    $tgl    = $_POST['tgl_lahir'];
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    mysqli_query($koneksi, "INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tgl_lahir, alamat) VALUES ('$no_rm', '$nama', '$jk', '$tgl', '$alamat')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Pasien</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <aside class="sidebar">
        <a href="../index.php" class="sidebar-brand">🏥 Rekam Medis</a>
        <ul class="sidebar-menu">
            <li><a href="../index.php">🏠 Dashboard</a></li>
            <li><a href="index.php" class="active">👤 Data Pasien</a></li>
            <li><a href="../dokter/index.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="../obat/index.php">💊 Data Obat</a></li>
            <li><a href="../rekam_medis/index.php">📋 Rekam Medis</a></li>
        </ul>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <h1>Kelola Data Pasien</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel">
                <a href="index.php" class="btn btn-back">← Kembali ke Daftar</a>
                <form method="POST">
                    <div class="form-group">
                        <label>No. Rekam Medis:</label>
                        <input type="text" name="no_rm" placeholder="Contoh: RM001" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien:</label>
                        <input type="text" name="nama_pasien" placeholder="Nama Lengkap Pasien" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <select name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <input type="date" name="tgl_lahir" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat:</label>
                        <input type="text" name="alamat" placeholder="Alamat Pasien" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">+ Simpan Pasien</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>