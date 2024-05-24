<?php
include "Koneksi.php";
if(isset($_POST["submit"])){
    $fakultas = $_POST['fakultas'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $stambuk = $_POST['stambuk'];
    $jurusan = $_POST['jurusan'];
    $nilai = $_POST['nilai'];
  
    $sql = "INSERT INTO fakultas VALUES('', '$fakultas')";
    if($con->query($sql) === true){
        $idFak = $con->insert_id;

        $sqlMahasiswa = "INSERT INTO mahasiswa VALUES ('$stambuk','$idFak','$nama','$kelas','$jurusan')";
        if(mysqli_query($con,$sqlMahasiswa) === true){
            $sqlNilai = "INSERT INTO nilai(kd_fakultas,stambuk,nilai) VALUES ('$idFak','$stambuk','$nilai')";
            if(mysqli_query($con,$sqlNilai) === true){
                echo "<script>
                        alert('Berhasil mengupload'); 
                        document.location.href = 'table.php';
                      </script>";
            } else {
                echo "<script> 
                        alert('Gagal mengupload data ke tabel nilai!'); 
                        document.location.href = 'table.php';
                      </script>";
            }
        } else {
            echo "<script> 
                    alert('Gagal mengupload data ke tabel mahasiswa!'); 
                    document.location.href = 'table.php';
                  </script>";
        }
    } else {
        echo "<script> 
                alert('Gagal mengupload data ke tabel fakultas!'); 
                document.location.href = 'table.php';
              </script>";
    }
}
?>
