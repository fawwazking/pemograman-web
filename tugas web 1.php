<?php
session_start(); // aktifkan session
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Biodata Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f2f5;
            color: #333;
        }

        header {
            background: #002b5c;
            color: #fff;
            padding: 20px 40px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        header h1 {
            margin: 0;
            font-size: 26px;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
        }

        h2 {
            color: #002b5c;
            margin-bottom: 15px;
            border-left: 6px solid #0056a6;
            padding-left: 10px;
        }

        form {
            background: #fff;
            padding: 25px 30px;
            margin-bottom: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-left: 5px solid #0056a6;
            border-right: 5px solid #0056a6;
        }

        label {
            font-weight: 600;
            display: block;
            margin: 12px 0 6px;
            color: #444;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, textarea:focus, select:focus {
            border-color: #0056a6;
            box-shadow: 0 0 5px rgba(0, 86, 166, 0.4);
            outline: none;
        }

        .form-group-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .option-box {
            background: #f8f9fb;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option-box:hover {
            border-color: #0056a6;
            background: #eef5ff;
        }

        .option-box input {
            margin-right: 6px;
        }

        input[type="submit"] {
            background: linear-gradient(90deg, #0056a6, #0073e6);
            border: none;
            padding: 12px 20px;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(90deg, #0073e6, #0056a6);
            transform: translateY(-2px);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #eee;
        }

        table th {
            background: #0056a6;
            color: #fff;
        }

        table tr:hover td {
            background: #f1f7ff;
        }

        h3 {
            margin-top: 30px;
            color: #002b5c;
        }

        p {
            font-size: 15px;
            background: #eef5ff;
            padding: 10px 15px;
            border-radius: 8px;
            border-left: 4px solid #0056a6;
            margin: 15px 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Aplikasi Biodata Mahasiswa</h1>
</header>

<div class="container">
    <h2>Form Biodata Mahasiswa</h2>
    <form method="POST" action="">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" required>

        <label>NIM:</label>
        <input type="text" name="nim" required>

        <label>Program Studi:</label>
        <select name="prodi" required>
            <option value="Informatika">Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Elektro">Teknik Elektro</option>
        </select>

        <label>Jenis Kelamin:</label>
        <div class="form-group-inline">
            <label class="option-box"><input type="radio" name="jk" value="Laki-laki" required> Laki-laki</label>
            <label class="option-box"><input type="radio" name="jk" value="Perempuan" required> Perempuan</label>
        </div>

        <label>Hobi:</label>
        <div class="form-group-inline">
            <label class="option-box"><input type="checkbox" name="hobi[]" value="Membaca"> Membaca</label>
            <label class="option-box"><input type="checkbox" name="hobi[]" value="Olahraga"> Olahraga</label>
            <label class="option-box"><input type="checkbox" name="hobi[]" value="Ngoding"> Ngoding</label>
            <label class="option-box"><input type="checkbox" name="hobi[]" value="Musik"> Musik</label>
        </div>

        <label>Alamat:</label>
        <textarea name="alamat" rows="4" required></textarea>

        <input type="submit" value="Kirim Biodata">
    </form>

    <?php
    // Proses data POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama'])) {
        $nama   = htmlspecialchars($_POST['nama']);
        $nim    = htmlspecialchars($_POST['nim']);
        $prodi  = htmlspecialchars($_POST['prodi']);
        $jk     = htmlspecialchars($_POST['jk']);
        $hobi   = isset($_POST['hobi']) ? $_POST['hobi'] : [];
        $alamat = htmlspecialchars($_POST['alamat']);

        // simpan ke session
        $_SESSION['data'][] = [
            "nama" => $nama,
            "nim" => $nim,
            "prodi" => $prodi,
            "jk" => $jk,
            "hobi" => $hobi,
            "alamat" => $alamat
        ];

        echo "<h3>Hasil Biodata</h3>";
        echo "<table>";
        echo "<tr><th>Field</th><th>Data</th></tr>";
        echo "<tr><td>Nama Lengkap</td><td>$nama</td></tr>";
        echo "<tr><td>NIM</td><td>$nim</td></tr>";
        echo "<tr><td>Program Studi</td><td>$prodi</td></tr>";
        echo "<tr><td>Jenis Kelamin</td><td>$jk</td></tr>";
        echo "<tr><td>Hobi</td><td>" . implode(", ", $hobi) . "</td></tr>";
        echo "<tr><td>Alamat</td><td>$alamat</td></tr>";
        echo "</table>";
    }
    ?>

    <h2>Form Pencarian</h2>
    <form method="GET" action="">
        <label>Kata Kunci Pencarian:</label>
        <input type="text" name="keyword" placeholder="Masukkan kata kunci..." required>
        <input type="submit" value="Cari">
    </form>

    <?php
    // Proses data GET
    if (isset($_GET['keyword'])) {
        $keyword = strtolower(htmlspecialchars($_GET['keyword']));
        echo "<p>Anda mencari data dengan kata kunci: <b>$keyword</b></p>";

        if (isset($_SESSION['data']) && !empty($_SESSION['data'])) {
            $hasil = array_filter($_SESSION['data'], function($mhs) use ($keyword) {
                return strpos(strtolower($mhs['nama']), $keyword) !== false ||
                       strpos(strtolower($mhs['nim']), $keyword) !== false ||
                       strpos(strtolower($mhs['prodi']), $keyword) !== false ||
                       strpos(strtolower($mhs['jk']), $keyword) !== false ||
                       strpos(strtolower(implode(", ", $mhs['hobi'])), $keyword) !== false ||
                       strpos(strtolower($mhs['alamat']), $keyword) !== false;
            });

            if (!empty($hasil)) {
                echo "<table>";
                echo "<tr><th>Nama</th><th>NIM</th><th>Prodi</th><th>JK</th><th>Hobi</th><th>Alamat</th></tr>";
                foreach ($hasil as $mhs) {
                    echo "<tr>";
                    echo "<td>{$mhs['nama']}</td>";
                    echo "<td>{$mhs['nim']}</td>";
                    echo "<td>{$mhs['prodi']}</td>";
                    echo "<td>{$mhs['jk']}</td>";
                    echo "<td>" . implode(", ", $mhs['hobi']) . "</td>";
                    echo "<td>{$mhs['alamat']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p><b>Tidak ada data ditemukan.</b></p>";
            }
        } else {
            echo "<p><b>Belum ada data mahasiswa yang ditambahkan.</b></p>";
        }
    }
    ?>
</div>

</body>
</html>
