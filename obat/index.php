<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Obat - Rekam Medis</title>
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
            <h1>Data Obat</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel">
                <div class="panel-header">
                    <h3>Daftar Stok Obat</h3>
                    <a href="tambah.php" class="btn btn-primary">+ Tambah Data Obat</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Satuan</th>
                            <th>Jumlah Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id_obat DESC");
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['nama_obat']); ?></strong></td>
                            <td><?= htmlspecialchars($row['satuan']); ?></td>
                            <td><?= $row['stok']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_obat']; ?>" class="btn btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $row['id_obat']; ?>" class="btn btn-danger" onclick="return confirm('Hapus data obat ini?')">Hapus</a>
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