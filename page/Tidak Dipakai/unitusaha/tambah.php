<?php
if(isset($_POST["submit"])){
    $unitus   = mysql_real_escape_string(strip_tags($_POST["unitusaha"]));
    $tahun    = mysql_real_escape_string(strip_tags($_POST["tahun"]));
    $pngjwb   = mysql_real_escape_string(strip_tags($_POST["pngjwb"]));
    $omset    = mysql_real_escape_string(strip_tags($_POST["omset"]));
    $modal    = mysql_real_escape_string(strip_tags($_POST["modal"]));
    $date  = date("Y-m-d h:i:s");
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','unit usaha','tambah')");
     mysql_query("INSERT INTO tabel_unitusaha VALUES ('','$unitus','$tahun','$pngjwb','$modal','$omset')");
     header("location:index.php?unitusaha&suksestambah"); 
    } ?>
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
                 <!-- /. ROW  -->
                 <hr />
                 <?php if($_SESSION["sessionsim"] == 1){?>
                 <div class="row">
                     <div class="col-md-12">
                        <div class="alert alert-warning">Data Gagal di tambah, saldo tidak cukup...
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                        </div>
                     </div> 
                </div>
                 <?php } ?>
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah unit usaha
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="validate-me-plz" name="form1" role="form" action="" method="post">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Unit usaha</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" name="unitusaha" value="<?php if(isset($_POST["unitusaha"])){ echo $_POST["unitusaha"]; }?>"  placeholder="masukkan unit usaha " data-rule-required="true" data-msg-required="Mohon masukkan data di kolom unit usaha"/>
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
                                            <option value="<?php echo $angka; ?>"><?php echo $angka; ?></option>  
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
                                        <input class="form-control" id="pngjwb" value="<?php echo $_POST["pngjwb"];?>" name="pngjwb" type="text" placeholder="masukkan data penanggung jawab" data-rule-required="true" data-msg-required="Mohon masukkan data penanggung jawab"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Modal</label></div>
                                   
                                    <div class="col-md-5">
                                        <div class="input-group">
                                          <div class="input-group-addon">Rp</div>
                                          <input id="nominalA" onkeyup="reformatText(this)" class="form-control" onKeyPress="return isNumberKey(event)" type="text" data-rule-required="true" data-msg-required="Mohon masukkan modal."  />
                                          <input class="textboxH" type="hidden" id="nominalB" onkeyup="kali()" name="modal"  />
                                          <div class="input-group-addon">.00</div>
                                          <span id="errmsg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Omset</label></div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                          <div class="input-group-addon">Rp</div>
                                          <input id="nominalC" onkeyup="reformatText(this)" class="form-control" onKeyPress="return isNumberKey(event)" type="text" data-rule-required="true" data-msg-required="Mohon masukkan omset."  />
                                          <input class="textboxH" type="hidden" id="nominalD" onkeyup="kali()" name="omset"  />
                                          <div class="input-group-addon">.00</div>
                                          <span id="errmsg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Keuntungan</label></div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                          <div class="input-group-addon">Rp</div>
                                          <input id="untung" onkeydown="reformatText(this)"  class="form-control"  type="text" readonly=""/>
                                          <div class="input-group-addon">.00</div>
                                          <span id="errmsg"></span>
                                        </div>
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
<script type="text/javascript">
$('#nominalA').keyup(function () {
         $('#nominalB').val($(this).val());
        var $th = $('#nominalB').val($(this).val());
        $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) { return ''; }));
     });
$('#nominalC').keyup(function () {
         $('#nominalD').val($(this).val());
        var $th = $('#nominalD').val($(this).val());
        $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) { return ''; }));
       
        var textone;
        var texttwo;
        textone = parseFloat($('#nominalB').val());
        texttwo = parseFloat($('#nominalD').val());
        var result = textone - texttwo;
        $('#untung').val(result.toFixed());
        
     });

$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
</script>