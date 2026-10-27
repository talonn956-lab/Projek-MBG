<?php
$host = "127.0.0.1";
$user = "root";
$pass = "root";
$db   = "dbmbg"; // Sesuaikan dengan nama database Anda

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>