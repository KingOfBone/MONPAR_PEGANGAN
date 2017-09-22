<?php
if(isset($_POST["submit"])){
    $na     = mysql_real_escape_string(strip_tags($_POST["nama"]));
    $c      = mysql_real_escape_string(strip_tags($_POST["cabang"]));
    $p      = mysql_real_escape_string(strip_tags($_POST["pic"]));
    $no     = mysql_real_escape_string(strip_tags($_POST["notelp"]));
    $a      = mysql_real_escape_string(strip_tags($_POST["alamat"]));
    $k      = mysql_real_escape_string(strip_tags($_POST["kode"]));
    $date  = date("Y-m-d h:i:s");
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','pic bank','tambah')");
     mysql_query("INSERT INTO tabel_pic VALUES ('$k','$na','$c','$p','$no','$a')");
     header("location:?pic&suksestambah"); 
    } ?>
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
                        <h2>Tambah PIC Bank</h2>   
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
                Form Tambah PIC Bank
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="validate-me-plz" name="form1" role="form" action="" method="post">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Kode bank</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" name="kode" onKeyPress="return isNumberKey(event)"  placeholder="masukkan kode bank" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom kode bank"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Bank</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" name="nama"  placeholder="masukkan nama bank" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom nama bank"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Cabang</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="cabang" name="cabang" type="text" placeholder="masukkan data cabang" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom cabang"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>PIC</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="pic"  name="pic" type="text" placeholder="masukkan data PIC" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom PIC"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No telp</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="notelp" name="notelp" type="number" placeholder="masukkan data notelp" onKeyPress="return isNumberKey(event)" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom notelp"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Alamat</label></div>
                                    <div class="col-md-5">
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="masukkan data alamat" ></textarea>
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