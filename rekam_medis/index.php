<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Rekam Medis</title>
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
            <h1>Data Rekam Medis</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel">
                <div class="panel-header">
                    <h3>Semua Riwayat Rekam Medis</h3>
                    <a href="tambah.php" class="btn btn-primary">+ Input Rekam Medis</a>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT rm.*, p.no_rm, p.nama_pasien, d.nama_dokter, o.nama_obat 
                                FROM rekam_medis rm
                                LEFT JOIN pasien p ON rm.id_pasien = p.id_pasien
                                LEFT JOIN dokter d ON rm.id_dokter = d.id_dokter
                                LEFT JOIN obat o ON rm.id_obat = o.id_obat
                                ORDER BY rm.id_rekam DESC";
                        $query = mysqli_query($koneksi, $sql);

                        if (!$query) {
                            echo "<tr><td colspan='8' style='color:red;'>Error Query: " . mysqli_error($koneksi) . "</td></tr>";
                        } elseif (mysqli_num_rows($query) == 0) {
                            echo "<tr><td colspan='8' style='text-align:center; color:#64748b;'>Belum ada data rekam medis di database.</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal_periksa'])); ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['nama_pasien'] ?? 'Pasien tidak ditemukan'); ?></strong>
                                <span class="sub-text"><?= htmlspecialchars($row['no_rm'] ?? '-'); ?></span>
                            </td>
                            <td><?= htmlspecialchars($row['nama_dokter'] ?? 'Dokter tidak ditemukan'); ?></td>
                            <td>
                                <strong>Keluhan:</strong> <?= htmlspecialchars($row['keluhan']); ?><br>
                                <strong>Diagnosa:</strong> <?= htmlspecialchars($row['diagnosa']); ?>
                            </td>
                            <td><?= htmlspecialchars($row['tindakan']); ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['nama_obat'] ?? 'Obat tidak ditemukan'); ?></strong>
                                <span class="sub-text"><?= htmlspecialchars($row['resep']); ?></span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_rekam']; ?>" class="btn btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $row['id_rekam']; ?>" class="btn btn-danger" onclick="return confirm('Hapus catatan rekam medis ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>