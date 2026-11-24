<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM rekam_medis WHERE id_rm = '$id'"));

if (isset($_POST['update'])) {
    $id_pasien    = $_POST['id_pasien'];
    $id_dokter    = $_POST['id_dokter'];
    $id_obat      = $_POST['id_obat'];
    $tgl_periksa  = $_POST['tgl_periksa'];
    $keluhan      = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $diagnosa     = mysqli_real_escape_string($koneksi, $_POST['diagnosa']);
    $tindakan     = mysqli_real_escape_string($koneksi, $_POST['tindakan']);
    $aturan_pakai = mysqli_real_escape_string($koneksi, $_POST['aturan_pakai']);

    mysqli_query($koneksi, "UPDATE rekam_medis SET id_pasien='$id_pasien', id_dokter='$id_dokter', id_obat='$id_obat', 
                            tgl_periksa='$tgl_periksa', keluhan='$keluhan', diagnosa='$diagnosa', tindakan='$tindakan', aturan_pakai='$aturan_pakai' 
                            WHERE id_rm='$id'");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Rekam Medis</title>
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
            <h1>Edit Rekam Medis</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel">
                <a href="index.php" class="btn btn-back">← Kembali ke Daftar</a>
                <form method="POST">
                    <div class="form-group">
                        <label>Tanggal Periksa:</label>
                        <input type="date" name="tgl_periksa" value="<?= $data['tgl_periksa']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pasien:</label>
                        <select name="id_pasien" required>
                            <?php
                            $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                            while ($p = mysqli_fetch_assoc($pasien)) {
                                $sel = ($p['id_pasien'] == $data['id_pasien']) ? 'selected' : '';
                                echo "<option value='{$p['id_pasien']}' $sel>{$p['no_rm']} - {$p['nama_pasien']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dokter Pemeriksa:</label>
                        <select name="id_dokter" required>
                            <?php
                            $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                            while ($d = mysqli_fetch_assoc($dokter)) {
                                $sel = ($d['id_dokter'] == $data['id_dokter']) ? 'selected' : '';
                                echo "<option value='{$d['id_dokter']}' $sel>{$d['nama_dokter']} ({$d['spesialis']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keluhan:</label>
                        <textarea name="keluhan" rows="2" required><?= htmlspecialchars($data['keluhan']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Diagnosa:</label>
                        <textarea name="diagnosa" rows="2" required><?= htmlspecialchars($data['diagnosa']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tindakan:</label>
                        <textarea name="tindakan" rows="2" required><?= htmlspecialchars($data['tindakan']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Obat:</label>
                        <select name="id_obat" required>
                            <?php
                            $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                            while ($o = mysqli_fetch_assoc($obat)) {
                                $sel = ($o['id_obat'] == $data['id_obat']) ? 'selected' : '';
                                echo "<option value='{$o['id_obat']}' $sel>{$o['nama_obat']} ({$o['satuan']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Aturan Pakai / Dosis:</label>
                        <input type="text" name="aturan_pakai" value="<?= htmlspecialchars($data['aturan_pakai']); ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>