<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Utama</title>
    <style>
        /* Mengatur latar belakang, font, dan posisi tengah */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
        }

        /* Gaya untuk Judul Utama */
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        /* Gaya untuk Paragraf */
        p {
            color: #7f8c8d;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        /* Gaya untuk Daftar Menu (List) */
        ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
            max-width: 400px;
        }

        /* Gaya untuk Item List */
        li {
            margin-bottom: 15px;
        }

        /* Gaya untuk Tautan (Link/Tombol Menu) */
        li a {
            display: block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            text-align: center;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Efek saat kursor diarahkan ke tombol */
        li a:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <h1>Aplikasi Penerima MBG</h1>
    <p>Selamat datang di sistem manajemen MBG.</p>
    
    <ul>
        <li><a href="tampilSiswa.php">Data Siswa</a></li>
        <li><a href="tampilanMbg.php">Menu MBG</a></li>
        <li><a href="tampilMenerima.php">Penerima MBG</a></li>
    </ul>
</body>
</html>