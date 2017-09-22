<?php
include "config/imgset.php";
include "config/konfigberita.php";

if(isset($_POST["submit"])){
    $j  = mysql_real_escape_string(strip_tags($_POST["judul"]));
    $s  = mysql_real_escape_string(strip_tags($_POST["sinopsis"]));
    $i  = mysql_real_escape_string($_POST["isi"]);
    $w  = date("Y-m-d");
    $date  = date("Y-m-d h:i:s");
    //mengupload
    /*
    $file_name      = $_FILES["file"]["name"];
    $file_tmp_name  = $_FILES["file"]["tmp_name"];
    $Path           = "images/berita/";
     
    move_uploaded_file($file_tmp_name,$Path.$file_name);
    
    $a = "abcdefghijklmnopqrstuvwxyz";
    $b = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $c = "1234567890";
    $d = $a."".$b."".$c;
    $id = substr((str_shuffle($d)), 0, 20).".jpg";
     
    rename($Path.$file_name,$Path.$id);
    $rnm = $id;
    */
    $images = uploadProductImage('file', 'images/berita/');
    $mainImage = $images['image'];
    
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','berita','tambah')");
    mysql_query("INSERT INTO tabel_berita VALUES ('','$_SESSION[nama_lengkap]','$j','$s','$i','$w','$mainImage')");
    
    header("location:?berita&suksestambah");
} 
?>
<script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
<link type="text/css" rel="stylesheet" href="assets/jQuery-TE/jquery-te-1.4.0.css" />
<script type="text/javascript" src="assets/jQuery-TE/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script> -->

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
                        <form name="form1" role="form" id="validate-me-plz" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Judul</label></div>
                                    <div class="col-md-7">
                                        <input  class="form-control" name="judul"  data-rule-required="true" data-msg-required="Mohon masukkan data judul" placeholder="masukkan nama judul berita"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Gambar</label></div>
                                    <div class="col-md-7">
                                        <input type="file" name="file" id="input01" data-rule-required="true" data-msg-required="Mohon masukkan data foto." />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Sinopsis</label></div>
                                    <div class="col-md-7">
                                        <input  class="form-control" id="karakter" name="sinopsis"  data-rule-required="true" data-msg-required="Mohon masukkan data sinopsis" placeholder="masukkan sinopsis berita"/>
                                        <p class="text-right" style="margin: 0; padding: 0;"><span id="hitung" >100</span> Karakter Tersisa.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Isi Berita</label></div>
                                    <div class="col-md-7">
                                        <textarea  style="min-height: 300px;" name="isi" class="form-control jqte-test" placeholder="masukkan isi berita" data-rule-required="true" data-msg-required="Mohon masukkan data berita"></textarea>
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
}
$('#hitung').text(100 - len);
});
});
</script>
<!-- datepicker -->
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>

  <script>
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

<script type="text/javascript">
$('#input01').filestyle();
$('.jqte-test').jqte();
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