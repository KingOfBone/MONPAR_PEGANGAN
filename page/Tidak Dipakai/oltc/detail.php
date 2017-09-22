<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];

$sqldetail  = mysql_query("SELECT
oltc.kodeoltc,
oltc.kodetrafo,
oltc.serialid as serialoltc,
oltc.typeid,
oltc.kodepst,
oltc.kodestatus,
oltc.tegoprs,
oltc.tgloprs,
oltc.kodemerk,
oltc.thnbuat,
oltc.keterangan,
oltc.tipe,
oltc.techidentoold,
oltc.objecttype,
oltc.constype,
oltc.techidento,
oltc.eqnumber,
oltc.equipmentnumber,
oltc.idfunctloc,
oltc.image,
trafo.kodegi,
gi.namagi,
merk.merk,
buatan.buatan,
gi.kodeapp,
app.namaapp,
oltc.kodeapp,
trafo.serialid
FROM
oltc
INNER JOIN merk ON oltc.kodemerk = merk.kodemerk
INNER JOIN trafo ON oltc.kodetrafo = trafo.kodetrafo
INNER JOIN gi ON trafo.kodegi = gi.kodegi
INNER JOIN buatan ON merk.kodebuatan = buatan.kodebuatan
INNER JOIN app ON gi.kodeapp = app.kodeapp

 WHERE oltc.kodeoltc = '$detail'") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sqldetail);


?>
<div class="row">
    
    <div class="col-md-3">
        <img src="<?php echo $rowDetail["image"] == "" ? "images/foto/no-images.png" : "foto/".$rowDetail["image"] ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo $rowDetail["image"]; ?></p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-5"><label>APP</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["namaapp"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Nama Gardu Induk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["namagi"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Trafo</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["serialid"]; ?></div>
      </div>
       <div class="row">
        <div class="col-md-5"><label>Serial ID</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["serialoltc"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tipe ID</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["typeid"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kode Pst</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kodepst"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kode Status</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kodestatus"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Operasi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegoprs"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tanggal Operasi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php if($rowDetail["tgloprs"]=="0000-00-00"){ }else{  echo tglindonesia($rowDetail["tgloprs"]); } ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Buatan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["buatan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Merk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["merk"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tahun Buat</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["thnbuat"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Keterangan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["keterangan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tipe</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tipe"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Techidentno Old</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["techidentoold"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Object Type</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["objecttype"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Cons Type</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["constype"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Techidentno</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["techidento"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Eq Number</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["eqnumber"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Equipment Number</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["equipmentnumber"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>ID functloc</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["idfunctloc"]; ?></div>
      </div>
    </div>
    
</div>
      
