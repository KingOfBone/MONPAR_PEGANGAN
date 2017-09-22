<?php
    if(isset($_POST["submit"]))
    {
        $a     = mysql_real_escape_string(strip_tags($_POST["app"]));
        $b     = mysql_real_escape_string(strip_tags($_POST["gi"]));
        $c     = mysql_real_escape_string(strip_tags($_POST["trafo"]));
        $d     = mysql_real_escape_string(strip_tags($_POST["serialid"]));
        $e     = mysql_real_escape_string(strip_tags($_POST["typeid"]));
        $f     = mysql_real_escape_string(strip_tags($_POST["kodepst"]));
        $g     = mysql_real_escape_string(strip_tags($_POST["kodestatus"]));
        $h     = mysql_real_escape_string(strip_tags($_POST["tegoprs"]));
        $i     = tglformataction($_POST["tgloprs"]);
        $j     = mysql_real_escape_string(strip_tags($_POST["buatan"]));
        $k     = mysql_real_escape_string(strip_tags($_POST["merk"]));
        $l     = mysql_real_escape_string(strip_tags($_POST["thnbuat"]));
        $m     = mysql_real_escape_string(strip_tags($_POST["keterangan"]));
        $n     = mysql_real_escape_string(strip_tags($_POST["tipe"]));
        $o     = mysql_real_escape_string(strip_tags($_POST["techidentoold"]));
        $p     = mysql_real_escape_string(strip_tags($_POST["objecttype"]));
        $q     = mysql_real_escape_string(strip_tags($_POST["constype"]));
        $r     = mysql_real_escape_string(strip_tags($_POST["techidento"]));
        $s     = mysql_real_escape_string(strip_tags($_POST["eqnumber"]));
        $t     = mysql_real_escape_string(strip_tags($_POST["equipmentnumber"]));
        $u     = mysql_real_escape_string(strip_tags($_POST["idfunctloc"]));
        $filerks  = $_FILES["fileToUpload"]["name"];
        $newfilerks     = time() . '_' . rand(100, 999) . '.' . end(explode(".",$filerks));
        $file_tmp_rks = $_FILES["fileToUpload"]["tmp_name"];
        copy($file_tmp_rks,"foto/".$newfilerks);

        mysql_query("INSERT INTO oltc VALUES ('','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$newfilerks')");
        header("location:?oltc&suksestambah");
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

<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tambah OLTC</h2>
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
                            Form Tambah OLTC
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"> <label>Nama APP</label></div>
                                                <div class="col-md-7">
                                                    <?php $sql = mysql_query("SELECT * FROM app") or die (mysql_error()); ?>
                                                    <select name="app" id="app" class="form-control" autofocus="" data-rule-required="true" data-msg-required="Mohon masukkan Nama APP.">
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
                                                <div class="col-md-4"> <label>Nama Gardu Induk</label></div>
                                                <div class="col-md-7">
                                                    <?php $sql = mysql_query("SELECT * FROM gi") or die (mysql_error()); ?>
                                                    <select name="gi" id="gi" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan Nama Gardu Induk.">
                                                        <option value="">- Pilih -</option>
                                                        <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                        <option value="<?php echo $data["kodegi"]; ?>"><?php echo $data["namagi"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"> <label>Trafo</label></div>
                                                <div class="col-md-7">
                                                    <?php $sql = mysql_query("SELECT * FROM trafo") or die (mysql_error()); ?>
                                                    <select name="trafo" id="trafo" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan Trafo.">
                                                        <option value="">- Pilih -</option>
                                                        <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                        <option value="<?php echo $data["kodetrafo"]; ?>"><?php echo $data["serialid"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Serial ID</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="serialid" type="text" data-rule-required="true" data-msg-required="Mohon masukkan Serial ID." placeholder="masukkan   Serial ID" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Tipe ID</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="typeid" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Tipe ID."   placeholder="masukkan Tipe ID" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Kode PST</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="kodepst" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Kode PST."   placeholder="masukkan Kode PST" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Kode Status</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="kodestatus" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Kode Status."   placeholder="masukkan Kode Status" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Teg Oprs</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="tegoprs" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Oprs."   placeholder="masukkan Teg Oprs" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Tgl Oprs</label></div>
                                                <div class="col-md-7">
                                                    <input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="tgloprs" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"> <label>Buatan</label></div>
                                                <div class="col-md-7">
                                                    <?php $sql = mysql_query("SELECT * FROM buatan") or die (mysql_error()); ?>
                                                    <select name="buatan" id="buatan" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan Buatan.">
                                                        <option value="">- Pilih -</option>
                                                        <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                        <option value="<?php echo $data["kodebuatan"]; ?>"><?php echo $data["buatan"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"> <label>Merk</label></div>
                                                <div class="col-md-7">
                                                    <?php $sql = mysql_query("SELECT * FROM merk") or die (mysql_error()); ?>
                                                    <select name="merk" id="merk" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan Merk.">
                                                        <option value="">- Pilih -</option>
                                                        <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                        <option value="<?php echo $data["kodemerk"]; ?>"><?php echo $data["merk"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Tahun Buat</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="thnbuat" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Tahun Buat."   placeholder="masukkan Tahun Buat" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Keterangan</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="keterangan" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Keterangan."   placeholder="masukkan Keterangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Tipe</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="tipe" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Tipe."   placeholder="masukkan Tipe" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Techidentno Old</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="techidentoold" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Techidentno Old."   placeholder="masukkan Techidentno Old" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Object Type</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="objecttype" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Object Type."   placeholder="masukkan Object Type" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Constype</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="constype" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Constype."   placeholder="masukkan Constype" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Techidentno</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="techidento" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Techidentno."   placeholder="masukkan Techidentno" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Eq Number</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="eqnumber" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Eq Number."   placeholder="masukkan Eq Number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Equipment Number</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="equipmentnumber" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Equipment Number."   placeholder="masukkan Equipment Number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>ID Functloc</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="idfunctloc" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan ID Functloc."   placeholder="masukkan ID Functloc" />
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
                                            <div class="col-md-6"></div>
                                            <div class="col-md-5">
                                                <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                                <a href="?oltc" class="btn btn-large btn-warning">Kembali</a>
                                            </div>
                                            <div class="col-md-1"></div>
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

<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
</script>
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
