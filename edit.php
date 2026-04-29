<?php
include 'config.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id=$id");
$data = mysqli_fetch_array($query);

if(isset($_POST['update'])) {
    $judul    = $_POST['judul'];
    $penulis  = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    
    if($_FILES['sampul']['name'] != "") {
        // Logika Ganti Foto
        $nama_file = $_FILES['sampul']['name'];
        $tmp_file  = $_FILES['sampul']['tmp_name'];
        $nama_baru = uniqid() . "." . pathinfo($nama_file, PATHINFO_EXTENSION);
        move_uploaded_file($tmp_file, "assets/uploads/" . $nama_baru);
        
        // Hapus file lama di server
        if(file_exists("assets/uploads/" . $data['sampul'])) {
            unlink("assets/uploads/" . $data['sampul']);
        }
        $sampul_final = $nama_baru;
    } else {
        // Pakai foto lama jika tidak upload baru
        $sampul_final = $data['sampul'];
    }

    $update = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', sampul='$sampul_final' WHERE id=$id";
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
    <title>Edit Koleksi - JQ Works</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-[#f1f5f9] min-h-screen flex items-center justify-center p-6 font-sans">

    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl shadow-indigo-100 overflow-hidden animate__animated animate__fadeIn">
        <div class="flex flex-col md:flex-row">
            
            <div class="md:w-1/3 bg-indigo-600 p-8 flex flex-col items-center justify-center text-white">
                <p class="text-xs font-bold uppercase tracking-widest mb-4 opacity-70">Sampul Saat Ini</p>
                <div class="w-32 h-48 rounded-2xl overflow-hidden shadow-2xl border-4 border-white/20">
                    <img src="assets/uploads/<?php echo $data['sampul']; ?>" class="w-full h-full object-cover">
                </div>
                <p class="mt-4 text-center text-xs italic opacity-80">"Update visual untuk menyegarkan pustaka digital."</p>
            </div>

            <div class="md:w-2/3 p-10">
                <div class="mb-8">
                    <h2 class="text-2xl font-black text-slate-800">Edit Aset</h2>
                    <p class="text-slate-400 text-sm">Sesuaikan detail informasi buku kamu.</p>
                </div>

                <form method="POST" enctype="multipart/form-data" class="space-y-5">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Judul Buku</label>
                        <input type="text" name="judul" value="<?php echo $data['judul']; ?>" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 focus:ring-4 focus:ring-indigo-100 transition-all outline-none font-semibold text-slate-700">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Penulis</label>
                            <input type="text" name="penulis" value="<?php echo $data['penulis']; ?>" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 focus:ring-4 focus:ring-indigo-100 transition-all outline-none font-semibold text-slate-700">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Penerbit</label>
                            <input type="text" name="penerbit" value="<?php echo $data['penerbit']; ?>" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 focus:ring-4 focus:ring-indigo-100 transition-all outline-none font-semibold text-slate-700">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-1">Ganti Sampul (Opsional)</label>
                        <input type="file" name="sampul" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                    </div>

                    <div class="flex items-center gap-3 pt-6">
                        <button type="submit" name="update" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-2xl font-black shadow-lg shadow-indigo-100 transition-all active:scale-95">
                            SIMPAN PERUBAHAN
                        </button>
                        <a href="index.php" class="bg-slate-100 hover:bg-slate-200 text-slate-500 p-4 rounded-2xl transition-all">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>