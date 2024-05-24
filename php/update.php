<?php
require('Koneksi.php');

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stambuk'])) {
    // Ambil data yang dikirim melalui formulir
    $stambuk = $_POST['stambuk'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $nama_fakultas = $_POST['nama_fakultas'];
    $nilai = $_POST['nilai'];

    // Persiapkan query SQL untuk melakukan pembaruan data pada tabel mahasiswa
    $sqlUpdateMahasiswa = "UPDATE mahasiswa m
                           INNER JOIN fakultas f ON m.kd_fakultas = f.kd_fakultas
                           SET m.nama_mahasiswa = ?, m.kelas = ?, m.jurusan = ?, f.Nama_Fakultas = ?
                           WHERE m.stambuk = ?";
    
    // Persiapkan query SQL untuk melakukan pembaruan data pada tabel nilai
    $sqlUpdateNilai = "UPDATE nilai n
                       INNER JOIN fakultas f ON n.kd_fakultas = f.kd_fakultas
                       SET n.nilai = ?
                       WHERE n.kd_fakultas = (SELECT kd_fakultas FROM mahasiswa WHERE stambuk = ?) AND n.stambuk = ?";

    // Persiapkan statement untuk dieksekusi
    $stmtMahasiswa = mysqli_prepare($con, $sqlUpdateMahasiswa);
    $stmtNilai = mysqli_prepare($con, $sqlUpdateNilai);

    // Bind parameter ke statement yang sudah disiapkan
    mysqli_stmt_bind_param($stmtMahasiswa, 'sssss', $nama_mahasiswa, $kelas, $jurusan, $nama_fakultas, $stambuk);
    mysqli_stmt_bind_param($stmtNilai, 'sss', $nilai, $stambuk, $stambuk);

    // Eksekusi statement dan periksa keberhasilannya
    if (mysqli_stmt_execute($stmtMahasiswa) && mysqli_stmt_execute($stmtNilai)) {
        echo "<script>
            alert('Data berhasil diperbarui');
            window.location.href = 'table.php';
        </script>";
    } else {
        echo "Data gagal diperbarui: " . mysqli_error($con);
    }

    // Tutup statement yang sudah dieksekusi
    mysqli_stmt_close($stmtMahasiswa);
    mysqli_stmt_close($stmtNilai);
} else {
    echo "Permintaan tidak valid.";
}

// Tutup koneksi database
mysqli_close($con);
?>
