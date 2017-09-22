<?php
if(isset($_POST["submit"])){
    $kode   = mysql_real_escape_string(strip_tags($_POST["kode"]));
    $na     = mysql_real_escape_string(strip_tags($_POST["nama"]));
    $em     = mysql_real_escape_string(strip_tags($_POST["email"]));
    $us     = mysql_real_escape_string(strip_tags($_POST["username"]));
    $ps     = mysql_real_escape_string(strip_tags(MD5($_POST["password"])));
    $lv     = mysql_real_escape_string(strip_tags($_POST["level"]));

    $file_name = $_FILES["file"]["name"];
    $file_tmp_name = $_FILES["file"]["tmp_name"];
    $date  = date("Y-m-d h:i:s");

    if($ps == "" || $file_name == "" || $file_name == null || empty($file_name)){

        mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','$date','berita','ubah')");
        mysql_query("UPDATE tabel_users
        set nama_lengkap='$na', username = '$us', password='$ps', level = '$lv', email = '$em'
        WHERE kode_user = '$kode' ");
    }else{
        //menghapus gambar
        $sqlagt = mysql_query("SELECT * FROM tabel_users WHERE kode_user = '$kode'") or die (mysql_error());
        $rowH = mysql_fetch_array($sqlagt);
        $Path = "images/foto/";

        unlink($Path.$rowH["images"]);

        //mengupload
        move_uploaded_file($file_tmp_name,"images/foto/".$file_name);

        $a = "abcdefghijklmnopqrstuvwxyz";
        $b = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $c = "1234567890";
        $d = $a."".$b."".$c;
        $id = substr((str_shuffle($d)), 0, 20).".jpg";

        rename($Path.$file_name,$Path.$id);
        $rnm = $id;
        mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','$date','users','ubah')");
        mysql_query("UPDATE tabel_users set nama_lengkap='$na', username = '$us', password='$ps', level = '$lv', email = '$em',
        images='$rnm' WHERE kode_user = '$kode' ");
    }
     header("location:?users&suksesedit");
    }
$idA = (int)mysql_real_escape_string(trim($_GET["update-users"]));
$sqlA = mysql_query("SELECT * FROM tabel_users WHERE kode_user = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?users");
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
                        <h2>Tambah Users</h2>
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
                Form Tambah users Bank
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form  name="form1" role="form" action="" method="post">
                        <input class="form-control" name="kode" type="hidden" value="<?php echo $rowA["kode_user"] ?>"  />
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="noang" name="noang" type="text" placeholder="masukkan data no anggotas" />
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Lengkap</label></div>
                                    <div class="col-md-5">
                                        <input value="<?php echo $rowA["nama_lengkap"] ?>" class="form-control" name="nama"  placeholder="masukkan nama lengkap" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom nama"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Email</label></div>
                                    <div class="col-md-5">
                                        <input value="<?php echo $rowA["email"] ?>" class="form-control" id="email" name="email" type="text" placeholder="masukkan data email" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom email"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Username</label></div>
                                    <div class="col-md-5">
                                        <input value="<?php echo $rowA["username"] ?>" class="form-control" name="username"  placeholder="masukkan username" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom username"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Password</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" id="pass" name="Password" type="password" /> <input id="pass2" type="checkbox" /> Lihat password
                                    </div>
                                </div>
                            </div>
                           <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Upload Foto</label></div>
                                    <div class="col-md-3">
                                        <img src="<?php echo $rowA["images"] == "" ? "images/foto/no-images.png" : "images/foto/".$rowA["images"] ?>" width="88" class="img-responsive img-rounded" />
                                        <input type="file" name="file" id="input01" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Level</label></div>
                                    <div class="col-md-3">
                                        <select name="level" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom level">
                                            <option value="">-- Level --</option>
                                            <option <?php if($rowA["level"]=="Sa"){?> selected="" <?php }?> value="Sa">Super admin</option>
                                            <option <?php if($rowA["level"]=="Us"){?> selected="" <?php }?> value="Us">Users</option>
                                            <option <?php if($rowA["level"]=="Spv"){?> selected="" <?php }?> value="Su">Supervisor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                        <a href="?users" class="btn btn-large btn-warning">Kembali</a>
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
 //Place this plugin snippet into another file in your applicationb
(function ($) {
    $.toggleShowPassword = function (options) {
        var settings = $.extend({
            field: "#password",
            control: "#toggle_show_password",
        }, options);

        var control = $(settings.control);
        var field = $(settings.field)

        control.bind('click', function () {
            if (control.is(':checked')) {
                field.attr('type', 'text');
            } else {
                field.attr('type', 'password');
            }
        })
    };
}(jQuery));

//Here how to call above plugin from everywhere in your application document body
$.toggleShowPassword({
    field: '#pass',
    control: '#pass2'
});
</script>
