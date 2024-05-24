<?php
require("Koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $kdfa = $_GET['id'];

    $sqlDeNil = "DELETE nil FROM nilai nil INNER JOIN fakultas fak ON nil.kd_fakultas = fak.kd_fakultas WHERE fak.kd_fakultas = ?";
    $sqlDeMhs = "DELETE mhs FROM mahasiswa mhs INNER JOIN fakultas fak ON mhs.kd_fakultas = fak.kd_fakultas WHERE fak.kd_fakultas = ?";
    $sqlDelfak = "DELETE FROM fakultas WHERE kd_fakultas = ?";

    $stmtDeNil = mysqli_prepare($con, $sqlDeNil);
    $stmtDeMhs = mysqli_prepare($con, $sqlDeMhs);
    $stmtDelfak = mysqli_prepare($con, $sqlDelfak);

    mysqli_stmt_bind_param($stmtDeNil, 's', $kdfa);
    mysqli_stmt_bind_param($stmtDeMhs, 's', $kdfa);
    mysqli_stmt_bind_param($stmtDelfak, 's', $kdfa);

    if (mysqli_stmt_execute($stmtDeNil) && mysqli_stmt_execute($stmtDeMhs) && mysqli_stmt_execute($stmtDelfak)) {
        echo "<script>
                alert('Data berhasil dihapus');
                window.location.href = 'table.php';
              </script>";
    } else {
        echo "Data gagal dihapus: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmtDeNil);
    mysqli_stmt_close($stmtDeMhs);
    mysqli_stmt_close($stmtDelfak);
} else {
    echo "Invalid request.";
}

?>
