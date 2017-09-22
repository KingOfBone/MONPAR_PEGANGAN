<?php
include "config/imgset.php";
include "config/konfigberita.php";

if(isset($_POST["submit"])){
    $kode           = mysql_real_escape_string(strip_tags($_POST["kode"]));
    $j              = mysql_real_escape_string(strip_tags($_POST["judul"]));
    $s              = mysql_real_escape_string(strip_tags($_POST["sinopsis"]));
    $i              = mysql_real_escape_string($_POST["isi"]);
    $w              = date("Y-m-d");
    $date           = date("Y-m-d h:i:s");
    $file_name      = $_FILES["file"]["name"];
    $file_tmp_name  = $_FILES["file"]["tmp_name"];
        
    if($file_name == "" || $file_name == null || empty($file_name)){
        mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','berita','ubah')");
        mysql_query("UPDATE tabel_berita SET judul='$j', sinopsis='$s', isi='$i' WHERE id_berita='$kode'");    
    }else{
        //mengupload
        $sqlagt = mysql_query("SELECT * FROM tabel_berita WHERE id_berita = '$kode'") or die (mysql_error());
        $rowH   = mysql_fetch_array($sqlagt);
        $Path   = "images/berita/";
        unlink($Path.$rowH["gambar"]);
        /*
        move_uploaded_file($file_tmp_name,$Path.$file_name);
        $a = "abcdefghijklmnopqrstuvwxyz";
        $b = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $c = "1234567890";
        $d = $a."".$b."".$c;
        $id = substr((str_shuffle($d)), 0, 20).".jpg";
        rename($Path.$file_name,$Path.$id);
        $rnm = $id;
        */
        $images     = uploadProductImage('file', 'images/berita/');
        $mainImage  = $images['image'];
        mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','berita','ubah')");
        mysql_query("UPDATE tabel_berita SET judul='$j', sinopsis='$s', isi='$i', gambar='$mainImage' WHERE id_berita='$kode'");
    }
    header("location:?berita&suksesedit");
} 
$idA = (int)mysql_real_escape_string(trim($_GET["update-berita"]));
$sqlA = mysql_query("SELECT * FROM tabel_berita WHERE id_berita = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?berita");
$rowA = mysql_fetch_array($sqlA);
?>
 
<script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
<link type="text/css" rel="stylesheet" href="assets/jQuery-TE/jquery-te-1.4.0.css" />
<script type="text/javascript" src="assets/jQuery-TE/jquery-te-1.4.0.min.js" charset="utf-8"></script>
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Tambah berita</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah berita
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!--  id="validate-me-plz"  -->
                        <form name="form1" role="form" action="" method="post" enctype="multipart/form-data">
                        <input class="form-control" name="kode" type="hidden" value="<?php echo $rowA["id_berita"] ?>"  />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Judul</label></div>
                                    <div class="col-md-7">
                                        <input  class="form-control" name="judul"  value="<?php echo $rowA["judul"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan data judul" placeholder="masukkan nama judul berita"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Upload Gambar</label></div>
                                    <div class="col-md-7">
                                        <img style="width: 50%;" src="<?php echo $rowA["gambar"] == "" ? "images/foto/no-images.png" : "images/berita/".$rowA["gambar"] ?>" class="img-responsive" />
                                        <input type="file" name="file" id="input01"  />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Sinopsis</label></div>
                                    <div class="col-md-7">
                                        <input  class="form-control" id="karakter" name="sinopsis" value="<?php echo $rowA["sinopsis"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan data sinopsis" placeholder="masukkan sinopsis berita"/>
                                        <p class="text-right" style="margin: 0; padding: 0;"><span id="hitung" ><?php $a = strlen($rowA["sinopsis"]); $b = 100; echo $c =$b - $a; ?></span> Karakter Tersisa.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Isi Berita</label></div>
                                    <div class="col-md-7">
                                        <textarea style="min-height: 300px;" name="isi" class="form-control jqte-test" placeholder="masukkan isi berita" data-rule-required="true" data-msg-required="Mohon masukkan data berita"><?php echo $rowA["isi"] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                        <a href="?berita" class="btn btn-large btn-warning">Kembali</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row"></div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
        </div>
       </div>
               
    </div>
<!-- pembatas karakter -->
<script type="text/javascript">
$(document).ready(function() {
$('#karakter').keyup(function() {
var len = this.value.length;
if (len >= 100) {
this.value = this.value.substring(0, 100);
}else if(len == 100){
$('#hitung').text(100 - len);
}
$('#hitung').text(100 - len);
});
});
</script>
<!-- datepicker -->
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>

  <script>
  $('.jqte-test').jqte();
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1990, 2020],
        format: 'DD/MM/YYYY'
    });
</script>
<!-- validate -->
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
jQuery.validator.methods["date"] = function (value, element) { return true; }
</script>
