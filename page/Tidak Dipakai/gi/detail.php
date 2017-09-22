<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];

$sqldetail  = mysql_query("SELECT gi.kodegi, gi.namagi,gi.posisi,gi.image, app.namaapp, gi.nomorgi FROM gi
INNER JOIN app ON app.kodeapp = gi.kodeapp WHERE gi.kodegi = '$detail'") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sqldetail);


?>
<div class="row">
    
    <div class="col-md-3">
        <img src="<?php echo $rowDetail["image"] == "" ? "images/foto/no-images.png" : "foto/".$rowDetail["image"] ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo $rowDetail["image"]; ?></p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-5"><label>Nama Gardu Induk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["namagi"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Posisi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["posisi"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>APP</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["namaapp"]; ?></div>
      </div>
       <div class="row">
        <div class="col-md-5"><label>Nomor Gardu Induk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["nomorgi"]; ?></div>
      </div>
    </div>
    
</div>
      
