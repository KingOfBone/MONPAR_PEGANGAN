<?php
if(isset($_POST["submit"])){
    $n      = mysql_real_escape_string(strip_tags($_POST["namagi"]));
    $p      = mysql_real_escape_string(strip_tags($_POST["posisi"]));
    $a      = mysql_real_escape_string(strip_tags($_POST["app"]));
    $no     = mysql_real_escape_string(strip_tags($_POST["nomorgi"]));
    $kode   = mysql_real_escape_string(strip_tags($_POST["kodegi"]));


    $filerks  = $_FILES["fileToUpload"]["name"];
    $filerks1 = $_POST["fileToUpload1"];

    if($filerks == "" || $filerks == null || empty($filerks)){
        $newfilerks = $filerks1;
    }else{
        unlink("foto/".$filerks1);
        $filerks  = $_FILES["fileToUpload"]["name"];
        $newfilerks     = time() . '_' . rand(100, 999) . '.' . end(explode(".",$filerks));
        $file_tmp_rks = $_FILES["fileToUpload"]["tmp_name"];
        copy($file_tmp_rks,"foto/".$newfilerks);

    }

    mysql_query("UPDATE gi SET namagi='$n', posisi='$p', kodeapp='$a', image='$newfilerks' WHERE kodegi='$kode'");
    header("location:?gi&suksesedit");

}
$idA = (int)mysql_real_escape_string(trim($_GET["update-gi"]));
$sqlA = mysql_query("SELECT * FROM gi WHERE kodegi = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?gi");
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
    <script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ubah Gardu Induk</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Ubah Gardu Induk
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"> <label>Kode Gardu Induk</label></div>
                                        <div class="col-md-5">
                                            <input type="text" disabled="" class="form-control" value="<?php echo $rowA["kodegi"]; ?>" />
                                            <input type="hidden" name="kodegi" class="form-control" value="<?php echo $rowA["kodegi"]; ?>" />

                                        </div>
                                    </div>
                                </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Gardu Induk</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="namagi"  name="namagi" type="text" value="<?php echo $rowA["namagi"] ?>" placeholder="masukkan data nama gardu induk" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom nama gardu induk"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Posisi</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="posisi"  name="posisi" type="text" value="<?php echo $rowA["posisi"] ?>" placeholder="masukkan data posisi" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom posisi"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama APP</label></div>
                                    <div class="col-md-5">
                                        <?php $sql = mysql_query("SELECT * FROM app") or die (mysql_error()); ?>
                                          <select name="app" id="app" class="form-control">
                                                <option value="">- Pilih -</option>
                                                <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                  <option value="<?php echo $data["kodeapp"]; ?>" <?php if($rowA["kodeapp"]==$data["kodeapp"]){ ?> selected="selected" <?php } ?>><?php echo $data["namaapp"]; ?></option>
                                                 <?php } ?>
                                          </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nomor Gardu Induk</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="nomorgi"  name="nomorgi" type="text" value="<?php echo $rowA["nomorgi"] ?>" placeholder="masukkan data nomor gardu induk" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom nomor gardu induk"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label></label></div>
                                    <div class="col-md-8">
                                        <img src="<?php echo $rowA["image"] == "" ? "images/foto/no-images.png" : "foto/".$rowA["image"] ?>" width="88" class="img-responsive img-rounded" />
                                        <input type="file" name="fileToUpload" id="fileToUpload"/>
                                        <input type="hidden" name="fileToUpload1" id="fileToUpload1"/>
                                        <label>Size gambar Max. 5MB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">
                                    <button type="submit" name="submit" id="submit" value="submit" class="btn btn-large btn-success">Simpan</button>
                                    <a href="?gi" class="btn btn-large btn-warning">Kembali</a>
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
