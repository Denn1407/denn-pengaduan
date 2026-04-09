<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="center-page">

    <div class="form-container">
    <h2>Login</h2>

    <form action="proses_login.php" method="POST">
        <label>Username</label>
        <input type="text" name="username">

        <label>Password</label>
        <input type="password" name="password">

        <button type="submit">Login</button>
    </form>
</div>

</body>

</html>