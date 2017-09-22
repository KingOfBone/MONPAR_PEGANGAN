<?php
if(isset($_POST["submit"])){
    $na     = mysql_real_escape_string(strip_tags($_POST["nama"]));
    $c      = mysql_real_escape_string(strip_tags($_POST["cabang"]));
    $p      = mysql_real_escape_string(strip_tags($_POST["pic"]));
    $no     = mysql_real_escape_string(strip_tags($_POST["notelp"]));
    $a      = mysql_real_escape_string(strip_tags($_POST["alamat"]));
    $k      = mysql_real_escape_string(strip_tags($_POST["kode"]));
    $date  = date("Y-m-d h:i:s");
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','pic bank','ubah')");
    mysql_query("UPDATE tabel_pic SET nama_bank='$na', cabang='$c', pic='$p', 
            no_telp = '$no', alamat='$a' WHERE kode_bank='$k'");
    header("location:?pic&suksesedit");
    
}
$idA = (int)mysql_real_escape_string(trim($_GET["update-pic"]));
$sqlA = mysql_query("SELECT * FROM tabel_pic WHERE kode_bank = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?pic");
$rowA = mysql_fetch_array($sqlA);  
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
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ubah PIC Bank</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah PIC Bank
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form  name="form1" role="form" action="" method="post">
                        
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Kode bank</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" readonly="" name="kode" value="<?php echo $rowA["kode_bank"] ?>" placeholder="masukkan kode bank" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom kode bank"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Bank</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" name="nama" value="<?php echo $rowA["nama_bank"] ?>"  placeholder="masukkan nama bank" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom nama bank"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Cabang</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="cabang" name="cabang" type="text" value="<?php echo $rowA["cabang"] ?>" placeholder="masukkan data cabang" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom cabang"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>PIC</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="pic" value="<?php echo $rowA["pic"] ?>" name="pic" type="text" placeholder="masukkan data PIC" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom PIC"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No telp</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="notelp" value="<?php echo $rowA["no_telp"] ?>"  name="notelp" type="number" placeholder="masukkan data notelp" onKeyPress="return isNumberKey(event)" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom notelp"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Alamat</label></div>
                                    <div class="col-md-5">
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="masukkan data alamat" ><?php echo $rowA["alamat"] ?></textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                        <a href="?pic" class="btn btn-large btn-warning">Kembali</a>
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
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        },
        alamat: {
                required: true
                }
        },
        messages: {
            alamat: {
            required: "Mohon masukkan data alamat"
                }
            }
      
    });
</script>