<?php require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Classic Play</title>
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <div class="login-wrapper">
    <form onsubmit="return login(event)">
      <h2>Login</h2>
      <div class="input-field">
        <input type="text" id="username" required />
        <label>Username</label>
      </div>
      <div class="input-field">
        <input type="password" required />
        <label>Password</label>
      </div>
      <div class="password-options">
        <label for="remember">
          <input type="checkbox" id="remember" />
          <p>Ingat ID</p>
        </label>
        <a href="#">Lupa password</a>
      </div>
      <button type="submit">Log In</button>
      <div class="account-options">
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
      </div>
    </form>
  </div>

  <!-- <script>
    function login(event) {
      event.preventDefault();

      const uname = document.getElementById("uname").value
      localStorage.setItem("username", uname)
      window.location.href = "home.html";
    }
  </script> -->
</body>

</html>