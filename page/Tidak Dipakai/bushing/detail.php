<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];

$sqldetail  = mysql_query("SELECT
bushing.kodebushing,
bushing.serialid as serialbushing,
bushing.tipeid,
bushing.kodestatus,
bushing.tegoprs,
bushing.phasa,
bushing.penempatan,
bushing.tgloprs,
bushing.kodemerk,
bushing.kodebuatan,
bushing.thnbuat,
bushing.keterangan,
bushing.kodetrafo,
bushing.flag,
bushing.tipe,
bushing.housing,
bushing.jenis,
bushing.pasangan,
bushing.outerterm,
bushing.tegmaks,
bushing.arusmaks,
bushing.bil,
bushing.sil,
bushing.pfw,
bushing.tandelta,
bushing.ctspace,
bushing.jrkflgbtmend,
bushing.dmtrflg,
bushing.dmtrholetohole,
bushing.jmlbaut,
bushing.dmtrbaut,
bushing.creepdist,
bushing.kapc1,
bushing.kapc2,
bushing.kemiringan,
bushing.sparkgap,
bushing.taptest,
bushing.berat,
bushing.standart,
bushing.techidentoold,
bushing.objecttype,
bushing.constype,
bushing.techidento,
bushing.eqnumber,
bushing.equipmentnumber,
bushing.idfunctloc,
bushing.image,
trafo.kodegi,
gi.namagi,
app.namaapp,
merk.merk,
buatan.buatan,
trafo.serialid,
gi.nomorgi
FROM
bushing
INNER JOIN trafo ON bushing.kodetrafo = trafo.kodetrafo
INNER JOIN gi ON gi.kodegi = trafo.kodegi
INNER JOIN app ON app.kodeapp = gi.kodeapp
INNER JOIN merk ON bushing.kodemerk = merk.kodemerk
INNER JOIN buatan ON buatan.kodebuatan = merk.kodebuatan

 WHERE bushing.kodebushing = '$detail'") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sqldetail);


?>
<div class="row">
    
    <div class="col-md-3">
        <img src="<?php echo $rowDetail["image"] == "" ? "images/foto/no-images.png" : "foto/".$rowDetail["image"] ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo $rowDetail["image"]; ?></p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-5"><label>Serial ID</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["serialbushing"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tipe ID</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tipeid"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Nomor Gardu Induk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["nomorgi"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kode Status</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kodestatus"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tegangan Operasi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegoprs"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Phasa</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["phasa"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Penempatan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["penempatan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tanggal Operasi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php if($rowDetail["tgloprs"]=="0000-00-00"){ }else{  echo tglindonesia($rowDetail["tgloprs"]); } ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Merk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["merk"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Buatan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["buatan"]; ?></div>
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
        <div class="col-md-5"><label>Trafo</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["serialid"]; ?></div>
      </div>
       <div class="row">
        <div class="col-md-5"><label>Flag</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["flag"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tipe</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tipe"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Housing</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["housing"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jenis</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jenis"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Pasangan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["pasangan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Outer Term</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["outerterm"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Maks</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegmaks"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Arus Maks</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["arusmaks"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Bil</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["bil"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Sil</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["sil"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>PFW</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["pfw"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tan Delta</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tandelta"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>CT Space</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["ctspace"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jrk Flg Btmend</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jrkflgbtmend"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Dmtr Flg</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["dmtrflg"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Dmtr Hole To Hole</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["dmtrholetohole"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jml Baut</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jmlbaut"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Dmtr Baut</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["dmtrbaut"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Creep Dist</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["creepdist"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kap C1</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kapc1"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kap C2</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kapc2"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kemiringan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kemiringan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Spark Gap</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["sparkgap"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tap Test</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["taptest"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Berat</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["berat"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Standard</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["standart"]; ?></div>
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
        <div class="col-md-5"><label>EQ Number</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["eqnumber"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Equipment Number</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["equipmentnumber"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>ID Functloc</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["idfunctloc"]; ?></div>
      </div>
    </div>
</div>
