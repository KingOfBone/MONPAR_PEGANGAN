<?php
    if(isset($_POST["submit"]))
    {
        $n      = mysql_real_escape_string(strip_tags($_POST["namagi"]));
        $p      = mysql_real_escape_string(strip_tags($_POST["posisi"]));
        $a      = mysql_real_escape_string(strip_tags($_POST["app"]));
        $no     = mysql_real_escape_string(strip_tags($_POST["nomorgi"]));
        $filerks  = $_FILES["fileToUpload"]["name"];
        $newfilerks     = time() . '_' . rand(100, 999) . '.' . end(explode(".",$filerks));
        $file_tmp_rks = $_FILES["fileToUpload"]["tmp_name"];
        copy($file_tmp_rks,"foto/".$newfilerks);

        mysql_query("INSERT INTO gi VALUES ('','$n','$p','$a','$no','$newfilerks')");

        header("location:?gi&suksestambah");
    }
?>

<script type="text/javascript">
    function isNumberKeyTgl(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
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
                    <h2>Tambah Gardu Induk</h2>
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
                            Form Tambah Gardu Induk
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="validasi" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3"><label>Nama Gardu Induk</label></div>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="namagi"  name="namagi" type="text" placeholder="masukkan data nama gardu induk" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom nama gardu induk"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3"><label>Posisi</label></div>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="posisi"  name="posisi" type="text" placeholder="masukkan data posisi" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom posisi"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3"><label>Nama APP</label></div>
                                                <div class="col-md-5">
                                                    <?php $sql = mysql_query("SELECT * FROM app") or die (mysql_error()); ?>
                                                    <select name="app" id="app" class="form-control" data-rule-required="true" data-msg-required="Mohon pilih data di kolom Nama App">
                                                        <option value="">- Pilih -</option>
                                                        <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                        <option value="<?php echo $data["kodeapp"]; ?>"><?php echo $data["namaapp"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3"><label>Nomor Gardu Induk</label></div>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="nomorgi"  name="nomorgi" type="text" placeholder="masukkan data nomor gardu induk" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom nomor gardu induk"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label></label></div>
                                                <div class="col-md-8">
                                                    <input type="file" name="fileToUpload" id="fileToUpload"/>
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
    </div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
<script type="text/javascript">
    $('#fileToUpload').filestyle();
    $('#fileToUpload').change(function(){
        var file = $('#fileToUpload').val();
        var exts = ['jpg','jpeg'];
        if ( file ) {
            var get_ext = file.split('.');
            get_ext = get_ext.reverse();
            if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
                return true;
            }
            else
            {
                alert('Hanya boleh jpg ');
                $('#fileToUpload').filestyle('clear');
            }
        }
    });

    $('#fileToUpload').validate({
        rules: {
            inputimage: {
                required: true,
                accept: "png|jpe?g|gif",
                filesize: 1048576
            }
        },
        messages: {
            inputimage: "File must be JPG, GIF or PNG, less than 1MB"
        }
    });
</script>
