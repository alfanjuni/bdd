<?php

$mahasiswa = [
    [
    "nama" => "Alfan Juni",
    "nrp" => "012321232131",
    "email" => "alfanjuni@gmail.com",
    "jurusan" => "Teknik Informatika",
    "gambar" => "1.jpg"
    ],
    [
    "nama" => "Jumaun",
    "nrp" => "4423423",
    "email" => "maun@gmail.com",
    "jurusan" => "Teknik Informatika",
    "gambar" => "1.jpg"
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Daftar Mahasiswa</h1>
<ul>
<?php foreach($mahasiswa as $mhs) :?>
    <li>
        <a href="detail.php?nama=<?=$mhs["nama"];?>&nrp=<?=$mhs["nrp"];?>&gambar=<?=$mhs["gambar"];?>&email=<?=$mhs["email"];?>&jurusan=<?=$mhs["jurusan"];?>"><?=$mhs["nama"];?></a>
    </li>
<?php endforeach; ?>
</ul>
    
</body>
</html>