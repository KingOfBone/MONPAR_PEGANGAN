<?php
    if(isset($_POST["submit"]))
    {
        $a      = mysql_real_escape_string(strip_tags($_POST["serialid"]));
        $b      = mysql_real_escape_string(strip_tags($_POST["tipeid"]));
        $c      = mysql_real_escape_string(strip_tags($_POST["gi"]));
        $d      = mysql_real_escape_string(strip_tags($_POST["kodestatus"]));
        $e      = mysql_real_escape_string(strip_tags($_POST["tegoprs"]));
        $f      = mysql_real_escape_string(strip_tags($_POST["phasa"]));
        $g      = mysql_real_escape_string(strip_tags($_POST["penempatan"]));
        $h      = tglformataction($_POST["tgloprs"]);
        $i      = mysql_real_escape_string(strip_tags($_POST["merk"]));
        $j      = mysql_real_escape_string(strip_tags($_POST["buatan"]));
        $k      = mysql_real_escape_string(strip_tags($_POST["thnbuat"]));
        $l      = mysql_real_escape_string(strip_tags($_POST["keterangan"]));
        $m      = mysql_real_escape_string(strip_tags($_POST["trafo"]));
        $n      = mysql_real_escape_string(strip_tags($_POST["flag"]));
        $o      = mysql_real_escape_string(strip_tags($_POST["tipe"]));
        $p      = mysql_real_escape_string(strip_tags($_POST["housing"]));
        $q      = mysql_real_escape_string(strip_tags($_POST["jenis"]));
        $r      = mysql_real_escape_string(strip_tags($_POST["pasangan"]));
        $s      = mysql_real_escape_string(strip_tags($_POST["outerterm"]));
        $t      = mysql_real_escape_string(strip_tags($_POST["tegmaks"]));
        $u      = mysql_real_escape_string(strip_tags($_POST["arusmaks"]));
        $v      = mysql_real_escape_string(strip_tags($_POST["bil"]));
        $w      = mysql_real_escape_string(strip_tags($_POST["sil"]));
        $x      = mysql_real_escape_string(strip_tags($_POST["pfw"]));
        $y      = mysql_real_escape_string(strip_tags($_POST["tandelta"]));
        $z      = mysql_real_escape_string(strip_tags($_POST["ctspace"]));
        $aa     = mysql_real_escape_string(strip_tags($_POST["jrkflgbtmend"]));
        $ab     = mysql_real_escape_string(strip_tags($_POST["dmtrflg"]));
        $ac     = mysql_real_escape_string(strip_tags($_POST["dmtrholetohole"]));
        $ad     = mysql_real_escape_string(strip_tags($_POST["jmlbaut"]));
        $ae     = mysql_real_escape_string(strip_tags($_POST["dmtrbaut"]));
        $af     = mysql_real_escape_string(strip_tags($_POST["creepdist"]));
        $ag     = mysql_real_escape_string(strip_tags($_POST["kapc1"]));
        $ah     = mysql_real_escape_string(strip_tags($_POST["kapc2"]));
        $ai     = mysql_real_escape_string(strip_tags($_POST["kemiringan"]));
        $aj     = mysql_real_escape_string(strip_tags($_POST["sparkgap"]));
        $ak     = mysql_real_escape_string(strip_tags($_POST["taptest"]));
        $al     = mysql_real_escape_string(strip_tags($_POST["berat"]));
        $am     = mysql_real_escape_string(strip_tags($_POST["standart"]));
        $an     = mysql_real_escape_string(strip_tags($_POST["techidentoold"]));
        $ao     = mysql_real_escape_string(strip_tags($_POST["objecttype"]));
        $ap     = mysql_real_escape_string(strip_tags($_POST["constype"]));
        $aq     = mysql_real_escape_string(strip_tags($_POST["techidento"]));
        $ar     = mysql_real_escape_string(strip_tags($_POST["eqnumber"]));
        $as     = mysql_real_escape_string(strip_tags($_POST["equipmentnumber"]));
        $at     = mysql_real_escape_string(strip_tags($_POST["idfunctloc"]));
        $filerks  = $_FILES["fileToUpload"]["name"];
        $newfilerks     = time() . '_' . rand(100, 999) . '.' . end(explode(".",$filerks));
        $file_tmp_rks = $_FILES["fileToUpload"]["tmp_name"];
        copy($file_tmp_rks,"foto/".$newfilerks);

        mysql_query("INSERT INTO bushing VALUES ('','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v','$w','$x','$y','$z','$aa','$ab','$ac','$ad','$ae','$af','$ag','$ah','$ai','$aj','$ak','$al','$am','$an','$ao','$ap','$aq','$ar','$as','$at','$newfilerks')");
        header("location:?bushing&suksestambah");
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

<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tambah Bushing</h2>
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
            <!-- /. content  -->
            <hr />
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Tambah Bushing
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Serial ID</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="serialid" type="text"  autofocus="" data-rule-required="true" data-msg-required="Mohon masukkan Serial ID."   placeholder="masukkan Serial ID" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Tipe ID</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="tipeid" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Serial ID."   placeholder="masukkan Serial ID" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"> <label>Nomor Gardu Induk</label></div>
                                                <div class="col-md-7">
                                                    <?php $sql = mysql_query("SELECT * FROM gi") or die (mysql_error()); ?>
                                                    <select name="gi" id="gi" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan Nomor Gardu Induk.">
                                                        <option value="">- Pilih -</option>
                                                        <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                        <option value="<?php echo $data["kodegi"]; ?>"><?php echo $data["nomorgi"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Kode Status</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="kodestatus" type="text" data-rule-required="true" data-msg-required="Mohon masukkan Kode Status." placeholder="masukkan Kode Status" />
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
                                                <div class="col-md-4"><label>Phasa</label></div>
                                                <div class="col-md-7">
                                                    <select class="form-control" name="phasa" data-rule-required="true" data-msg-required="Mohon masukkan Phasa.">
                                                        <option value="">- Pilih -</option>
                                                        <option value="R">R</option>
                                                        <option value="T">T</option>
                                                        <option value="N">N</option>
                                                        <option value="S">S</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Penempatan</label></div>
                                                <div class="col-md-7">
                                                    <select class="form-control" name="penempatan" data-rule-required="true" data-msg-required="Mohon masukkan Penempatan.">
                                                        <option value="">- Pilih -</option>
                                                        <option value="Primer">Primer</option>
                                                        <option value="Sekunder">Sekunder</option>
                                                        <option value="Tersier">Tersier</option>
                                                    </select>
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
                                                <div class="col-md-4"> <label>Serial ID Trafo</label></div>
                                                <div class="col-md-7">
                                                    <?php $sql = mysql_query("SELECT * FROM trafo") or die (mysql_error()); ?>
                                                    <select name="trafo" id="trafo" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan Serial ID Trafo.">
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
                                                <div class="col-md-4"><label>Flag</label></div>
                                                <div class="col-md-7">
                                                    <select class="form-control" name="flag" data-rule-required="true" data-msg-required="Mohon masukkan Flag.">
                                                        <option value="">- Pilih -</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                    </select>
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
                                                <div class="col-md-4"><label>Housing</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="housing" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Housing."   placeholder="masukkan Housing" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Jenis</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="jenis" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Jenis."   placeholder="masukkan Jenis" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Pasangan</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="pasangan" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Pasangan."   placeholder="masukkan Pasangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Outer Term</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="outerterm" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Outer Term."   placeholder="masukkan Outer Term" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Teg Maks</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="tegmaks" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Maks."   placeholder="masukkan Teg Maks" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Arus Maks</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="arusmaks" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Arus Maks."   placeholder="masukkan Arus Maks" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Bil</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="bil" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Bil."   placeholder="masukkan Bil" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Sil</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="sil" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Sil."   placeholder="masukkan Sil" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>PFW</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="pfw" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan PFW."   placeholder="masukkan PFW" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Tan Delta</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="tandelta" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Tan Delta."   placeholder="masukkan Tan Delta" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Ct Space</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="ctspace" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Ct Space."   placeholder="masukkan Ct Space" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Jrk Flg Btmend</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="jrkflgbtmend" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Jrk Flg Btmend."   placeholder="masukkan Jrk Flg Btmend" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Dmtr Flg</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="dmtrflg" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Dmtr Flg."   placeholder="masukkan Dmtr Flg" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Dmtr Hole To Hole</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="dmtrholetohole" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Dmtr Hole To Hole."   placeholder="masukkan Dmtr Hole To Hole" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Jml Baut</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="jmlbaut" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Jml Baut."   placeholder="masukkan Jml Baut" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Dmtr Baut</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="dmtrbaut" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Dmtr Baut."   placeholder="masukkan Dmtr Baut" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Creep Dist</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="creepdist" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Creep Dist."   placeholder="masukkan Creep Dist" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Kap C1</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="kapc1" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Kap C1."   placeholder="masukkan Kap C1" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Kap C2</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="kapc2" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Kap C2."   placeholder="masukkan Kap C2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Kemiringan</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="kemiringan" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Kemiringan."   placeholder="masukkan Kemiringan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Spark Gap</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="sparkgap" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Spark Gap."   placeholder="masukkan Spark Gap" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Tap Test</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="taptest" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Tap Test."   placeholder="masukkan Tap Test" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Berat</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="berat" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Berat."   placeholder="masukkan Berat" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Standard</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="standart" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Standard."   placeholder="masukkan Standard" />
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
                                                <div class="col-md-4"><label>Cons Type</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="constype" type="text"  data-rule-required="true" data-msg-required="Mohon masukkan Cons Type."   placeholder="masukkan Cons Type" />
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
                                                <a href="?bushing" class="btn btn-large btn-warning">Kembali</a>
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

<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
    $('#fileToUpload').filestyle();
    $('#fileToUpload').change(function()
    {
        var file = $('#fileToUpload').val();
        var exts = ['jpg','jpeg'];
        if ( file )
        {
            var get_ext = file.split('.');
            get_ext = get_ext.reverse();
            if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 )
            {
                return true;
            }
            else
            {
                alert('Hanya boleh jpg ');
                $('#fileToUpload').filestyle('clear');
            }
        }
    });

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
