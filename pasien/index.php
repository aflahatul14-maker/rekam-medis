<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien - Rekam Medis</title>
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
            <h1>Data Pasien</h1>
            <span class="badge-admin">Administrator</span>
        </header>

        <main class="content">
            <div class="panel">
                <div class="panel-header">
                    <h3>Daftar Pasien Terdaftar</h3>
                    <a href="tambah.php" class="btn btn-primary">+ Tambah Pasien Baru</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien DESC");
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['no_rm']); ?></strong></td>
                            <td><?= htmlspecialchars($row['nama_pasien']); ?></td>
                            <td><?= $row['jenis_kelamin']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_lahir'])); ?></td>
                            <td><?= htmlspecialchars($row['alamat']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_pasien']; ?>" class="btn btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $row['id_pasien']; ?>" class="btn btn-danger" onclick="return confirm('Hapus data pasien ini?')">Hapus</a>
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