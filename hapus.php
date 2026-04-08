<?php
include 'config.php';
$id = $_GET['id'];
$query = "SELECT file_path FROM gallery WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
if ($data) {
    // Hapus file gambar
    $file_path = "uploads/" . $data['file_path'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
    // Hapus dari database
    mysqli_query($conn, "DELETE FROM gallery WHERE id = $id");
}
header("Location: index.php");
?>