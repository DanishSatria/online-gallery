<?php
$host = '10.132.15.76/25'; // atau alamat VM Anda
$user = 'root';      // sesuaikan dengan user MariaDB
$pass = 'danish';          // password MariaDB Anda
$db   = 'db_gallery';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>