<?php
include 'config.php';
if(isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $seniman = mysqli_real_escape_string($conn, $_POST['seniman']);
    $aliran = mysqli_real_escape_string($conn, $_POST['aliran']);
    $tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
    
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru = "AURA_" . uniqid() . "." . $ext;

    if(move_uploaded_file($tmp_file, "assets/uploads/" . $nama_baru)) {
        // Pastikan nama tabel adalah 'lukisan' sesuai update sebelumnya
        $query = "INSERT INTO lukisan (judul, seniman, aliran, tahun, gambar) VALUES ('$judul', '$seniman', '$aliran', '$tahun', '$nama_baru')";
        mysqli_query($conn, $query);
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Mahakarya Baru - Aura Art</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@400;600;800&display=swap');
        .font-serif { font-family: 'Playfair Display', serif; }
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-emerald-50 via-slate-50 to-white">

    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] border border-emerald-100 p-10 md:p-14 animate__animated animate__fadeInUp">
        
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-900 rounded-full mb-6 shadow-lg shadow-emerald-200">
                <i class="fas fa-paint-brush text-white text-2xl"></i>
            </div>
            <h2 class="text-4xl font-serif font-bold text-slate-900 italic">Arsip Mahakarya</h2>
            <p class="text-slate-400 mt-3 font-medium">Abadikan karya seni baru ke dalam koleksi digital Aura Art</p>
        </div>
        
        <form method="POST" enctype="multipart/form-data" class="space-y-8">
            <div class="space-y-3">
                <label class="text-xs font-bold text-emerald-800 uppercase tracking-widest ml-1">Judul Lukisan</label>
                <input type="text" name="judul" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-6 py-4 focus:bg-white focus:border-emerald-200 focus:ring-0 transition-all outline-none text-slate-800 font-semibold italic" placeholder="Contoh: Senja di Pelabuhan" required>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-xs font-bold text-emerald-800 uppercase tracking-widest ml-1">Nama Seniman</label>
                    <input type="text" name="seniman" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-6 py-4 focus:bg-white focus:border-emerald-200 transition-all outline-none font-medium" placeholder="Nama pelukis" required>
                </div>
                <div class="space-y-3">
                    <label class="text-xs font-bold text-emerald-800 uppercase tracking-widest ml-1">Aliran Seni</label>
                    <select name="aliran" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-6 py-4 focus:bg-white focus:border-emerald-200 transition-all outline-none font-medium appearance-none">
                        <option value="Realisme">Realisme</option>
                        <option value="Abstrak">Abstrak</option>
                        <option value="Ekspresionisme">Ekspresionisme</option>
                        <option value="Surialisme">Surialisme</option>
                        <option value="Impressionisme">Impressionisme</option>
                    </select>
                </div>
            </div>

            <div class="space-y-3">
                <label class="text-xs font-bold text-emerald-800 uppercase tracking-widest ml-1">Tahun Karya</label>
                <input type="text" name="tahun" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-6 py-4 focus:bg-white focus:border-emerald-200 transition-all outline-none" placeholder="Contoh: 2024">
            </div>

            <div class="space-y-3">
                <label class="text-xs font-bold text-emerald-800 uppercase tracking-widest ml-1">Visual Lukisan</label>
                <label class="flex flex-col items-center justify-center w-full h-48 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2.5rem] cursor-pointer hover:bg-emerald-50 hover:border-emerald-300 transition-all group overflow-hidden">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-slate-400 group-hover:text-emerald-600 transition-colors">
                        <i class="fas fa-file-image text-4xl mb-4 opacity-50 group-hover:opacity-100 transition-opacity"></i>
                        <p class="text-sm font-semibold italic">Sematkan Berkas Gambar</p>
                        <p class="text-[10px] mt-1 uppercase tracking-tighter">JPG, PNG, atau WEBP (Maks. 5MB)</p>
                    </div>
                    <input type="file" name="gambar" class="hidden" required />
                </label>
            </div>

            <div class="flex flex-col gap-6 pt-6">
                <button type="submit" name="submit" class="w-full bg-emerald-900 hover:bg-slate-900 text-white py-5 rounded-2xl font-extrabold text-lg tracking-widest shadow-2xl shadow-emerald-200 transition-all active:scale-95">
                    ARSIPKAN KARYA
                </button>
                <a href="index.php" class="text-center text-slate-400 font-bold text-xs uppercase tracking-widest hover:text-emerald-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Galeri
                </a>
            </div>
        </form>
    </div>

    <script>
        // Preview sederhana untuk nama file yang dipilih
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0].name;
            const label = this.parentElement.querySelector('p.text-sm');
            label.textContent = "Berkas terpilih: " + fileName;
            label.classList.add('text-emerald-700');
        });
    </script>
</body>
</html>