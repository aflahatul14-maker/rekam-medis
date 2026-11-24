<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $id_pasien       =$_POST['id_pasien'];
    $id_dokter       =$_POST['id_dokter'];
    $id_obat         =$_POST['id_obat'];
    $tanggal_periksa =$_POST['tanggal_periksa'];
    $keluhan         = mysqli_real_escape_string($koneksi, $_POST['keluhan']);$diagnosa        = mysqli_real_escape_string($koneksi,$_POST['diagnosa']);
    $tindakan        = mysqli_real_escape_string($koneksi, $_POST['tindakan']);$resep           = mysqli_real_escape_string($koneksi,$_POST['resep']);

    $sql = "INSERT INTO rekam_medis (id_pasien, id_dokter, id_obat, tanggal_periksa, keluhan, diagnosa, tindakan, resep) 
            VALUES ('$id_pasien', '$id_dokter', '$id_obat', '$tanggal_periksa', '$keluhan', '$diagnosa', '$tindakan', '$resep')";
    
    if (mysqli_query($koneksi,$sql)) {
        echo "<script>alert('Data Rekam Medis berhasil disimpan!'); window.location.href='index.php';</script>";
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
    <title>Input Rekam Medis</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <aside class="sidebar">
        <a href="../index.php" class="sidebar-brand">🏥 Rekam Medis</a>
        <ul class="sidebar-menu">
            <li><a href="../index.php">🏠 Dashboard</a></li>
            <li><a href="../pasien/index.php">👤 Data Pasien</a></li>
            <li><a href="../dokter/index.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="../obat/index.php">💊 Data Obat</a></li>
            <li><a href="index.php" class="active">📋 Rekam Medis</a></li>
        </ul>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <h1>Input Rekam Medis</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel form-panel">
                <a href="index.php" class="btn btn-back">← Kembali ke Daftar</a>
                <form method="POST">
                    <div class="form-group">
                        <label>Tanggal Periksa:</label>
                        <input type="date" name="tanggal_periksa" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pasien:</label>
                        <select name="id_pasien" required>
                            <option value="">-- Pilih Pasien --</option>
                            <?php
                            $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                            while ($p = mysqli_fetch_assoc($pasien)) {
                                echo "<option value='{$p['id_pasien']}'>{$p['no_rm']} - {$p['nama_pasien']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dokter Pemeriksa:</label>
                        <select name="id_dokter" required>
                            <option value="">-- Pilih Dokter --</option>
                            <?php
                            $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                            while ($d = mysqli_fetch_assoc($dokter)) {
                                echo "<option value='{$d['id_dokter']}'>{$d['nama_dokter']} ({$d['spesialisasi']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keluhan:</label>
                        <textarea name="keluhan" rows="2" placeholder="Keluhan pasien" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Diagnosa:</label>
                        <textarea name="diagnosa" rows="2" placeholder="Hasil diagnosa dokter" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tindakan:</label>
                        <textarea name="tindakan" rows="2" placeholder="Tindakan medis / anjuran" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Obat:</label>
                        <select name="id_obat" required>
                            <option value="">-- Pilih Obat --</option>
                            <?php
                            $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                            while ($o = mysqli_fetch_assoc($obat)) {
                                echo "<option value='{$o['id_obat']}'>{$o['nama_obat']} ({$o['satuan']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Aturan Pakai / Resep:</label>
                        <input type="text" name="resep" placeholder="Contoh: 3x1 sesudah makan" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">+ Simpan Rekam Medis</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>