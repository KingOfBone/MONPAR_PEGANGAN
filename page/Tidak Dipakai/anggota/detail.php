<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];
$sqldetail  = mysql_query("SELECT * FROM tabel_anggota WHERE kode_anggota = '$detail'") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sqldetail);
?>
<div class="row">
    
    <div class="col-md-3">
        <img src="<?php echo $rowDetail["foto"] == "" ? "images/foto/no-images.png" : "images/foto/".$rowDetail["foto"] ?>" width="88" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo $rowDetail["nama_anggota"]; ?></p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-5"><label>No Anggota </label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["no_anggota"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Nip</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["nip"]; ?></div>
      </div>
      <div class="row">
        
        <div class="col-md-5"><label>Jenis Kelamin</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jen_kelamin"]; ?></div>
      </div>
       <div class="row">
        
        <div class="col-md-5"><label>Tanggal Lahir</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php if($rowDetail["tgl_lhr"]=="0000-00-00"){ }else{  echo tglindonesia($rowDetail["tgl_lhr"]); } ?></div>
      </div>
      <div class="row">
        
        <div class="col-md-5"><label>Tempat Lahir</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tmp_lhr"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Alamat</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["alamat"]; ?></div>
      </div>
      <div class="row">
        
        <div class="col-md-5"><label>Email</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["email"]; ?></div>
      </div>
      <div class="row">
        
        <div class="col-md-5"><label>No Telp</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["no_telp"]; ?></div>
      </div>
      
      <div class="row">
        <div class="col-md-5"><label>Divisi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["divisi"]; ?></div>
      </div>
      <div class="row">
        
        <div class="col-md-5"><label>Tanggal Daftar</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php if($rowDetail["tgl_lhr"]=="0000-00-00"){ }else{  echo tglindonesia($rowDetail["tgl_daftar"]); } ?></div>
      </div>
      <div class="row">
        
        <div class="col-md-5"><label>No rek</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["no_rek"]; ?></div>
      </div>
      <div class="row">
        
        <div class="col-md-5"><label>Nama Bank</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["nama_bank"]; ?></div>
      </div>
    </div>
    
</div>
      
