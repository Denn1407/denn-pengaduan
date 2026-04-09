<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_array($query);

if ($data) {

    $_SESSION['level'] = $data['level'];
    $_SESSION['username'] = $data['username'];

    if ($data['level'] == 'admin') {
        header("Location: dashboard_admin.php");
        exit();
    } elseif ($data['level'] == 'user') {
        header("Location: dashboard_user.php");
        exit();
    }

} else {
    echo "<script>
        alert('Login gagal!');
        window.location='login.php';
    </script>";
}
?>