<?php
session_start();
if ($_SESSION['level'] != 'admin') {
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
    <title>Dashboard Admin</title>
</head>

<body>

    <!-- NOTIFIKASI -->
    <?php
    if (isset($_GET['pesan']) && $_GET['pesan'] == "berhasil") {
        echo "<p id='notif' style='color: green; font-weight:bold;'>Perubahan berhasil!</p>
    <script>
        setTimeout(function(){
            document.getElementById('notif').style.display='none';
        }, 2000);
    </script>";
    }

    if (isset($_GET['pesan']) && $_GET['pesan'] == "hapus") {
        echo "<p style='color: red; font-weight:bold;'>Data berhasil dihapus!</p>";
    }
    ?>

    <h2>Dashboard Admin</h2>
    <div class="button-group">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jenis</th>
            <th>Status</th>
            <th>Aksi</th>
            <th>Foto</th>
        </tr>

        <?php while ($d = mysqli_fetch_array($data)) { ?>
            <tr>
                <td><?= $d['nama_pelapor'] ?></td>
                <td><?= $d['kelas_bagian'] ?></td>
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
                    <a href="update.php?id=<?= $d['id_pengaduan'] ?>&status=diproses">Proses</a> |
                    <a href="update.php?id=<?= $d['id_pengaduan'] ?>&status=selesai">Selesai</a> |

                    <?php if ($d['status'] == 'selesai') { ?>
                        <a href="hapus.php?id=<?= $d['id_pengaduan'] ?>"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </a>
                    <?php } else { ?>
                        <span style="color:gray;">Hapus</span>
                    <?php } ?>
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