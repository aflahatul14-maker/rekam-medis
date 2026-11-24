<?php
include 'koneksi.php';

$jml_pasien = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pasien"));
$jml_dokter = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM dokter"));
$jml_obat   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM obat"));
$jml_rm     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rekam_medis"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Utama - Rekam Medis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <aside class="sidebar">
        <a href="index.php" class="sidebar-brand">🏥 Rekam Medis</a>
        <ul class="sidebar-menu">
            <li><a href="index.php" class="active">🏠 Dashboard</a></li>
            <li><a href="pasien/index.php">👤 Data Pasien</a></li>
            <li><a href="dokter/index.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="obat/index.php">💊 Data Obat</a></li>
            <li><a href="rekam_medis/index.php">📋 Rekam Medis</a></li>
        </ul>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <h1>Dashboard Utama</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <!-- 4 Kartu Statistik -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h2><?= $jml_pasien; ?></h2>
                        <p>Total Pasien</p>
                    </div>
                    <div class="stat-icon">👤</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h2><?= $jml_dokter; ?></h2>
                        <p>Total Dokter</p>
                    </div>
                    <div class="stat-icon">👨‍⚕️</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h2><?= $jml_obat; ?></h2>
                        <p>Total Obat</p>
                    </div>
                    <div class="stat-icon">💊</div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h2><?= $jml_rm; ?></h2>
                        <p>Catatan Rekam Medis</p>
                    </div>
                    <div class="stat-icon">📋</div>
                </div>
            </div>

            <!-- Panel Akses Cepat -->
            <div class="panel">
                <div class="panel-header">
                    <h3>Akses Cepat</h3>
                </div>
                <div class="quick-grid">
                    <a href="pasien/tambah.php" class="quick-btn">➕ Tambah Pasien Baru</a>
                    <a href="dokter/tambah.php" class="quick-btn">👨‍⚕️ Tambah Data Dokter</a>
                    <a href="obat/tambah.php" class="quick-btn">💊 Tambah Data Obat</a>
                    <a href="rekam_medis/tambah.php" class="quick-btn">📋 Input Rekam Medis</a>
                </div>
            </div>

            <!-- Panel Riwayat Rekam Medis Terbaru -->
            <div class="panel">
                <div class="panel-header">
                    <h3>Riwayat Rekam Medis Terbaru</h3>
                    <a href="rekam_medis/index.php" class="btn btn-dark">Lihat Semua Data ➔</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Periksa</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Keluhan & Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Obat & Resep</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT rm.*, p.no_rm, p.nama_pasien, d.nama_dokter, o.nama_obat 
                                FROM rekam_medis rm
                                JOIN pasien p ON rm.id_pasien = p.id_pasien
                                JOIN dokter d ON rm.id_dokter = d.id_dokter
                                JOIN obat o ON rm.id_obat = o.id_obat
                                ORDER BY rm.id_rm DESC LIMIT 5";
                        $query = mysqli_query($koneksi, $sql);
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_periksa'])); ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['nama_pasien']); ?></strong>
                                <span class="sub-text"><?= htmlspecialchars($row['no_rm']); ?></span>
                            </td>
                            <td><?= htmlspecialchars($row['nama_dokter']); ?></td>
                            <td>
                                <strong>Keluhan:</strong> <?= htmlspecialchars($row['keluhan']); ?><br>
                                <strong>Diagnosa:</strong> <?= htmlspecialchars($row['diagnosa']); ?>
                            </td>
                            <td><?= htmlspecialchars($row['tindakan']); ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['nama_obat']); ?></strong>
                                <span class="sub-text"><?= htmlspecialchars($row['aturan_pakai']); ?></span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>