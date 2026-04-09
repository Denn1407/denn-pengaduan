<!DOCTYPE html>
<html>

<head>
    <title>Form Pengaduan</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="center-page">

    <div class="form-container">
        <h2>Form Pengaduan Sarana</h2>

        <form action="simpan.php" method="POST" enctype="multipart/form-data">

            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>Kelas:</label>
            <select name="kelas" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="RPL">RPL</option>
                <option value="TKR">TKR</option>
                <option value="TSM">TSM</option>
                <option value="DKV">DKV</option>
            </select>

            <label>Lokasi:</label>
            <input type="text" name="lokasi" required>

            <label>Jenis Kerusakan:</label>
            <input type="text" name="jenis" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" rows="4"></textarea>

            <label>Upload Foto:</label>
            <input type="file" name="foto">

            <button type="submit">Kirim</button>
            <a href="dashboard_user.php" class="btn btn-primary">← Kembali</a>
        </form>

        <br>
        <div class="button-group">
</div>

</body>

</html>