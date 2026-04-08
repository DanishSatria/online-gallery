<?php
include 'config.php';
$id = $_GET['id'];
$query = "SELECT * FROM gallery WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
if (!$data) {
    die("Data tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Galeri</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .form-container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 8px; margin: 6px 0 16px; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        img { max-width: 100px; margin-top: 10px; }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Edit Gambar</h2>
    <form action="proses_edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <label>Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4"><?= htmlspecialchars($data['deskripsi']) ?></textarea>

        <label>Gambar saat ini</label><br>
        <img src="uploads/<?= $data['file_path'] ?>" width="100"><br>
        <label>Ganti gambar (opsional)</label>
        <input type="file" name="gambar" accept="image/jpeg,image/png">

        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</div>
</body>
</html>