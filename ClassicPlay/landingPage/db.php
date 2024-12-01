<?php
$host = 'localhost';
$port = '5432';
$dbname = 'classic_play';
$user = 'postgres';
$pass = '210000';

try {
    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
    if (!$dbconn) {
        throw new Exception("Koneksi gagal: " . pg_last_error());
    } else {
        echo "Koneksi berhasil";
    }
} catch (Exception $e) {
    die($e->getMessage());
}
?>