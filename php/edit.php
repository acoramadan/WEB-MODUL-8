<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<?php
require('Koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $stambuk = $_GET['id'];

    $sql = "SELECT m.stambuk, m.nama_mahasiswa, m.kelas, m.jurusan, f.Nama_Fakultas,n.nilai
            FROM mahasiswa m
            INNER JOIN fakultas f ON m.kd_fakultas = f.kd_fakultas INNER JOIN nilai n ON n.kd_fakultas = f.kd_fakultas
            WHERE m.kd_fakultas = ?";
    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        die('Error: ' . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, 's', $stambuk);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
?>
    <form method="POST" action="update.php">
        <input type="hidden" name="stambuk" value="<?php echo $row['stambuk']; ?>">

        <label for="nama_mahasiswa">Nama Mahasiswa:</label><br>
        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" value="<?php echo $row['nama_mahasiswa']; ?>"><br><br>

        <label for="kelas">Kelas:</label><br>
        <input type="text" id="kelas" name="kelas" value="<?php echo $row['kelas']; ?>"><br><br>

        <label for="jurusan">Jurusan:</label><br>
        <input type="text" id="jurusan" name="jurusan" value="<?php echo $row['jurusan']; ?>"><br><br>

        <label for="nama_fakultas">Nama Fakultas:</label><br>
        <input type="text" id="nama_fakultas" name="nama_fakultas" value="<?php echo $row['Nama_Fakultas']; ?>"><br><br>

        <label for="nilai">nilai</label><br>
        <input type="number" id="nilai" name="nilai" value="<?php echo $row['nilai']; ?>"><br><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
<?php
    } else {
        echo "Data mahasiswa tidak ditemukan.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Permintaan tidak valid.";
}

mysqli_close($con);
?>
</html>

