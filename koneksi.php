<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "crud";

// Buat koneksi ke database
$kon = mysqli_connect($host, $user, $password, $db);

// Cek koneksi
if (!$kon) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
