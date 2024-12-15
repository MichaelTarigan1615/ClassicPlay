<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    die("User not logged in!");
}

$user_id = $_SESSION['user_id'];

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_account'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    try {
        pg_query($dbconn, 'BEGIN');

        $query = "UPDATE user_account SET username = $1, email = $2 WHERE id = $3";
        $result = pg_query_params($dbconn, $query, [$username, $email, $user_id]);

        if (!$result) {
            throw new Exception("Failed to update username and email: " . pg_last_error($dbconn));
        }

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $passwordQuery = "UPDATE user_account SET password = $1 WHERE id = $2";
            $passwordResult = pg_query_params($dbconn, $passwordQuery, [$hashedPassword, $user_id]);

            if (!$passwordResult) {
                throw new Exception("Failed to update password: " . pg_last_error($dbconn));
            }
        }

        pg_query($dbconn, 'COMMIT');
        $message = "Account updated successfully!";
    } catch (Exception $e) {
        pg_query($dbconn, 'ROLLBACK');
        $message = "Error updating account: " . $e->getMessage();
    }
}

$query = "SELECT username, email FROM user_account WHERE id = $1";
$result = pg_query_params($dbconn, $query, [$user_id]);
if ($result) {
    $user = pg_fetch_assoc($result);
} else {
    die("Error fetching user data: " . pg_last_error($dbconn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link rel="stylesheet" href="edit_account.css" />
</head>
<body>
    <div class="account-container">
        <h1>Perbarui Akun</h1>
        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div>
                <label for="username">Nama:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div>
                <label for="password">Kata sandi baru (kosongkan jika tidak ingin diubah):</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <button type="submit" name="update_account">Perbarui</button>
            </div>
        </form>
        <a href="account.php">Kembali</a>
    </div>
</body>
</html>