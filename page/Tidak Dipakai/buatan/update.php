<?php
if(isset($_POST["submit"])){
    $b     = mysql_real_escape_string(strip_tags($_POST["buatan"]));
    $k     = mysql_real_escape_string(strip_tags($_POST["kodebuatan"]));
    mysql_query("UPDATE buatan SET buatan='$b' WHERE kodebuatan='$k'");
    header("location:?buatan&suksesedit");

}
$idA = (int)mysql_real_escape_string(trim($_GET["update-buatan"]));
$sqlA = mysql_query("SELECT * FROM buatan WHERE kodebuatan = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?buatan");
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
                        <h2>Ubah Buatan</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Ubah Buatan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form  name="form1" role="form" action="" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Kode Buatan</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" readonly name="kodebuatan" value="<?php echo $rowA["kodebuatan"] ?>" placeholder="masukkan kode buatan" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom kode buatan"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Buatan</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="buatan"  name="buatan" type="text" value=<?php echo $rowA["buatan"] ?> placeholder="masukkan data buatan" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom buatan"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">
                                    <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                    <a href="?buatan" class="btn btn-large btn-warning">Kembali</a>
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
