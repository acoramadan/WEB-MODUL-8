<!DOCTYPE html>
<html>
<head>
    <title>Tabel Nilai Mahasiswa</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
require('Koneksi.php');

$sql = "SELECT fakultas.kd_fakultas, fakultas.Nama_Fakultas,
        mahasiswa.stambuk,
        mahasiswa.nama_mahasiswa,
        mahasiswa.kelas,
        mahasiswa.jurusan,
        nilai.nilai
        FROM fakultas
        INNER JOIN mahasiswa ON fakultas.kd_fakultas = mahasiswa.kd_fakultas
        INNER JOIN nilai on nilai.kd_fakultas = fakultas.kd_fakultas";

$hasil = mysqli_query($con, $sql);
?>

<h2>Tabel Nilai Mahasiswa</h2>
<table>
    <thead>
        <th><a href="Index.php"> Tambah Data</a></th>
        <tr>
            <th>Kode Fakultas</th>
            <th>Nama Fakultas</th>
            <th>Stambuk</th>
            <th>Nama Mahasiswa</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Nilai</th>
            <th colspan = " 2" style = "text-align : center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(mysqli_num_rows($hasil) > 0){
            while($row = mysqli_fetch_assoc($hasil)){
                echo "<tr>";
                echo "<td>".$row['kd_fakultas']."</td>";
                echo "<td>".$row['Nama_Fakultas']."</td>";
                echo "<td>".$row['stambuk']."</td>";
                echo "<td>".$row['nama_mahasiswa']."</td>";
                echo "<td>".$row['kelas']."</td>";
                echo "<td>".$row['jurusan']."</td>";
                echo "<td>".$row['nilai']."</td>";
                echo '<td><a href="Delete.php?id='.$row['kd_fakultas'].'" class="btn btn-danger" onclick="return confirm(\'Apakah Anda ingin benar-benar menghapus?\')">Hapus</a></td>';
                echo '<td><a href="Edit.php?id='.$row['kd_fakultas'].'" class="btn btn-primary">Edit</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Tidak ada data ditemukan</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
