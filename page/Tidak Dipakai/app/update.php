<?php
if(isset($_POST["submit"])){
    $n     = mysql_real_escape_string(strip_tags($_POST["namaapp"]));
    $a      = mysql_real_escape_string(strip_tags($_POST["alamat"]));
    $k      = mysql_real_escape_string(strip_tags($_POST["kodeapp"]));
    mysql_query("UPDATE app SET namaapp='$n', alamat='$a' WHERE kodeapp='$k'");
    header("location:?app&suksesedit");

}
$idA = (int)mysql_real_escape_string(trim($_GET["update-app"]));
$sqlA = mysql_query("SELECT * FROM app WHERE kodeapp = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?app");
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
                        <h2>Ubah APP/h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah APP
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form  name="form1" role="form" action="" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Kode APP</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" readonly name="kodeapp" value="<?php echo $rowA["kodeapp"] ?>" placeholder="masukkan kode APP" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom kode APP"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>APP</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="namaapp" value="<?php echo $rowA["namaapp"] ?>" name="namaapp" type="text" placeholder="masukkan data APP" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom APP"/>
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
                                        <a href="?app" class="btn btn-large btn-warning">Kembali</a>
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
