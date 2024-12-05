<?php
require 'db.php';
session_start();

$login_message = "";

if (isset($_SESSION["is_login"]) && $_SESSION["is_login"] === true) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Query untuk mengambil data user berdasarkan username
        $sql = "SELECT * FROM user_account WHERE username = $1";
        $result = pg_query_params($dbconn, $sql, [$username]);

        if ($result && pg_num_rows($result) > 0) {
            $data = pg_fetch_assoc($result);

            // Verifikasi password
            if (password_verify($password, $data['password'])) {
                $_SESSION["username"] = $data["username"];
                $_SESSION["user_id"] = $data["id"];
                $_SESSION["is_login"] = true;


                header("Location: home.php");
                exit();
            } else {
                $login_message = "Password salah.";
            }
        } else {
            $login_message = "Username tidak ditemukan.";
        }
    } else {
        $login_message = "Username dan Password wajib diisi.";
    }
    pg_close($dbconn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Classic Play - Login</title>
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <div class="login-wrapper">
    <form action="login.php" method="post">
      <h2>Masuk</h2>
      <div class="input-field">
        <input type="text" name="username" id="username" required />
        <label>Nama</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" id="password" required />
        <label>Kata Sandi</label>
      </div>
      <div class="password-options">
        <label for="remember">
          <input type="checkbox" id="remember" />
          <p>Ingat ID</p>
        </label>
        <a href="#">Lupa password</a>
      </div>

      <i style="color: red;"><?= $login_message ?></i>

      <button type="submit" name="login">Log In</button>
      <div class="account-options">
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
      </div>
    </form>
  </div>
</body>

</html>