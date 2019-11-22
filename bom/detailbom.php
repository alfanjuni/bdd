<?php
$conn = mysqli_connect("localhost", "root", "", "bdd");

//ambil data dari product fini
$id = $_POST["kode"];
$kode_query = mysqli_query($conn, "SELECT `produit_fini`.`Ref_prod_fini`, CONCAT(`gamme`.`code_gamme`,'-',`meuble`.`code_meuble`,'-',`couleur`.`Code_couleur`) AS kode FROM `couleur` INNER JOIN `produit_fini` ON `couleur`.`Ref_couleur` = `produit_fini`.`Ref_couleur` INNER JOIN `produit_brut` ON `produit_fini`.`Ref_produit` = `produit_brut`.`Ref_produit` INNER JOIN `meuble` ON `produit_brut`.`Ref_meuble` = `meuble`.`Ref_meuble` INNER JOIN `gamme` ON `meuble`.`Ref_gamme` = `gamme`.`ref_gamme` WHERE `produit_fini`.`Ref_prod_fini`=$id");
$aksesoris_query = mysqli_query($conn,"SELECT * FROM contient LEFT JOIN `bdd`.`accessoire` ON (`contient`.`Ref_accessoire` = `accessoire`.`Ref_accessoire`) WHERE contient.Ref_prod_fini=$id");
$packing_query = mysqli_query($conn,"SELECT * FROM `bdd`.`contientpacking` 
LEFT JOIN `bdd`.`packing` ON (`contientpacking`.`Ref_packing_item` = `packing`.`Ref_emballage`)
INNER JOIN `emballage` ON (`contientpacking`.`Ref_packing_type` = `emballage`.`Ref_emballage`)
WHERE contientpacking.Ref_prod_fini=$id");
$cloth_query = mysqli_query($conn,"SELECT `contientcloth`.`Ref_Cloth_Content`, `contientcloth`.`Width`, `contientcloth`.`Length`,`contientcloth`.`NbUnit`, `cloth`.`Price`, `cloth`.`Margin`, `cloth`.`Name`, `contientcloth`.`Ref_prod_fini`
FROM `cloth`
INNER JOIN `contientcloth` 
	ON `cloth`.`Ref_Cloth` = `contientcloth`.`Ref_Cloth`
INNER JOIN `produit_fini`
	ON `contientcloth`.`Ref_prod_fini` = `produit_fini`.`Ref_prod_fini`
 WHERE `produit_fini`.`Ref_prod_fini`=$id");
$finishing_query = mysqli_query($conn,"SELECT * FROM `contientfinishing` INNER JOIN `couleur` oN `contientfinishing`.`Ref_couleur` = `couleur`.`Ref_couleur`
WHERE `Ref_prod_fini` = $id");


// if(!$result){
//     echo mysqli_error($conn);
// }
// else{
//     var_dump($result);
// }
//mysqli_fetch_row()
//mysqli_fetch_assoc()
//mysqli_fetch_array()
//mysqli_fetch_object()
// while($kode = mysqli_fetch_assoc($result)){
//   var_dump($kode);
// }

$kodefini =  mysqli_fetch_assoc($kode_query);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail BOM PRODUK</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  
</head>
<body>
<div class="container my-5">
<div class="card">
<div class="card-header">
<h1>
Detail BOM <?=$_POST["kode"];?> - ( <?=$kodefini["kode"];?> )
</h1>
</div>
<div class="card-body">
<div class="pre-scrollable mt-5">
<table id="example" class="display nowrap" cellspacing="0" width="100%" >
<thead>
  <tr>
    <th>comp_id</th>					
    <th>bom_type</th>
    <th>material_req_id</th>
    <th>fsize_w</th>
    <th>fsize_l</th>
    <th>qty_part</th>
    <th>cost</th>
    <th>marge</th>
    <th>total_cost</th>
    <th>detail</th>
    <th>material_req_id</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>comp_id</th>					
    <th>bom_type</th>
    <th>material_req_id</th>
    <th>fsize_w</th>
    <th>fsize_l</th>
    <th>qty_part</th>
    <th>cost</th>
    <th>marge</th>
    <th>total_cost</th>
    <th>detail</th>
    <th>material_req_id</th>
  </tr>
</tfoot>
<tbody>
<?php while($row = mysqli_fetch_row($aksesoris_query) ):?>
  <tr>
    <td>Accessories</td>
    <td>Accessories</td>
    <td><?=$row[0];?></td>
    <td><?=$row[3];?></td>
    <td><?=$row[4];?></td>
    <td><?=$row[5];?></td>
    <td><?=$row[12];?></td>
    <td><?=$row[14];?></td>
    <td><?=$row[5]*$row[12];?></td>
    <td><?=$row[10];?></td>
    <td><?=$row[0];?></td>
  </tr>
<?php endwhile;?>
<?php while($row = mysqli_fetch_row($packing_query) ):?>
    <tr>
    <td>Packing</td>
    <td>Packing</td>
    <td><?=$row[16];?></td>
    <td><?=$row[4];?></td>
    <td><?=$row[5];?></td>
    <td><?=$row[7];?></td>
    <td><?=$row[11];?></td>
    <td><?=$row[13];?></td>
    <td>
        <?php if($row[4]>0){
            echo $row[4]*$row[5]*$row[7]*$row[11];
        } else{
            echo $row[7]*$row[11];
        } ?>    
    </td>
    <td><?=$row[9];?></td>
    <td><?=$row[0];?></td>
    </tr>
<?php endwhile;?>
<?php while($row = mysqli_fetch_row($cloth_query) ):?>
  <tr>
    <td>Cloth</td>
    <td>Cloth</td>
    <td><?=$row[0];?></td>
    <td><?=$row[1];?></td>
    <td><?=$row[2];?></td>
    <td><?=$row[3];?></td>
    <td><?=$row[4];?></td>
    <td><?=$row[5];?></td>
    <td><?=$row[3]*$row[4];?></td>
    <td><?=$row[6];?></td>
    <td><?=$row[0];?></td>
  </tr>
<?php endwhile;?>
<?php while($row = mysqli_fetch_row($finishing_query) ):?>
  <tr>
    <td>Finishing</td>
    <td>Finishing</td>
    <td><?=$row[6];?></td>
    <td><?=0;?></td>
    <td><?=0;?></td>
    <td><?=$row[3];?></td>
    <td><?=$row[9];?></td>
    <td><?=0;?></td>
    <td><?=$row[3]*$row[9];?></td>
    <td><?=$row[5];?></td>
    <td><?=$row[0];?></td>
  </tr>
<?php endwhile;?>
</tbody>

</table>

</div>
<a href="index.php"><button class="btn btn-primary">Kembali</button></a>
</div>
</div>
</div>





<script type ="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type ="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type ="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script type ="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type ="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script type ="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>

<script type="text/javascript">
   $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [ 
          'copy',
          'csv',
          'excel'
        ]
      } );
</script>



<script type ="text/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type ="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>