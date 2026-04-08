<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Upload file
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = time() . '_' . basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar asli
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        die("File bukan gambar.");
    }

    // Batasi tipe
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        die("Hanya JPG, JPEG, PNG yang diperbolehkan.");
    }

    // Batasi ukuran 2MB
    if ($_FILES["gambar"]["size"] > 2 * 1024 * 1024) {
        die("Ukuran file maksimal 2MB.");
    }

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO gallery (judul, deskripsi, file_path) VALUES ('$judul', '$deskripsi', '$file_name')";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php?sukses=ditambahkan");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal upload file.";
    }
} else {
    header("Location: tambah.php");
}
?>