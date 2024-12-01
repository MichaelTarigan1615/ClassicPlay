<?php
require 'db.php';
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
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Register</h2>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            }
            ?>
            <div class="input-field">
                <input type="text" name="name" id="username" required>
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
            <div class="input-field file-upload">
                <input type="file" name="image" id="file" accept="image/jpg, image/jpeg, image/png">
            </div>
            <button type="submit" name="submit">Register Now</button>
            <div class="account-options">
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>