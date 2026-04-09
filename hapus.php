<?php
include "koneksi.php";

$id = $_GET['id'];

// ambil data dulu (untuk hapus foto)
$data = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan='$id'");
$d = mysqli_fetch_array($data);

// cek status harus selesai
if ($d['status'] != 'selesai') {
    echo "<script>
        alert('Data hanya bisa dihapus jika status selesai!');
        window.location='dashboard_admin.php';
    </script>";
    exit();
}

// hapus file foto jika ada
if ($d['foto'] != NULL && file_exists("foto/" . $d['foto'])) {
    unlink("foto/" . $d['foto']);
}

// hapus data dari database
mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan='$id'");

// kembali ke dashboard
header("Location: dashboard_admin.php?pesan=hapus");
exit();
?>