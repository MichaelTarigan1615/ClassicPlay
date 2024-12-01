<?php
session_start();
require 'db.php'; // Pastikan ini menghubungkan ke database

$message = [];

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validasi awal
    if ($password !== $cpassword) {
        $message[] = "Password tidak sama.";
    } elseif (empty($username) || empty($email) || empty($password)) {
        $message[] = "Semua field harus diisi.";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Periksa apakah username sudah ada di database
        $check_query = "SELECT username FROM table_user WHERE username = $1";
        $check_result = pg_query_params($dbconn, $check_query, [$username]);

        if ($check_result && pg_num_rows($check_result) > 0) {
            $message[] = "Username sudah digunakan.";
        } else {
            // Insert user baru
            $query = "INSERT INTO table_user (username, email, password) VALUES ($1, $2, $3)";
            $result = pg_query_params($dbconn, $query, [$username, $email, $hashed_password]);

            if ($result) {
                $_SESSION['success_message'] = "Registrasi berhasil.";
                header("Location: login.php");
                exit();
            } else {
                $message[] = "Gagal mendaftar: " . pg_last_error($dbconn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="img" href="../asset/iconbaru.png" />
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-wrapper">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Register</h2>
            <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '<div class="message">' . htmlspecialchars($msg) . '</div>';
                }
            }
            ?>
            <div class="input-field">
                <input type="text" name="username" id="username"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                    required>
                <label>Username</label>
            </div>
            <div class="input-field">
                <input type="text" name="email" id="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
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
            <button type="submit" name="submit">Gas Daftar</button>
            <div class="account-options">
                <p>Udah ada akun? Gass <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>