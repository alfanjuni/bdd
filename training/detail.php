<?php
if(!isset($_GET["nama"])){
    header("Location: latihanget.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Mahasiswa</title>
</head>
<body>
<ul>
    <li><img src="img/<?= $_GET["gambar"];?>" alt=""></li>
    <li><?= $_GET["nama"];?></li>
    <li><?= $_GET["nrp"];?></li>
    <li><?= $_GET["email"];?></li>
    <li><?= $_GET["jurusan"];?></li>
</ul>
<a href="latihanget.php">Kembali Ke home</a>
    
</body>
</html>