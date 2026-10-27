<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Proses hapus data siswa langsung berdasarkan ID
    $query = mysqli_query($koneksi, "DELETE FROM siswa WHERE id = '$id'");

    if ($query) {
        // Jika berhasil, arahkan kembali ke halaman tampil siswa dengan pesan sukses
        header("Location: tampilSiswa.php?pesan=sukses");
        exit();
    } else {
        // Jika gagal hapus
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika ID tidak valid
    header("Location: tampilSiswa.php");
    exit();
}
?>
