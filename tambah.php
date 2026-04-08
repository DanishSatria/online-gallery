<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Galeri</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .form-container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, textarea { width: 100%; padding: 8px; margin: 6px 0 16px; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .back { display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Tambah Gambar Baru</h2>
    <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
        <label>Judul *</label>
        <input type="text" name="judul" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4"></textarea>

        <label>File Gambar * (JPG, PNG, maks 2MB)</label>
        <input type="file" name="gambar" accept="image/jpeg,image/png" required>

        <button type="submit">Simpan</button>
        <a href="index.php" class="back">← Kembali</a>
    </form>
</div>
</body>
</html>