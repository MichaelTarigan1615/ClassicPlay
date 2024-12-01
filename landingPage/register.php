<?php
session_start();
require_once 'db.php';
$register_message = "";
if (isset($_SESSION["is_login"]) && $_SESSION["is_login"] === true) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['cpassword'])) {
        $register_message = "Semua field wajib diisi.";
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password === $cpassword) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                // Periksa apakah username sudah ada
                $sql = "SELECT id FROM user_account WHERE username = $1";
                $result = pg_query_params($dbconn, $sql, [$username]);

                if (pg_num_rows($result) > 0) {
                    $register_message = "Username sudah digunakan.";
                } else {
                    // Insert data ke database
                    $sql = "INSERT INTO user_account (username, email, password) VALUES ($1, $2, $3)";
                    $result = pg_query_params($dbconn, $sql, [$username, $email, $hashed_password]);

                    if ($result) {
                        $_SESSION["username"] = $username;
                        $_SESSION["is_login"] = true;
                        header("Location: home.php");
                        exit();
                    } else {
                        $register_message = "Gagal melakukan registrasi.";
                    }
                }
            } catch (Exception $e) {
                $register_message = "Terjadi kesalahan selama proses registrasi.";
                error_log("Error during registration: " . $e->getMessage());
            }
        } else {
            $register_message = "Password tidak sama.";
        }
    }
    pg_close($dbconn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-wrapper">
        <form action="register.php" method="post">
            <h2>Register</h2>
            <div class="input-field">
                <input type="text" name="username" id="username" required>
                <label>Username</label>
            </div>
            <div class="input-field">
                <input type="email" name="email" id="email" required>
                <label>Email</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
            </div>
            <div class="input-field">
                <input type="password" name="cpassword" id="cpassword" required>
                <label>Konfirmasi Password</label>
            </div>
            
            <i style="color: red;"><?= $register_message ?></i>

            <button type="submit" name="register">Register Now</button>
            <div class="account-options">
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>
