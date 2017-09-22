<?php
include "config/imgset.php";
include "config/konfigurasi.php";

if(isset($_POST["submit"])){
    $noAng          = mysql_real_escape_string(strip_tags($_POST["noAng"]));
    $nip            = mysql_real_escape_string(strip_tags($_POST["nip"]));
    $nmAng          = mysql_real_escape_string(strip_tags($_POST["nmAng"]));
    $jenkel         = mysql_real_escape_string(strip_tags($_POST["jenkel"]));
    $tgllhr         = tglformataction($_POST["tgllhr"]);
    $tmplhr         = mysql_real_escape_string(strip_tags($_POST["tmplhr"]));
    $no_telp        = mysql_real_escape_string(strip_tags($_POST["no_telp"]));
    $alamat         = mysql_real_escape_string(strip_tags($_POST["alamat"]));
    $email          = mysql_real_escape_string(strip_tags($_POST["email"]));
    $div            = mysql_real_escape_string(strip_tags($_POST["div"]));
    $gol            = mysql_real_escape_string(strip_tags($_POST["gol"]));
    $tgldft         = tglformataction($_POST["tgldft"]);
    $norek          = mysql_real_escape_string(strip_tags($_POST["norek"]));
    $nmbank         = mysql_real_escape_string(strip_tags($_POST["nmbank"]));
    $setor          = mysql_real_escape_string(strip_tags($_POST["setor"]));
    
    //mengupload
    /*
    $file_name      = $_FILES["file"]["name"];
    $file_tmp_name  = $_FILES["file"]["tmp_name"];
    $Path           = "images/foto/";
    
    move_uploaded_file($file_tmp_name,$Path.$file_name);
   	  
    $a = "abcdefghijklmnopqrstuvwxyz";
    $b = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $c = "1234567890";
    $d = $a."".$b."".$c;
    $id = substr((str_shuffle($d)), 0, 20).".jpg";
     
    rename($Path.$file_name,$Path.$id);
    $rnm = $id;
    */
    //upload images    
    $images = uploadProductImage('file', 'images/foto/');
    $mainImage = $images['image'];
        
    $date  = date("Y-m-d h:i:s");
    $enc = md5($nip);
    
    mysql_query("INSERT INTO tabel_anggota VALUES 
        ('','$noAng','$nip','$nmAng','$mainImage','$jenkel','Pegawai','$email','$no_telp','$alamat','$div','$tgllhr','$tmplhr','$tgldft','$gol','$norek','$nmbank','$setor','aktif')");
    
    mysql_query("INSERT INTO tabel_users VALUES ('','$nmAng','$nip','$enc','$mainImage','Us','$noAng','$email')");
    
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','$nmAng','$date','anggota','tambah')");
    header("location:?anggota&suksestambah");
}
//membuat kode otomatis
$sql_kd = mysql_query("SELECT MAX(no_anggota) as kode FROM tabel_anggota") or die (mysql_error());
$row_kd =mysql_fetch_array($sql_kd);
$kode = substr($row_kd["kode"],4,4);
$tambah = $kode+1;
$tglkode = date("my");
    if($tambah<10){ $id = $tglkode."000".$tambah; }
    else{ $id = $tglkode."00".$tambah; }
    
// $sqlProv = mysql_query("SELECT * FROM master_provinsi ORDER BY provinsi_nama ASC") or die (mysql_error());
// $sqlDiv = mysql_query("SELECT * FROM master_divisi ORDER BY id_divisi ASC") or die (mysql_error());
?>
 <script type="text/javascript">
    function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
    //     if (charCode > 31 && (charCode < 47 || charCode > 57))
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
                        <h2>Tambah anggota</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah anggota
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form"  action="" method="post" id="validasi" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"> <label>Kode Anggota</label></div>
                                    <div class="col-md-7">
                                        <input type="text" disabled="" class="form-control" value="<?php echo $id; ?>" />
                                        <input type="hidden" name="noAng" class="form-control" value="<?php echo $id; ?>" />  
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nip</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="nip" type="text"  autofocus="" data-rule-required="true" data-msg-required="Mohon masukkan data NIP." placeholder="masukkan Nip" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nama Anggota</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="nmAng" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan data nama anggota."   placeholder="masukkan nama anggota" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Jenis Kelamin</label></div>
                                    <div class="col-md-7">
                                            <select class="form-control" name="jenkel" data-rule-required="true" data-msg-required="Mohon masukkan data jenis kelamin.">
                                                <option value="">- Pilih -</option>
                                                <option value="pria" >Pria</option>
                                                <option value="wanita">Wanita</option>
                                            </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tempat Lahir</label></div>
                                    <div class="col-md-7">
                                        <input type="text" name="tmplhr" class="form-control" data-rule-required="true"  data-msg-required="Mohon masukkan data tempat lahir." placeholder="isikan tempat lahir" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tanggal Lahir</label></div>
                                    <div class="col-md-7">
                                        <input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="tgllhr" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data tanggal." placeholder="klik tanggal lahir" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Upload Foto</label></div>
                                    <div class="col-md-7">
                                        <input type="file" name="file" id="input01" data-rule-required="true" data-msg-required="Mohon masukkan data foto." />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Alamat</label></div>
                                    <div class="col-md-7">
                                       <textarea class="form-control" name="alamat" data-rule-required="true" data-msg-required="Mohon masukkan data Alamat." placeholder="masukkan alamat anggota"></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>No Telp / Handphone</label></div>
                                    <div class="col-md-7">
                                       <input class="form-control" name="no_telp" type="number" onKeyPress="return isNumberKey(event)"  data-rule-required="true" data-msg-required="Mohon masukkan data no telp." data-rule-number="true" data-msg-number="hanya nomor saja"  placeholder="masukkan no telp" />
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Email</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="email" type="email" data-rule-required="true" data-msg-required="Mohon masukkan data email." data-rule-email="true" data-msg-email="masukkan email dengan benar" placeholder="masukkan email" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Divisi</label></div>
                                    <div class="col-md-7">
                                        <input type="text"  class="form-control" name="div" data-rule-required="true" data-msg-required="Mohon masukkan data divisi." placeholder="ketik nama divisi" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tanggal Daftar</label></div>
                                    <div class="col-md-7">
                                        <input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker2" name="tgldft" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="ketik kolom tanggal" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nomor Rekening</label></div>
                                    <div class="col-md-7">
                                       <input class="form-control"  name="norek" onKeyPress="return isNumberKey(event)"  type="number" data-rule-required="true" data-msg-required="Mohon masukkan data nomor rek." data-rule-number="true" data-msg-number="hanya nomor saja" placeholder="masukkan no rek" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nama Bank</label></div>
                                    <div class="col-md-7">
                                       <input class="form-control"  name="nmbank" type="text" data-rule-required="true" data-msg-required="Mohon masukkan data nama Bank." placeholder="masukkan nama bank" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Simpanan Wajib</label></div>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                          <div class="input-group-addon">Rp</div>
                                          <input id="nominalA"  onkeyup="reformatText(this)" class="form-control" onKeyPress="return isNumberKey(event)" type="text" data-rule-required="true" data-msg-required="Mohon masukkan nominal setoran wajib." value="<?php echo number_format( "50000", 0 , '' , ',' )?>" />
                                          <input class="textboxH" type="hidden" id="nominalB" onkeyup="kali()" name="jmlPin" name="setor"  value="50000" />
                                          <div class="input-group-addon">.00</div>
                                          <span id="errmsg"></span>
                                        </div>
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
<!--datepicker pikaday-->
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
      var exts = ['jpg','jpeg'];
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
          alert('Hanya boleh jpg ');
          $('#input01').filestyle('clear');
        }
      }
      
    });
    
$('#validasi').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
jQuery.validator.methods["date"] = function (value, element) { return true; } 
</script>
