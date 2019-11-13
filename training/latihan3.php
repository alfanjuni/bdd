<?php
$mahasiswa = [
    ["Ahmad Alfan", "03211231", "Teknik Informatika", "alfanjuni@gmail.com"],
    ["Jumaun", "03211231", "Teknik Informatika", "alfanjuni@gmail.com"]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan Array 3</title>
</head>
<body>
<h1>Daftar Mahasiswa</h1>
<?php foreach($mahasiswa as $m) :?>
<ul>
        <li><?=$m[0];?></li>
        <li><?=$m[1];?></li>
        <li><?=$m[2];?></li>
        <li><?=$m[3];?></li>
    
</ul>
<?php endforeach;?>
    
</body>
</html>