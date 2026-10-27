<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $query = mysqli_query($koneksi, "DELETE FROM mbg WHERE id = '$id'");
    if ($query) {
        header("Location: tampilMenerima.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: tampilMenerima.php");
    exit();
}
?>
