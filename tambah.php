<?php
include 'config.php';
if(isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $nama_file = $_FILES['sampul']['name'];
    $tmp_file = $_FILES['sampul']['tmp_name'];
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru = uniqid() . "." . $ext;
    if(move_uploaded_file($tmp_file, "assets/uploads/" . $nama_baru)) {
        mysqli_query($conn, "INSERT INTO buku (judul, penulis, penerbit, sampul) VALUES ('$judul', '$penulis', '$penerbit', '$nama_baru')");
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Koleksi - JQ Works</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-indigo-50 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl shadow-indigo-200/50 p-10 animate__animated animate__fadeInUp">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-slate-800">Baru untuk JQ Works</h2>
            <p class="text-slate-400 text-sm mt-2">Tambahkan aset digital ke dalam pustaka</p>
        </div>
        
        <form method="POST" enctype="multipart/form-data" class="space-y-6">
            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Judul Buku</label>
                <input type="text" name="judul" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-100 transition-all outline-none" placeholder="Contoh: Belajar PHP Modern" required>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Penulis</label>
                    <input type="text" name="penulis" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-100 transition-all outline-none" placeholder="Nama penulis">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Penerbit</label>
                    <input type="text" name="penerbit" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-100 transition-all outline-none" placeholder="Nama penerbit">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Unggah Sampul</label>
                <label class="flex flex-col items-center justify-center w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] cursor-pointer hover:bg-indigo-50 hover:border-indigo-300 transition-all group">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-slate-400 group-hover:text-indigo-500 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-3xl mb-3"></i>
                        <p class="text-sm">Klik untuk memilih file</p>
                    </div>
                    <input type="file" name="sampul" class="hidden" required />
                </label>
            </div>

            <div class="flex flex-col gap-4 pt-4">
                <button type="submit" name="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-2xl font-black text-lg shadow-xl shadow-indigo-100 transition-all active:scale-95">SIMPAN ASSET</button>
                <a href="index.php" class="text-center text-slate-400 font-bold hover:text-slate-600 transition-colors">KEMBALI KE PANEL</a>
            </div>
        </form>
    </div>
</body>
</html>