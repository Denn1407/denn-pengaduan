<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'user') {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

$data = mysqli_query($conn, "SELECT * FROM pengaduan");
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard User</title>
</head>

<body>

    <div class="button-group">
        <a href="pengaduan.php" class="btn btn-success">+ Buat Pengaduan</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <h3>Data Pengaduan</h3>

    <table border="1" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Lokasi</th>
            <th>Jenis</th>
            <th>Status</th>
            <th>Foto</th>
        </tr>

        <!-- ✅ PERBAIKAN DI SINI -->
        <?php while ($d = mysqli_fetch_array($data)) { ?>
            <tr>
                <td><?= $d['nama_pelapor'] ?></td>
                <td><?= $d['kelas_bagian'] ?></td>
                <td><?= $d['lokasi'] ?></td>
                <td><?= $d['jenis_kerusakan'] ?></td>

                <td>
                    <?php
                    if ($d['status'] == 'menunggu') {
                        echo "<span class='status-menunggu'>Menunggu</span>";
                    } elseif ($d['status'] == 'diproses') {
                        echo "<span class='status-diproses'>Diproses</span>";
                    } else {
                        echo "<span class='status-selesai'>Selesai</span>";
                    }
                    ?>
                </td>

                <td>
                    <?php if (!empty($d['foto'])) { ?>
                        <img src="foto/<?= $d['foto'] ?>" width="100">
                    <?php } else { ?>
                        Tidak ada foto
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>

</html>