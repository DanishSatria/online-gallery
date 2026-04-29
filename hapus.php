<?php
include 'config.php';
$id = $_GET['id'];

// Ambil nama file sebelum datanya dihapus
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT sampul FROM buku WHERE id=$id"));
unlink("assets/uploads/" . $data['sampul']); // Hapus file fisik

mysqli_query($conn, "DELETE FROM buku WHERE id=$id");
header("Location: index.php");
?>