<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../koneksi.php';

$id   = (int) $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien = '$id'"));

// Deteksi tipe kolom jenis_kelamin langsung dari database (baik ENUM maupun VARCHAR/CHAR)
$jk_options = ['L', 'P'];
$col_info = mysqli_fetch_assoc(mysqli_query($koneksi, "SHOW COLUMNS FROM pasien LIKE 'jenis_kelamin'"));
if ($col_info) {
    if (preg_match("/^enum\((.*)\)$/i", $col_info['Type'], $matches)) {
        $jk_options = array_map(function($val) {
            return trim($val, "' ");
        }, explode(',', $matches[1]));
    } elseif (preg_match("/\((1)\)/", $col_info['Type'])) {
        $jk_options = ['L', 'P'];
    } else {
        $jk_options = ['Laki-laki', 'Perempuan'];
    }
}

if (isset($_POST['update'])) {
    $set_fields = [];
    foreach ($_POST as $kolom => $nilai) {
        if ($kolom !== 'update' && array_key_exists($kolom, $data)) {
            if ($kolom === 'jenis_kelamin' && !in_array($nilai, $jk_options)) {
                // Samakan otomatis dengan opsi yang diizinkan database
                $nilai = (stripos($nilai, 'P') === 0) ? end($jk_options) : reset($jk_options);
            }
            $nilai_aman = mysqli_real_escape_string($koneksi, $nilai);
            $set_fields[] = "$kolom = '$nilai_aman'";
        }
    }

    $sql = "UPDATE pasien SET " . implode(', ', $set_fields) . " WHERE id_pasien = '$id'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Data pasien berhasil diperbarui!');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pasien</title>
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
            <h1>Edit Data Pasien</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel form-panel">
                <a href="index.php" class="btn btn-back">← Kembali ke Daftar</a>
                <form method="POST">
                    <?php foreach ($data as $kolom => $nilai): ?>
                        <?php if ($kolom === 'id_pasien') continue; ?>
                        <div class="form-group">
                            <label><?= ucwords(str_replace('_', ' ', $kolom)); ?>:</label>
                            <?php if ($kolom === 'jenis_kelamin'): ?>
                                <select name="jenis_kelamin" required>
                                    <?php foreach ($jk_options as $opt): ?>
                                        <option value="<?= htmlspecialchars($opt); ?>" <?= (strcasecmp($nilai, $opt) == 0) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($opt); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php elseif (strpos($kolom, 'tgl') !== false || strpos($kolom, 'tanggal') !== false): ?>
                                <input type="date" name="<?= $kolom; ?>" value="<?= htmlspecialchars($nilai); ?>" required>
                            <?php elseif ($kolom === 'alamat'): ?>
                                <textarea name="alamat" rows="3" required><?= htmlspecialchars($nilai); ?></textarea>
                            <?php else: ?>
                                <input type="text" name="<?= $kolom; ?>" value="<?= htmlspecialchars($nilai); ?>" required>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>