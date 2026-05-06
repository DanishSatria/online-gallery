<?php
$host = 'localhost'; // atau alamat VM Anda
$user = 'admin123';      // sesuaikan dengan user MariaDB
$pass = 'admin123';          // password MariaDB Anda
$db   = 'galllery_db';          // nama database yang sudah Anda buat

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>