<?php
$conn = mysqli_connect("localhost", "root", "", "bdd");

//ambil data dari product fini
$result = mysqli_query($conn, "SELECT * FROM produit_fini LIMIT 20");
$kode_query = mysqli_query($conn, "SELECT `produit_fini`.`Ref_prod_fini`, CONCAT(`gamme`.`code_gamme`,'-',`meuble`.`code_meuble`,'-',`couleur`.`Code_couleur`) AS kode FROM `couleur` INNER JOIN `produit_fini` ON `couleur`.`Ref_couleur` = `produit_fini`.`Ref_couleur` INNER JOIN `produit_brut` ON `produit_fini`.`Ref_produit` = `produit_brut`.`Ref_produit` INNER JOIN `meuble` ON `produit_brut`.`Ref_meuble` = `meuble`.`Ref_meuble` INNER JOIN `gamme` ON `meuble`.`Ref_gamme` = `gamme`.`ref_gamme`");
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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BOM PRODUCT</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    
</head>
<body>
<div class="container">
<div class="pre-scrollable mt-5">
<table id="example" class="display nowrap" cellspacing="0" width="100%" >
<thead>
  <tr>
    <th>Ref_prod_fini</th>
    <th>Ref_margeIndex</th>
    <th>Ref_produitIndex</th>
    <th>stockIndex</th>
    <th>photo</th>
    <th>travail_photo</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>Ref_prod_fini</th>
    <th>Ref_margeIndex	</th>
    <th>Ref_produitIndex</th>
    <th>stockIndex</th>
    <th>photo</th>
    <th>travail_photo</th>
  </tr>
</tfoot>
<tbody>
  <?php while($row = mysqli_fetch_row($result) ):?>
  <tr>
    <td><?=$row[0]?></td>
    <td><?=$row[1]?></td>
    <td><?=$row[2]?></td>
    <td><?=$row[3]?></td>
    <td><?=$row[4]?></td>
    <td><?=$row[5]?></td>
  </tr>
  <?php endwhile; ?>
</tbody>

</table>
</div>
</div>
<div class="container my-5">
<div class="card">
<div class="card-header">
FORM BOM PRODUK
  </div>
<div class="card-body">
<form action="detailbom.php" method="post">
<div class="form-group">
    <label for="exampleInputEmail1">Kode Produk</label>
  </div>
  <div class="mb-3">
   <input type="text" id="searchFilter" name="searchFilter" placeholder="Search" onkeyup="filterItems(this);">
  </div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
  </div>
    <select class="custom-select" id="select_kode" name="kode">
        <?php while($kode = mysqli_fetch_row($kode_query) ):?>
          <option value="<?=$kode[0];?>"><?=$kode[0];?> => <?=$kode[1];?></option>
        <?php endwhile;?>
    </select>
    </div>
  <button type="submit" class="btn btn-primary">Tampilkan BOM</button>
</form>
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

//search
<script type="text/javascript">
var optionsCache = [];

function filterItems(el) {
  var value = el.value.toLowerCase();
  var form = el.form;
  var opt, sel = form.select_kode;
  if (value == '') {
    restoreOptions();
  } else {
    // Loop backwards through options as removing them modifies the next
    // to be visited if go forwards
    for (var i=sel.options.length-1; i>=0; i--) {
      opt = sel.options[i];
      if (opt.text.toLowerCase().indexOf(value) == -1){
        sel.removeChild(opt)
      }
    }
  }
}

// Restore select to original state
function restoreOptions(){
  var sel = document.getElementById('select_kode');
  sel.options.length = 0;
  for (var i=0, iLen=optionsCache.length; i<iLen; i++) {
    sel.appendChild(optionsCache[i]);
  }
}


window.onload = function() {
  // Load cache
  var sel = document.getElementById('select_kode');
  for (var i=0, iLen=sel.options.length; i<iLen; i++) {
    optionsCache.push(sel.options[i]);
  }
}
</script>


<script type ="text/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type ="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>


</html>