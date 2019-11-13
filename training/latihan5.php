<?php
// $mahasiswa = [
//     ["Ahmad Alfan", "03211231", "Teknik Informatika", "alfanjuni@gmail.com"],
//     ["Jumaun", "03211231", "Teknik Informatika", "alfanjuni@gmail.com"]
// ];

//Array Assosiative
//Key nya string yang kita buat sendiri
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
    "nrp" => "012321232131",
    "email" => "maun@gmail.com",
    "jurusan" => "Teknik Informatika",
    "gambar" => "2.jpg"
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
    <?php foreach($mahasiswa as $mhs):?>
    <ul>
        <li>
            <img src="img/<?=$mhs["gambar"]?>" alt="photo">
        </li>
        <li>Nama : <?=$mhs["nama"];?></li>
        <li>NRP : <?=$mhs["nrp"];?></li>
        <li>Jurusan : <?=$mhs["jurusan"];?></li>
        <li>Email : <?=$mhs["email"];?></li>
    </ul>
    <?php endforeach;?>
</body>
</html>
