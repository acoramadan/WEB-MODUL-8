<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar kampus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="insert.php" method="post">
    <div class="form-container">
        <input type="hidden" name ="kd_fakultas" value = " <?=$kdfa;?>">
        <div>
            <label for="nama">Masukkan nama :</label>
            <input type="text" name="nama" id="nama">
        </div>
        <div>
            <label for="stambuk">Masukkan nim :</label>
            <input type="text" name="stambuk" id="stambuk">
        </div>
        <div>
            <label for="kelas">Masukkan kelas :</label>
            <input type="text" name="kelas" id="kelas">
        </div>
        <div>
            <label for="jurusan">Masukkan jurusan :</label>
            <input type="text" name="jurusan" id="jurusan">
        </div>
        <div>
            <label for="fakultas">Masukkan fakultas yang ingin dipilih :</label>
            <input type="text" name="fakultas" id="fakultas">
        </div>
        <div>
            <label for="nilai">Masukkan nilai anda :</label> 
            <input type="number" name="nilai" id="nilai">
        </div>
        <div>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
        </div>
    </div>
    </form>
</body>
</html>
