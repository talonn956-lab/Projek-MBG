<?php 
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penerimaan MBG</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 30px;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .nav-links {
            margin-bottom: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            margin-right: 10px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f1f2f6;
        }
        td {
            border-bottom: 1px solid #e0e0e0;
            font-size: 0.95rem;
        }
        .btn-edit {
            background-color: #f39c12;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .btn-edit:hover {
            background-color: #d68910;
        }
        .btn-hapus {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .btn-hapus:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <h2>Jumlah Penerimaan MBG</h2>
    <div class="nav-links">
        <a href="index.php">&laquo; Menu Utama</a> | 
        <a href="tambahMenerima.php">+ Tambah Data MBG</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kelas</th>
            <th>Jumlah Penerima</th>
            <th>Tidak Menerima</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM mbg") or die(mysqli_error($koneksi));
        while ($data = mysqli_fetch_assoc($query)) { 
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $data['kelas']; ?></td>
            <td><?php echo $data['jumlah_penerima']; ?></td>
            <td><?php echo $data['tidak_menerima']; ?></td>
            <td>
                <a href="editMenerima.php?id=<?php echo $data['id']; ?>" class="btn-edit">Edit</a> 
                <a href="hapusMenerima.php?id=<?php echo $data['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
