<?php
session_start();
require_once 'db.php'; 
if (!isset($_SESSION['user_id'])) {
    die("User not logged in!");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
    try {
        pg_query($dbconn, 'BEGIN');

        $arkanoidQuery = "DELETE FROM arkanoid_score WHERE id_user = $1";
        $arkanoidResult = pg_query_params($dbconn, $arkanoidQuery, [$user_id]);
        if (!$arkanoidResult) {
            throw new Exception("Failed to delete arkanoid scores: " . pg_last_error($dbconn));
        }

        $tetrisQuery = "DELETE FROM tetris_score WHERE id_user = $1";
        $tetrisResult = pg_query_params($dbconn, $tetrisQuery, [$user_id]);
        if (!$tetrisResult) {
            throw new Exception("Failed to delete tetris scores: " . pg_last_error($dbconn));
        }

        $snakeQuery = "DELETE FROM snake_score WHERE id_user = $1";
        $snakeResult = pg_query_params($dbconn, $snakeQuery, [$user_id]);
        if (!$snakeResult) {
            throw new Exception("Failed to delete snake scores: " . pg_last_error($dbconn));
        }

        $userQuery = "DELETE FROM user_account WHERE id = $1";
        $userResult = pg_query_params($dbconn, $userQuery, [$user_id]);
        if (!$userResult) {
            throw new Exception("Failed to delete user account: " . pg_last_error($dbconn));
        }

        pg_query($dbconn, 'COMMIT');

        session_destroy();
        header("Location: login.php");
        exit;
    } catch (Exception $e) {
        pg_query($dbconn, 'ROLLBACK');
        die("Error deleting account: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="delete_account.css" />
</head>
<body>
    <div class="delete-container">
        <h1>Hapus Akun</h1>
        <p>Apakah anda yakin untuk menghapus akun anda? Proses ini tidak dapat dibatalkan.</p>
        <form method="POST" action="">
            <button type="submit" name="delete_account">Ya, hapus akun saya</button>
        </form>
        <a href="account.php">Batal</a>
    </div>
</body>
</html>