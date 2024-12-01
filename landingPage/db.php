<?php
$host     = 'localhost';
$port     = '5432';
$dbname   = 'classic_play';
$user     = 'postgres';
$password = '123';

try {
    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if (!$dbconn) {
        throw new Exception("Koneksi gagal: " . pg_last_error());
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>