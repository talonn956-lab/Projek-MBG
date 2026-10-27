<?php
include 'koneksi.php';

// Ambil ID dari URL dengan aman
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data berdasarkan ID menggunakan Prepared Statement dari tabel mbg
$stmt = mysqli_prepare($koneksi, "SELECT * FROM mbg WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$data) {
    die("Data penerimaan MBG tidak ditemukan.");
}

$error = "";

// Proses Update saat tombol Simpan Perubahan ditekan
if (isset($_POST['ubah'])) {
    $tanggal         = trim($_POST['tanggal']);
    $kelas           = trim($_POST['kelas']);
    $jumlah_penerima = trim($_POST['jumlah_penerima']);
    $tidak_menerima  = trim($_POST['tidak_menerima']);

    // Validasi sederhana
    if (empty($tanggal) || empty($kelas) || $jumlah_penerima === "" || $tidak_menerima === "") {
        $error = "Semua kolom wajib diisi!";
    } else {
        // Query Update menggunakan Prepared Statement untuk tabel mbg
        $stmt_update = mysqli_prepare($koneksi, "UPDATE mbg SET tanggal = ?, kelas = ?, jumlah_penerima = ?, tidak_menerima = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt_update, 'ssiii', $tanggal, $kelas, $jumlah_penerima, $tidak_menerima, $id);
        
        if (mysqli_stmt_execute($stmt_update)) {
            header("Location: tampilMenerima.php");
            exit();
        } else {
            $error = "Gagal memperbarui data penerimaan MBG!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penerimaan MBG</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Edit Data Penerimaan MBG</h2>

        <?php if (!empty($error)) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <!-- Hidden input untuk membawa ID -->
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <!-- Tanggal -->
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="<?= htmlspecialchars($data['tanggal']); ?>" required 
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-green-500">
            </div>

            <!-- Kelas -->
            <div>
                <label class="block text-sm font-medium mb-1">Kelas</label>
                <input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']); ?>" required 
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-green-500">
            </div>

            <!-- Jumlah Penerima -->
            <div>
                <label class="block text-sm font-medium mb-1">Jumlah Penerima</label>
                <input type="number" name="jumlah_penerima" value="<?= htmlspecialchars($data['jumlah_penerima']); ?>" required 
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-green-500">
            </div>

            <!-- Tidak Menerima -->
            <div>
                <label class="block text-sm font-medium mb-1">Tidak Menerima</label>
                <input type="number" name="tidak_menerima" value="<?= htmlspecialchars($data['tidak_menerima']); ?>" required 
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:border-green-500">
            </div>

            <div class="flex items-center justify-between pt-2">
                <button type="submit" name="ubah" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 cursor-pointer">Simpan Perubahan</button>
                <a href="tampilMenerima.php" class="text-gray-600 text-sm hover:underline">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
