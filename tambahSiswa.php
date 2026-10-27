<?php
include 'koneksi.php';

$err_nis = "";
$err_nama = "";
$err_global = "";

if (isset($_POST['submit'])) {
    $nis     = $_POST['nis'];
    $nama    = $_POST['nama'];
    $kelas   = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    $valid = true;

    // 2. Validasi NIS dengan Regex (hanya angka)
    if (!preg_match("/^[0-9]+$/", $nis)) {
        $err_nis = "NIS hanya boleh berisi angka!";
        $valid = false;
    }

    // 3. Validasi Nama dengan Regex (huruf, spasi, titik, koma)
    if (!preg_match("/^[a-zA-Z\s.,]+$/", $nama)) {
        $err_nama = "Nama hanya boleh berisi huruf, spasi, titik (.), dan koma (,)!";
        $valid = false;
    } 

    // Jika semua validasi lolos, maka simpan ke database
    if ($valid) {
        $query = mysqli_query($koneksi, "INSERT INTO siswa (nis, nama, kelas, jurusan) VALUES ('$nis', '$nama', '$kelas', '$jurusan')");

        if ($query) {
            header("Location: tampilSiswa.php");
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
    <title>Tambah Siswa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Data Siswa</h2>

        <!-- Pesan Error Global (jika gagal koneksi/query) -->
        <?php if (!empty($err_global)) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mb-4 text-sm">
                <?= $err_global; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <!-- Input NIS -->
            <div>
                <label class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" name="nis" value="<?= isset($_POST['nis']) ? htmlspecialchars($_POST['nis']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border <?= !empty($err_nis) ? 'border-red-500 bg-red-50' : 'border-gray-300'; ?> p-2 focus:outline-none">
                <!-- Pesan error khusus NIS di bawah input -->
                <?php if (!empty($err_nis)) : ?>
                    <p class="text-red-500 text-xs mt-1"><?= $err_nis; ?></p>
                <?php endif; ?>
            </div>

            <!-- Input Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" name="nama" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border <?= !empty($err_nama) ? 'border-red-500 bg-red-50' : 'border-gray-300'; ?> p-2 focus:outline-none">
                <!-- Pesan error khusus Nama di bawah input -->
                <?php if (!empty($err_nama)) : ?>
                    <p class="text-red-500 text-xs mt-1"><?= $err_nama; ?></p>
                <?php endif; ?>
            </div>

            <!-- Input Kelas -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: XI - 1" value="<?= isset($_POST['kelas']) ? htmlspecialchars($_POST['kelas']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <!-- Input Jurusan -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                <input type="text" name="jurusan" placeholder="Contoh: Rekayasa Perangkat Lunak" value="<?= isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <!-- Button Simpan -->
            <div class="flex items-center justify-between pt-2">
                <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 cursor-pointer">Simpan</button>
                <a href="tampilSiswa.php" class="text-gray-600 hover:underline text-sm">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>