<?php
$host = 'localhost'; // atau alamat VM Anda
$user = 'admin123';      // sesuaikan dengan user MariaDB
$pass = 'admin123';          // password MariaDB Anda
$db   = 'db_gallery';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>