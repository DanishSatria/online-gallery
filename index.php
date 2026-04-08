<?php
include 'config.php';
$query = "SELECT * FROM gallery ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Online Gallery</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .btn { display: inline-block; padding: 8px 16px; margin: 5px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        .btn-danger { background: #dc3545; }
        .btn-warning { background: #ffc107; color: black; }
        .gallery-grid { display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px; }
        .card { width: 280px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-body { padding: 12px; }
        .card-title { font-size: 18px; font-weight: bold; margin-bottom: 8px; }
        .card-text { color: #666; font-size: 14px; margin-bottom: 12px; }
        .action { display: flex; justify-content: space-between; }
        .empty { text-align: center; color: #999; margin-top: 50px; }
    </style>
</head>
<body>
<div class="container">
    <h1>📸 Online Gallery</h1>
    <div style="text-align: right;">
        <a href="tambah.php" class="btn">+ Tambah Gambar</a>
    </div>

    <div class="gallery-grid">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <img src="uploads/<?= htmlspecialchars($row['file_path']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>">
                    <div class="card-body">
                        <div class="card-title"><?= htmlspecialchars($row['judul']) ?></div>
                        <div class="card-text"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></div>
                        <div class="action">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning" style="background:#ffc107;">✏️ Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty">Belum ada gambar. Silakan tambah gambar pertama.</div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>