<?php
include 'config.php';
$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM lukisan WHERE id=$id");
$data = mysqli_fetch_array($query);

if(isset($_POST['update'])) {
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $seniman = mysqli_real_escape_string($conn, $_POST['seniman']);
    $aliran  = mysqli_real_escape_string($conn, $_POST['aliran']);
    $tahun   = mysqli_real_escape_string($conn, $_POST['tahun']);
    
    if($_FILES['gambar']['name'] != "") {
        // Logika Ganti Gambar
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $nama_baru = "AURA_UPD_" . uniqid() . "." . pathinfo($nama_file, PATHINFO_EXTENSION);
        move_uploaded_file($tmp_file, "assets/uploads/" . $nama_baru);
        
        // Hapus file lama di server agar penyimpanan tidak penuh
        if(file_exists("assets/uploads/" . $data['gambar'])) {
            unlink("assets/uploads/" . $data['gambar']);
        }
        $gambar_final = $nama_baru;
    } else {
        // Pakai gambar lama jika tidak upload baru
        $gambar_final = $data['gambar'];
    }

    $update = "UPDATE lukisan SET judul='$judul', seniman='$seniman', aliran='$aliran', tahun='$tahun', gambar='$gambar_final' WHERE id=$id";
    if(mysqli_query($conn, $update)) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahakarya - Aura Art Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@400;600;900&display=swap');
        .font-serif { font-family: 'Playfair Display', serif; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-3xl rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] overflow-hidden animate__animated animate__fadeIn border border-emerald-50">
        <div class="flex flex-col md:flex-row">
            
            <div class="md:w-2/5 bg-emerald-950 p-10 flex flex-col items-center justify-center text-white">
                <span class="text-[10px] font-bold uppercase tracking-[0.3em] mb-6 text-emerald-400">Pratinjau Saat Ini</span>
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative w-40 h-56 rounded-xl overflow-hidden shadow-2xl border-4 border-white/10">
                        <img src="assets/uploads/<?php echo $data['gambar']; ?>" class="w-full h-full object-cover">
                    </div>
                </div>
                <p class="mt-8 text-center text-xs italic font-serif text-emerald-100/60 leading-relaxed">
                    "Seni tidak pernah selesai,<br>hanya ditinggalkan."<br>— Leonardo da Vinci
                </p>
            </div>

            <div class="md:w-3/5 p-12">
                <div class="mb-10">
                    <h2 class="text-3xl font-serif font-bold text-slate-900 italic">Kurasi Ulang</h2>
                    <p class="text-slate-400 text-sm mt-1">Perbarui detail informasi dari mahakarya ini.</p>
                </div>

                <form method="POST" enctype="multipart/form-data" class="space-y-6">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 ml-1">Judul Lukisan</label>
                        <input type="text" name="judul" value="<?php echo $data['judul']; ?>" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-5 py-3 focus:bg-white focus:border-emerald-200 transition-all outline-none font-semibold text-slate-800 italic" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 ml-1">Seniman</label>
                            <input type="text" name="seniman" value="<?php echo $data['seniman']; ?>" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-5 py-3 focus:bg-white focus:border-emerald-200 transition-all outline-none font-medium text-slate-700">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 ml-1">Tahun</label>
                            <input type="text" name="tahun" value="<?php echo $data['tahun']; ?>" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-5 py-3 focus:bg-white focus:border-emerald-200 transition-all outline-none font-medium text-slate-700">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 ml-1">Aliran Seni</label>
                        <select name="aliran" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-5 py-3 focus:bg-white focus:border-emerald-200 transition-all outline-none font-medium text-slate-700 appearance-none">
                            <option value="Realisme" <?php echo ($data['aliran'] == 'Realisme') ? 'selected' : ''; ?>>Realisme</option>
                            <option value="Abstrak" <?php echo ($data['aliran'] == 'Abstrak') ? 'selected' : ''; ?>>Abstrak</option>
                            <option value="Ekspresionisme" <?php echo ($data['aliran'] == 'Ekspresionisme') ? 'selected' : ''; ?>>Ekspresionisme</option>
                            <option value="Surialisme" <?php echo ($data['aliran'] == 'Surialisme') ? 'selected' : ''; ?>>Surialisme</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 ml-1">Perbarui Visual (Opsional)</label>
                        <div class="flex items-center gap-2">
                            <label class="flex-1">
                                <input type="file" name="gambar" class="hidden" id="file-upload">
                                <div class="w-full bg-emerald-50 text-emerald-700 border-2 border-dashed border-emerald-100 py-3 rounded-2xl text-center text-xs font-bold cursor-pointer hover:bg-emerald-100 transition-all">
                                    <i class="fas fa-upload mr-2"></i> Pilih File Baru
                                </div>
                            </label>
                        </div>
                        <p id="file-name" class="text-[9px] text-slate-400 mt-1 italic ml-1"></p>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" name="update" class="flex-1 bg-emerald-900 hover:bg-slate-900 text-white py-4 rounded-2xl font-bold tracking-widest shadow-xl shadow-emerald-100 transition-all active:scale-95">
                            SIMPAN PERUBAHAN
                        </button>
                        <a href="index.php" class="bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-400 p-4 rounded-2xl transition-all">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('file-upload').onchange = function () {
            document.getElementById('file-name').innerHTML = "<i class='fas fa-check-circle mr-1'></i> " + this.files.item(0).name;
        };
    </script>
</body>
</html>