<?php
include 'koneksi.php';

$err_nama = "";
$err_global = "";

if (isset($_POST['submit'])) {
    $nama     = $_POST['nama'];
    $menu_mbg = $_POST['menu_mbg'];
    $kelas    = $_POST['kelas'];

    $valid = true;

    // Validasi Nama dengan Regex (huruf, spasi, titik, koma)
    if (!preg_match("/^[a-zA-Z\s.,]+$/", $nama)) {
        $err_nama = "Nama hanya boleh berisi huruf, spasi, titik (.), dan koma (,)!";
        $valid = false;
    } 

    // Jika semua validasi lolos, simpan ke database tabel menu_mbg
    if ($valid) {
        $query = mysqli_query($koneksi, "INSERT INTO menu_mbg (nama, menu_mbg, kelas) VALUES ('$nama', '$menu_mbg', '$kelas')");

        if ($query) {
            header("Location: tampilanMbg.php");
            exit();
        } else {
            $err_global = "Gagal menyimpan data ke database!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu MBG</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Data Menu MBG</h2>

        <!-- Pesan Error Global -->
        <?php if (!empty($err_global)) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mb-4 text-sm">
                <?= $err_global; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <!-- Input Nama Siswa (Dipindah ke Paling Atas) -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" name="nama" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border <?= !empty($err_nama) ? 'border-red-500 bg-red-50' : 'border-gray-300'; ?> p-2 focus:outline-none">
                <!-- Pesan error khusus Nama -->
                <?php if (!empty($err_nama)) : ?>
                    <p class="text-red-500 text-xs mt-1"><?= $err_nama; ?></p>
                <?php endif; ?>
            </div>

            <!-- Input Menu MBG -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Menu MBG</label>
                <input type="text" name="menu_mbg" placeholder="Contoh: Nasi Ayam Sehat & Susu" value="<?= isset($_POST['menu_mbg']) ? htmlspecialchars($_POST['menu_mbg']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <!-- Input Kelas -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: XI - 1" value="<?= isset($_POST['kelas']) ? htmlspecialchars($_POST['kelas']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <!-- Button Simpan -->
            <div class="flex items-center justify-between pt-2">
                <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-green-700 cursor-pointer">Simpan</button>
                <a href="tampilanMbg.php" class="text-gray-600 hover:underline text-sm">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
