<?php
session_start();
require_once 'db.php'; // Memuat koneksi dan konfigurasi database dari db.php

// Periksa apakah sesi user_id tersedia
if (!isset($_SESSION['user_id'])) {
    die("User not logged in!"); // Pastikan user sudah login
}

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: ../index.php");
}

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

try {
    // Query untuk mengambil data user berdasarkan user_id dari tabel user_account
    $query = "SELECT username, email FROM user_account WHERE id = $1";
    $result = pg_query_params($dbconn, $query, [$user_id]);

    if (!$result) {
        throw new Exception("Query failed: " . pg_last_error($dbconn));
    }

    // Ambil hasil query
    $user = pg_fetch_assoc($result);

    if (!$user) {
        die("User not found!");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="edit_account.css" />
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
    </style>
</head>
<body>
    <div class="account-container position-relative">
        <a href="home.php" class="btn btn-primary position-absolute" style="top: 0; right: 10px;">X</a>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="d-flex">
                <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                <a href="edit_account.php" class="edit"><i class="bi bi-pencil btn-primary ms-1"></i></a>
            </div>
            <div class="d-flex">
                <p class="text-danger"><?php echo htmlspecialchars($user['email']); ?></p>
                <a href="delete_account.php" class="mt-0"><i class="bi bi-trash ms-1"></i></a>
            </div>
        </div>
        <div class="container">
            <form method="post" action="account.php" class="mt-3 mb-2">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>