<?php
include 'koneksi.php';

$err_global = "";

if (isset($_POST['submit'])) {
    $tanggal         = $_POST['tanggal'];
    $kelas           = $_POST['kelas'];
    $jumlah_penerima = $_POST['jumlah_penerima'];
    $tidak_menerima  = $_POST['tidak_menerima'];

    $query = mysqli_query($koneksi, "INSERT INTO mbg (tanggal, kelas, jumlah_penerima, tidak_menerima) VALUES ('$tanggal', '$kelas', '$jumlah_penerima', '$tidak_menerima')");

    if ($query) {
        header("Location: tampilMenerima.php");
        exit();
    } else {
        $err_global = "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data MBG</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Data Penerimaan MBG</h2>

        <?php if (!empty($err_global)) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mb-4 text-sm">
                <?= $err_global; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" value="<?= isset($_POST['tanggal']) ? htmlspecialchars($_POST['tanggal']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: X PPLG 3" value="<?= isset($_POST['kelas']) ? htmlspecialchars($_POST['kelas']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Penerima</label>
                <input type="number" name="jumlah_penerima" placeholder="Contoh: 30" value="<?= isset($_POST['jumlah_penerima']) ? htmlspecialchars($_POST['jumlah_penerima']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tidak Menerima</label>
                <input type="number" name="tidak_menerima" placeholder="Contoh: 2" value="<?= isset($_POST['tidak_menerima']) ? htmlspecialchars($_POST['tidak_menerima']) : ''; ?>" required 
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none">
            </div>

            <div class="flex items-center justify-between pt-2">
                <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-green-700 cursor-pointer">Simpan</button>
                <a href="tampilMenerima.php" class="text-gray-600 hover:underline text-sm">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
