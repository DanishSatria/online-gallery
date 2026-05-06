<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Mahakarya - Aura Art Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;600&display=swap');
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#fcfcfc] font-sans text-slate-800">

    <nav class="bg-white/90 backdrop-blur-xl sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="bg-emerald-900 w-12 h-12 rounded-full flex items-center justify-center shadow-xl shadow-emerald-100">
                    <i class="fas fa-leaf text-emerald-50 text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-serif font-bold tracking-tight text-slate-900 leading-none">Aura Art</h1>
                    <span class="text-[10px] text-emerald-600 font-bold uppercase tracking-[0.2em]">Eternal Archive</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <a href="tambah.php" class="hidden md:flex items-center bg-slate-900 hover:bg-emerald-900 text-white px-6 py-2.5 rounded-full font-semibold transition-all duration-300 shadow-lg group">
                    <i class="fas fa-plus text-xs mr-2 group-hover:rotate-90 transition-transform"></i>
                    Arsip Karya Baru
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="max-w-2xl mb-16 animate__animated animate__fadeIn">
            <span class="text-emerald-600 font-bold text-sm uppercase tracking-widest mb-3 block">Eksibisi Digital</span>
            <h2 class="text-5xl font-serif font-bold text-slate-900 mb-4 italic">Koleksi Lukisan</h2>
            <div class="h-1 w-20 bg-emerald-500 rounded-full mb-6"></div>
            <p class="text-slate-500 text-lg leading-relaxed">Menjelajahi batas kreativitas melalui sapuan kuas dan emosi yang tertuang dalam kanvas digital.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <?php
            // Pastikan koneksi database menggunakan tabel yang benar
            $query = mysqli_query($conn, "SELECT * FROM lukisan ORDER BY id DESC");
            if(mysqli_num_rows($query) == 0): ?>
                <div class="col-span-full py-32 text-center border-2 border-dashed border-slate-200 rounded-[3rem]">
                    <i class="fas fa-wind text-5xl text-slate-200 mb-6 block"></i>
                    <p class="text-slate-400 font-medium text-xl font-serif">Belum ada mahakarya yang terarsip.</p>
                    <a href="tambah.php" class="text-emerald-600 underline mt-2 inline-block">Mulai menambah koleksi</a>
                </div>
            <?php endif;
            
            while($data = mysqli_fetch_array($query)): ?>
            <div class="group animate__animated animate__fadeInUp">
                <div class="relative p-3 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] rounded-2xl transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-[0_40px_80px_rgba(0,0,0,0.1)]">
                    <div class="relative overflow-hidden rounded-xl aspect-[4/5]">
                        <img src="assets/uploads/<?php echo $data['gambar']; ?>" 
                             class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110"
                             alt="<?php echo $data['judul']; ?>">
                        
                        <div class="absolute inset-0 bg-emerald-950/40 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-[2px] flex items-center justify-center gap-4">
                            <a href="edit.php?id=<?php echo $data['id']; ?>" class="bg-white/90 hover:bg-white p-4 rounded-full text-slate-900 transition-transform hover:scale-110 shadow-xl">
                                <i class="fas fa-pen-nib"></i>
                            </a>
                            <a href="hapus.php?id=<?php echo $data['id']; ?>" class="bg-white/90 hover:bg-red-500 hover:text-white p-4 rounded-full text-red-600 transition-all hover:scale-110 shadow-xl" onclick="return confirm('Hapus karya ini secara permanen?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 px-2 pb-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-bold tracking-[0.15em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full uppercase">
                                <?php echo $data['aliran']; ?>
                            </span>
                            <p class="text-xs text-slate-400 font-medium italic"><?php echo $data['tahun']; ?></p>
                        </div>
                        <h3 class="text-2xl font-serif font-bold text-slate-900 mb-1 group-hover:text-emerald-800 transition-colors">
                            <?php echo $data['judul']; ?>
                        </h3>
                        <p class="text-slate-500 text-sm flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <?php echo $data['seniman']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 mt-24 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex justify-center items-center gap-3 mb-6">
                <div class="h-[1px] w-12 bg-slate-200"></div>
                <i class="fas fa-star text-emerald-900 text-[10px]"></i>
                <div class="h-[1px] w-12 bg-slate-200"></div>
            </div>
            <h4 class="font-serif italic text-2xl text-slate-900 mb-2">Aura Art Gallery</h4>
            <p class="text-slate-400 text-sm tracking-widest uppercase mb-8">Elevating Digital Fine Art Experience</p>
            <p class="text-slate-300 text-[10px]">&copy; 2026 Aura Art Archive. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>