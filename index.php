<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku - JQ Works Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-[#f8fafc] font-sans">

    <nav class="bg-white/70 backdrop-blur-lg sticky top-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <i class="fas fa-layer-group text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-slate-900 leading-none">JQ Works</h1>
                    <span class="text-xs text-indigo-600 font-semibold uppercase tracking-widest">Digital Archive</span>
                </div>
            </div>
            <a href="tambah.php" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-bold transition-all hover:scale-105 active:scale-95 shadow-md">
                <i class="fas fa-plus-circle mr-2"></i>Tambah Koleksi
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-12 animate__animated animate__fadeIn">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Koleksi Buku</h2>
            <p class="text-slate-500 mt-2">Daftar literatur digital yang tersedia di sistem JQ Works.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
            if(mysqli_num_rows($query) == 0): ?>
                <div class="col-span-full py-20 text-center">
                    <i class="fas fa-folder-open text-6xl text-slate-200 mb-4"></i>
                    <p class="text-slate-400 font-medium">Belum ada koleksi yang ditambahkan.</p>
                </div>
            <?php endif;
            while($data = mysqli_fetch_array($query)): ?>
            <div class="group bg-white rounded-[2rem] p-4 shadow-sm border border-slate-100 hover:shadow-xl hover:border-indigo-100 transition-all duration-500 animate__animated animate__zoomIn">
                <div class="relative overflow-hidden rounded-[1.5rem] h-64 mb-4">
                    <img src="assets/uploads/<?php echo $data['sampul']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="bg-white p-3 rounded-full text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all shadow-lg">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="hapus.php?id=<?php echo $data['id']; ?>" class="bg-white p-3 rounded-full text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-lg" onclick="return confirm('Hapus buku ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="px-2 pb-2">
                    <span class="text-[10px] font-bold text-indigo-500 bg-indigo-50 px-2 py-1 rounded-md uppercase mb-2 inline-block"><?php echo $data['penerbit']; ?></span>
                    <h3 class="font-bold text-slate-800 text-lg line-clamp-1"><?php echo $data['judul']; ?></h3>
                    <p class="text-slate-400 text-sm mt-1 mb-4 italic"><i class="fas fa-at mr-1 text-xs"></i><?php echo $data['penulis']; ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer class="text-center py-12 text-slate-400 text-sm italic">
        Powered by <span class="font-bold text-indigo-600">JQ Works</span> &copy; 2026
    </footer>
</body>
</html>