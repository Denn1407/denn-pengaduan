<?php
include "koneksi.php";

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "UPDATE pengaduan SET status='$status' WHERE id_pengaduan='$id'");

// redirect + kirim pesan
header("Location: dashboard_admin.php?pesan=berhasil");
exit();
?>