<?php
include "config/imgset.php";
include "config/konfigurasi.php";
if(isset($_POST["submit"])){
    $kode           = mysql_real_escape_string(strip_tags($_POST["kode"]));
    $noAng          = mysql_real_escape_string(strip_tags($_POST["noAng"]));
    $nip            = mysql_real_escape_string(strip_tags($_POST["nip"]));
    $nmAng          = mysql_real_escape_string(strip_tags($_POST["nmAng"]));
    $jenkel         = mysql_real_escape_string(strip_tags($_POST["jenkel"]));
    $tgllhr         = tglformataction($_POST["tgllhr"]);
    $tmplhr         = mysql_real_escape_string(strip_tags($_POST["tmplhr"]));
    $no_telp        = mysql_real_escape_string(strip_tags($_POST["no_telp"]));
    $alamat         = mysql_real_escape_string(strip_tags($_POST["alamat"]));
    $email          = mysql_real_escape_string(strip_tags($_POST["email"]));
    $jenang         = mysql_real_escape_string(strip_tags($_POST["jenAng"]));
    $div            = mysql_real_escape_string(strip_tags($_POST["div"]));
    $gol            = mysql_real_escape_string(strip_tags($_POST["gol"]));
    $tgldft         = tglformataction($_POST["tgldft"]);
    $norek          = mysql_real_escape_string(strip_tags($_POST["norek"]));
    $nmbank         = mysql_real_escape_string(strip_tags($_POST["nmbank"]));
    $setor          = mysql_real_escape_string(strip_tags($_POST["setor"]));
    $date           = date("Y-m-d h:i:s");
    
    $file_name      = $_FILES["file"]["name"];
    $file_tmp_name  = $_FILES["file"]["tmp_name"];
    
    if($file_name == "" || $file_name == null || empty($file_name)){
        mysql_query("UPDATE tabel_anggota
        set no_anggota='$noAng', nip = '$nip', nama_anggota='$nmAng', jen_kelamin='$jenkel', tgl_lhr = '$tgllhr', 
        tmp_lhr = '$tmplhr', no_telp = '$no_telp', alamat = '$alamat', email = '$email', jen_anggota = '$jenang'
        , divisi = '$div', golongan = '$gol', tgl_daftar = '$tgldft', no_rek = '$norek', nama_bank = '$nmbank', setoran_wajib = '$setor'
        WHERE kode_anggota = '$kode' ");
        mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','$nmAng','$date','anggota','ubah')");
        
    }else{
        //menghapus gambar
        $sqlagt = mysql_query("SELECT * FROM tabel_anggota WHERE kode_anggota = '$kode'") or die (mysql_error());
        $rowH   = mysql_fetch_array($sqlagt);
        $Path   = "images/foto/";
        
        unlink($Path.$rowH["foto"]);
        
        //mengupload
        
        $images     = uploadProductImage('file', 'images/foto/');
        $mainImage  = $images['image'];
        
        echo $ded = "UPDATE tabel_anggota
        set no_anggota='$noAng', nip = '$nip', nama_anggota='$nmAng', jen_kelamin='$jenkel', tgl_lhr = '$tgllhr', 
        tmp_lhr = '$tmplhr', no_telp = '$no_telp', alamat = '$alamat', email = '$email', jen_anggota = '$jenang'
        , divisi = '$div', golongan = '$gol', tgl_daftar = '$tgldft', no_rek = '$norek', nama_bank = '$nmbank', setoran_wajib = '$setor'
        , foto = '$mainImage' WHERE kode_anggota = '$kode' ";
        die();
        mysql_query("UPDATE tabel_anggota
        set no_anggota='$noAng', nip = '$nip', nama_anggota='$nmAng', jen_kelamin='$jenkel', tgl_lhr = '$tgllhr', 
        tmp_lhr = '$tmplhr', no_telp = '$no_telp', alamat = '$alamat', email = '$email', jen_anggota = '$jenang'
        , divisi = '$div', golongan = '$gol', tgl_daftar = '$tgldft', no_rek = '$norek', nama_bank = '$nmbank', setoran_wajib = '$setor'
        , foto = '$mainImage' WHERE kode_anggota = '$kode' ");
    
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','$nmAng','$date','anggota','ubah')");
    }
    header("location:?anggota&suksesedit");
}
$idA = (int)mysql_real_escape_string(trim($_GET["update-anggota"]));
$sqlAng = mysql_query("SELECT * FROM tabel_anggota WHERE kode_anggota = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlAng)==0) header("location:?anggota");
$rowA = mysql_fetch_array($sqlAng);

?>
<script type="text/javascript">
    
      function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
     //    if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
      </script>
<script src="librari/currency.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
<!-- Pick Day -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>update anggota</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form update anggota
            </div>
            <div class="panel-body">
                <div class="row">
                <!-- id="validate-me-plz"  -->
                    <form role="form"  action="" method="post" enctype="multipart/form-data">
                    <input class="form-control" name="kode" type="hidden" value="<?php echo $rowA["kode_anggota"] ?>" />
                    <div class="col-lg-6">
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"> <label>Kode Anggota</label></div>
                                    <div class="col-md-7">
                                        <input type="text" disabled="" class="form-control" value="<?php echo $rowA["no_anggota"]; ?>" />
                                        <input type="hidden" name="noAng" class="form-control" value="<?php echo $rowA["no_anggota"]; ?>" />
                                        
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"> <label>Nip</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="nip" type="text"  value="<?php echo $rowA["nip"] ?>"   placeholder="masukkan Nip" data-rule-required="true" data-msg-required="Mohon masukkan data nip."/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nama Anggota</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="nmAng" type="text"  value="<?php echo $rowA["nama_anggota"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan data nama anggota."/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Jenis Kelamin</label></div>
                                    <div class="col-md-7">
                                            <select class="form-control" name="jenkel" data-rule-required="true" data-msg-required="Mohon masukkan data jenis kelamin.">
                                                <option value="">- Pilih -</option>
                                                <option value="pria" <?php if($rowA["jen_kelamin"]=="pria"){ ?> selected="selected" <?php } ?>> Pria</option>
                                                <option value="wanita" <?php if($rowA["jen_kelamin"]=="wanita"){?> selected="selected" <?php } ?> > Wanita</option>
                                            </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tempat Lahir</label></div>
                                    <div class="col-md-7">
                                        <input type="text" placeholder="masukkan tempat lahir" name="tmplhr" class="form-control"  value="<?php echo $rowA["tmp_lhr"]; ?>" data-rule-required="true"  data-msg-required="mohon masukkan data tanggal."/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tanggal Lahir</label></div>
                                    <div class="col-md-7">
                                        <input  type="text" class="form-control" onKeyPress="return isNumberKeyTgl(event)" id="datepicker" name="tgllhr" value="<?php if($rowA["tgl_lhr"]=="0000-00-00"){}else{ echo format_tgl($rowA["tgl_lhr"]); } ?>" placeholder="klik tanggal lahir" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data tanggal."/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>No Telp</label></div>
                                    <div class="col-md-7">
                                       <input class="form-control" name="no_telp" type="number" onKeyPress="return isNumberKey(event)" value="<?php echo $rowA["no_telp"] ?>"   placeholder="masukkan no telp" data-rule-required="true" data-msg-required="Mohon masukkan data no telp." data-rule-number="true" data-msg-number="hanya nomor saja"/>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Email</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="email" type="email" placeholder="masukkan email" value="<?php echo $rowA["email"] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Alamat</label></div>
                                    <div class="col-md-7">
                                       <textarea class="form-control" name="alamat" placeholder="masukkan alamat anggota" ><?php echo $rowA["alamat"]?></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Upload Foto</label></div>
                                    <div class="col-md-7">
                                        <img src="<?php echo $rowA["foto"] == "" ? "images/foto/no-images.png" : "images/foto/".$rowA["foto"] ?>" width="88" class="img-responsive img-rounded" />
                                        <input type="file" name="file" id="input01"  />
                                    </div>
                                </div>
                            </div>
                            
                        
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Divisi</label></div>
                                    <div class="col-md-7">
                                        <input type="text"  class="form-control" name="div" value="<?php echo $rowA["divisi"]; ?>" placeholder="ketik nama divisi" data-rule-required="true" data-msg-required="Mohon masukkan data divisi." />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tanggal Daftar</label></div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" onKeyPress="return isNumberKeyTgl(event)" id="datepicker2" name="tgldft" value="<?php if($rowA["tgl_daftar"]=="0000-00-00"){}else{ echo format_tgl($rowA["tgl_daftar"]); } ?>"  placeholder="ketik kolom tanggal" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nomor Rekening</label></div>
                                    <div class="col-md-7">
                                       <input class="form-control" onKeyPress="return isNumberKey(event)" name="norek" value="<?php echo $rowA["no_rek"]; ?>" type="number" data-rule-required="true" data-msg-required="Mohon masukkan data nomor rek." data-rule-number="true" data-msg-number="hanya nomor saja" placeholder="masukkan no rek" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nama Bank</label></div>
                                    <div class="col-md-7">
                                       <input class="form-control"  name="nmbank" data-rule-required="true" data-msg-required="Mohon masukkan data nama Bank." type="text" value="<?php echo $rowA["nama_bank"]; ?>" placeholder="masukkan nama cabang" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Simpanan Wajib</label></div>
                                    <div class="col-md-7">
                                       
                                    </div>
                                     <div class="col-md-7">
                                        <div class="input-group">
                                          <div class="input-group-addon">Rp</div>
                                          <input id="nominalA"  onkeyup="reformatText(this)" class="form-control" onKeyPress="return isNumberKey(event)" type="text" data-rule-required="true" data-msg-required="Mohon masukkan nominal setoran wajib." value="<?php echo number_format( $rowA["setoran_wajib"], 0 , '' , ',' )?>" />
                                          <input class="textboxH" type="hidden" id="nominalB" onkeyup="kali()" name="jmlPin" name="setor"  value="<?php echo $rowA["setoran_wajib"]; ?>" />
                                          <div class="input-group-addon">.00</div>
                                          <span id="errmsg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Status</label></div>
                                    <div class="col-md-7">
                                       <select name="status" class="form-control">
                                            <option <?php if($rowA["status"]=="aktif"){?> selected="" <?php }?> value="aktif">Aktif</option>
                                            <option <?php if($rowA["status"]=="tidak aktif"){?> selected="" <?php }?> value="tidak aktif">Tidak aktif</option>
                                       </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-5">
                                    <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                    <a href="?anggota" class="btn btn-large btn-warning">Kembali</a>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
       </div>
               
    </div>
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>

$('#nominalA').keyup(function () {
         $('#nominalB').val($(this).val());
        var $th = $('#nominalB').val($(this).val());
        $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) { return ''; }));
     });
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
</script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker2'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
</script>
<!-- validate -->
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#input01').filestyle();

 $('#input01').change(function(){
      var file = $('#input01').val();
      var exts = ['jpg','png','gif'];
      // first check if file field has any value
      if ( file ) {
        // split file name at dot
        var get_ext = file.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
          return true;
        } else {
          alert('Hanya boleh jpeg , png atau gif');
          $('#input01').filestyle('clear');
        }
      }
      
    });
$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
jQuery.validator.methods["date"] = function (value, element) { return true; } 
</script>