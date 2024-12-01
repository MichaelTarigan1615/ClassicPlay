<?php
session_start();
require 'db.php';

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT ID_user, password FROM table_user WHERE username = $1";
  $result = pg_query_params($dbconn, $query, [$username]);

  if ($result && pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
      $_SESSION['username'] = $username;
      $_SESSION['ID_user'] = $user['ID_user'];
      header("location: home.php");
      exit();
    } else {
      $message[] = "Password salah.";
    }
  } else {
    $message[] = "Username tidak ditemukan.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Classic Play</title>
  <link rel="icon" type="img" href="../asset/iconbaru.png" />
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <div class="login-wrapper">
    <form method="post" action="">
      <h2>Login</h2>
      <div class="input-field">
        <input type="text" id="username" name="username" required />
        <label>Username</label>
      </div>
      <div class="input-field">
        <input type="password" id="password" name="password" required />
        <label>Password</label>
      </div>
      <!-- <div class="password-options">
        <label for="remember">
          <input type="checkbox" id="remember" />
          <p>Ingat ID</p>
        </label>
        <a href="#">Lupa password</a>
      </div> -->
      <button type="submit" name="submit">Log In</button>
      <div class="account-options">
        <p>Gada akun? Sinii <a href="register.php">Daftar</a></p>
      </div>
    </form>
  </div>
</body>

</html>