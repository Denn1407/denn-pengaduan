<?php
include "koneksi.php";

// ================== CEK METHOD ==================
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: pengaduan.php");
    exit();
}

// ================== AMBIL DATA ==================
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$lokasi = $_POST['lokasi'];
$jenis = $_POST['jenis'];
$deskripsi = $_POST['deskripsi'];

// ================== VALIDASI INPUT ==================
if (empty($nama) || empty($kelas) || empty($lokasi) || empty($jenis)) {
    echo "<script>
        alert('Data tidak boleh kosong!');
        window.location='pengaduan.php';
    </script>";
    exit();
}

// ================== PROSES FOTO ==================
$nama_file = $_FILES['foto']['name'];
$tmp_file = $_FILES['foto']['tmp_name'];
$size = $_FILES['foto']['size'];

$nama_baru = NULL;

if ($nama_file != "") {

    // ambil ekstensi
    $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    // validasi ekstensi
    $allowed = array("jpg", "jpeg", "png");

    if (!in_array($ekstensi, $allowed)) {
        echo "<script>
            alert('File harus berupa JPG, JPEG, atau PNG!');
            window.location='pengaduan.php';
        </script>";
        exit();
    }

    // validasi ukuran (max 2MB)
    if ($size > 2000000) {
        echo "<script>
            alert('Ukuran file terlalu besar! Maksimal 2MB.');
            window.location='pengaduan.php';
        </script>";
        exit();
    }

    // rename file
    $nama_baru = time() . "_" . $nama_file;

    // upload file
    move_uploaded_file($tmp_file, "foto/" . $nama_baru);
}

// ================== SIMPAN KE DATABASE ==================
$query = "INSERT INTO pengaduan 
(nama_pelapor, kelas_bagian, lokasi, jenis_kerusakan, deskripsi, foto, status)
VALUES 
('$nama', '$kelas', '$lokasi', '$jenis', '$deskripsi', '$nama_baru', 'menunggu')";

// ================== EKSEKUSI QUERY ==================
if (mysqli_query($conn, $query)) {
    header("Location: dashboard_user.php");
} else {
    echo "ERROR: " . mysqli_error($conn);
}

exit();
?>
