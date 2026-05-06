<?php
include 'config.php';

// Pastikan ID ada dan valid
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // 1. Ambil informasi nama berkas gambar sebelum data di database dihapus
    $query = mysqli_query($conn, "SELECT gambar FROM lukisan WHERE id=$id");
    
    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
        $nama_file = $data['gambar'];
        $path = "assets/uploads/" . $nama_file;

        // 2. Hapus file fisik dari folder server jika file tersebut ada
        if(!empty($nama_file) && file_exists($path)) {
            unlink($path);
        }

        // 3. Hapus data dari database
        mysqli_query($conn, "DELETE FROM lukisan WHERE id=$id");
    }
}

// 4. Kembali ke halaman utama galeri
header("Location: index.php");
exit();
?>