<?php
if(isset($_POST["submit"])){
    $kode     = mysql_real_escape_string(strip_tags($_POST["kode"]));
    $unitus   = mysql_real_escape_string(strip_tags($_POST["unitusaha"]));
    $tahun    = mysql_real_escape_string(strip_tags($_POST["tahun"]));
    $pngjwb   = mysql_real_escape_string(strip_tags($_POST["pngjwb"]));
    $omset    = mysql_real_escape_string(strip_tags($_POST["omset"]));
    $modal    = mysql_real_escape_string(strip_tags($_POST["modal"]));
    $date  = date("Y-m-d h:i:s");
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','unit usaha','ubah')");
     mysql_query("UPDATE tabel_unitusaha SET unitusaha='$unitus', tahun='$tahun', pngng_jwb='$pngjwb', 
            modal = '$modal', omset='$omset' WHERE id_unitusaha='$kode'");
     header("location:index.php?unitusaha&suksesedit");
}
$idA = (int)mysql_real_escape_string(trim($_GET["update-unitusaha"]));
$sqlA = mysql_query("SELECT * FROM tabel_unitusaha WHERE id_unitusaha = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:index.php?unitusaha");
$rowA = mysql_fetch_array($sqlA); 
?>
<script src="librari/currency.js"></script>
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Tambah unit usaha</h2>   
                    </div>
                </div>
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah unit usaha
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form  name="form1" role="form" action="" method="post">
                        <input class="form-control" name="kode" type="hidden" value="<?php echo $rowA["id_unitusaha"] ?>"  />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Unit usaha</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" name="unitusaha" value="<?php echo $rowA["unitusaha"] ?>"  placeholder="masukkan unit usaha " data-rule-required="true" data-msg-required="Mohon masukkan data di kolom unit usaha"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Tahun</label></div>
                                    <div class="col-md-5">
                                        <select class="form-control" name="tahun" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom unit usaha">
                                            <option value="">-- tahun --</option>
                                            <?php 
                                             $angka = 2000;
                                             $tahun=substr(date("Y-m-d"),0,4);
                                              while ($angka <= $tahun){ ?>
                                                <option <?php if($rowA["tahun"]==$angka){?> selected="" <?php }?> value="<?php echo $angka; ?>">
                                                    <?php echo $angka; ?>
                                                </option>  
                                             <?php 
                                              $angka++; 
                                              } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Penanggung Jawab</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="pngjwb" value="<?php echo $rowA["pngng_jwb"];?>" name="pngjwb" type="text" placeholder="masukkan data penanggung jawab" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Modal</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="modal" onkeyup="reformatText(this)" value="<?php echo $rowA["modal"];?>" name="modal" type="text" placeholder="masukkan data omset" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Omset</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="omset" onkeyup="reformatText(this)" value="<?php echo $rowA["omset"];?>" name="omset" type="text" placeholder="masukkan data omset" />
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                        <a href="index.php?unitusaha" class="btn btn-large btn-warning">Kembali</a>
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
<script type="text/javascript">$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
</script>