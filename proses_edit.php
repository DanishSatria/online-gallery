<?php
include 'config.php';
$id = mysqli_real_escape_string($conn, $_POST['id']);
$judul = mysqli_real_escape_string($conn, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

// Ambil file_path lama
$query_old = "SELECT file_path FROM gallery WHERE id = $id";
$result_old = mysqli_query($conn, $query_old);
$old_data = mysqli_fetch_assoc($result_old);
$old_file = $old_data['file_path'];

// Jika upload gambar baru
if ($_FILES['gambar']['name'] != "") {
    $target_dir = "uploads/";
    $file_name = time() . '_' . basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) die("File bukan gambar.");
    if (!in_array($imageFileType, ['jpg','jpeg','png'])) die("Hanya JPG, PNG.");
    if ($_FILES["gambar"]["size"] > 2*1024*1024) die("Maks 2MB.");

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Hapus file lama
        if (file_exists($target_dir . $old_file)) {
            unlink($target_dir . $old_file);
        }
        $file_path = $file_name;
    } else {
        die("Gagal upload.");
    }
} else {
    $file_path = $old_file; // tetap pakai yang lama
}

$query = "UPDATE gallery SET judul='$judul', deskripsi='$deskripsi', file_path='$file_path' WHERE id=$id";
if (mysqli_query($conn, $query)) {
    header("Location: index.php?sukses=diupdate");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>