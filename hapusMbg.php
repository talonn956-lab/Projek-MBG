<?php
include 'koneksi.php';

// Ambil ID dari URL dengan aman
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Proses hapus data dari tabel mbg
    $query = mysqli_query($koneksi, "DELETE FROM menu_mbg WHERE id = '$id'");

    if ($query) {
        header("Location: tampilanMbg.php?pesan=sukses");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: tampilanMbg.php");
    exit();
}
?>
