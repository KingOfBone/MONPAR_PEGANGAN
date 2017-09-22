<?php
if(isset($_POST["submit"])){
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
    $kode   = mysql_real_escape_string(strip_tags($_POST["kodebushing"]));

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

    mysql_query("UPDATE bushing SET serialid='$a',tipeid='$b',kodegi='$c',kodestatus='$d',tegoprs='$e',phasa='$f',penempatan='$g',tgloprs='$h',kodemerk='$i',kodebuatan='$j',thnbuat='$k',keterangan='$l',kodetrafo='$m',flag='$n',tipe='$o',housing='$p',jenis='$q',pasangan='$r',outerterm='$s',tegmaks='$t',arusmaks='$u',bil='$v',sil='$w',pfw='$x',tandelta='$y',ctspace='$z',jrkflgbtmend='$aa',dmtrflg='$ab',dmtrholetohole='$ac',jmlbaut='$ad',dmtrbaut='$ae',creepdist='$af',kapc1='$ag',kapc2='$ah',kemiringan='$ai',sparkgap='$aj',taptest='$ak',berat='$al',standart='$am',techidentoold='$an',objecttype='$ao',constype='$ap',techidento='$aq',eqnumber='$ar',equipmentnumber='$as',idfunctloc='$at',image='$newfilerks' WHERE kodebushing='$kode'");

    header("location:?bushing&suksesedit");

}
$idA = (int)mysql_real_escape_string(trim($_GET["update-bushing"]));
$sqlA = mysql_query("SELECT * FROM bushing WHERE kodebushing = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?bushing");
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

<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Ubah Bushing</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <!-- content -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Form Ubah Bushing
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"> <label>Kode Bushing</label></div>
                                            <div class="col-md-7">
                                                <input type="text" disabled="" class="form-control" value="<?php echo $rowA["kodebushing"]; ?>" />
                                                <input type="hidden" name="kodebushing" class="form-control" value="<?php echo $rowA["kodebushing"]; ?>" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Serial ID</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="serialid" type="text" value="<?php echo $rowA["serialid"] ?>"  autofocus="" data-rule-required="true" data-msg-required="Mohon masukkan Serial ID."   placeholder="masukkan Serial ID" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Tipe ID</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="tipeid" type="text" value="<?php echo $rowA["tipeid"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Serial ID."   placeholder="masukkan Serial ID" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"> <label>Nomor Gardu Induk</label></div>
                                            <div class="col-md-7">
                                                <?php $sql = mysql_query("SELECT * FROM gi") or die (mysql_error()); ?>
                                                  <select name="gi" id="gi" class="form-control">
                                                        <option value="">- Pilih -</option>
                                                        <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                          <option value="<?php echo $data["kodegi"]; ?>" <?php if($rowA["kodegi"]==$data["kodegi"]){ ?> selected="selected" <?php } ?>><?php echo $data["nomorgi"]; ?></option>
                                                         <?php } ?>
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"><label>Kode Status</label></div>
                                                <div class="col-md-7">
                                                    <input class="form-control" name="kodestatus" type="text" value="<?php echo $rowA["kodestatus"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan Kode Status." placeholder="masukkan Kode Status" />
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Teg Oprs</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="tegoprs" type="text" value="<?php echo $rowA["tegoprs"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan Teg Oprs." placeholder="masukkan Teg Oprs" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Phasa</label></div>
                                            <div class="col-md-7">
                                                    <select class="form-control" name="phasa" data-rule-required="true" data-msg-required="Mohon masukkan Phasa.">
                                                        <option value="">- Pilih -</option>
                                                        <option value="R" <?php if($rowA["phasa"]=="R"){ ?> selected="selected" <?php } ?>>R</option>
                                                        <option value="T" <?php if($rowA["phasa"]=="T"){ ?> selected="selected" <?php } ?>>T</option>
                                                        <option value="N" <?php if($rowA["phasa"]=="N"){ ?> selected="selected" <?php } ?>>N</option>
                                                        <option value="S" <?php if($rowA["phasa"]=="S"){ ?> selected="selected" <?php } ?>>S</option>
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
                                                        <option value="Primer"  <?php if($rowA["penempatan"]=="Primer"){ ?> selected="selected" <?php } ?>>Primer</option>
                                                        <option value="Sekunder" <?php if($rowA["penempatan"]=="Sekunder"){ ?> selected="selected" <?php } ?>>Sekunder</option>
                                                        <option value="Tersier" <?php if($rowA["penempatan"]=="Tersier"){ ?> selected="selected" <?php } ?>>Tersier</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Tgl Oprs</label></div>
                                            <div class="col-md-7">
                                                <input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="tgloprs" value="<?php if($rowA["tgloprs"]=="0000-00-00"){}else{ echo format_tgl($rowA["tgloprs"]); } ?>" data-rule-required="false" data-rule-date="false" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"> <label>Merk</label></div>
                                            <div class="col-md-7">
                                                <?php $sql = mysql_query("SELECT * FROM merk") or die (mysql_error()); ?>
                                                <select name="merk" id="merk" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                    <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                    <option value="<?php echo $data["kodemerk"]; ?>" <?php if($rowA["kodemerk"]==$data["kodemerk"]){ ?> selected="selected" <?php } ?>><?php echo $data["merk"]; ?></option>
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
                                                <select name="buatan" id="buatan" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                    <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                    <option value="<?php echo $data["kodebuatan"]; ?>" <?php if($rowA["kodebuatan"]==$data["kodebuatan"]){ ?> selected="selected" <?php } ?>><?php echo $data["buatan"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Tahun Buat</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="thnbuat" type="text" value="<?php echo $rowA["thnbuat"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tahun Buat."   placeholder="masukkan Tahun Buat" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Keterangan</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="keterangan" type="text" value="<?php echo $rowA["keterangan"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Keterangan."   placeholder="masukkan Keterangan" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"> <label>Serial ID Trafo</label></div>
                                            <div class="col-md-7">
                                                <?php $sql = mysql_query("SELECT * FROM trafo") or die (mysql_error()); ?>
                                                <select name="trafo" id="trafo" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                    <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                    <option value="<?php echo $data["kodetrafo"]; ?>" <?php if($rowA["kodetrafo"]==$data["kodetrafo"]){ ?> selected="selected" <?php } ?>><?php echo $data["serialid"]; ?></option>
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
                                                        <option value="1" <?php if($rowA["flag"]=="1"){ ?> selected="selected" <?php } ?>>1</option>
                                                        <option value="2" <?php if($rowA["flag"]=="2"){ ?> selected="selected" <?php } ?>>2</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Tipe</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="tipe" type="text" value="<?php echo $rowA["tipe"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tipe."   placeholder="masukkan Tipe" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Housing</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="housing" type="text" value="<?php echo $rowA["housing"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan Housing."   placeholder="masukkan Housing" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Jenis</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="jenis" type="text" value="<?php echo $rowA["jenis"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jenis."   placeholder="masukkan Jenis" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Pasangan</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="pasangan" type="text" value="<?php echo $rowA["pasangan"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Pasangan."   placeholder="masukkan Pasangan" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Outer Term</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="outerterm" type="text" value="<?php echo $rowA["outerterm"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Outer Term."   placeholder="masukkan Outer Term" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Teg Maks</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="tegmaks" type="text" value="<?php echo $rowA["tegmaks"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Maks."   placeholder="masukkan Teg Maks" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Arus Maks</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="arusmaks" type="text" value="<?php echo $rowA["arusmaks"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Arus Maks."   placeholder="masukkan Arus Maks" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Bil</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="bil" type="text" value="<?php echo $rowA["bil"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Bil."   placeholder="masukkan Bil" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Sil</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="sil" type="text" value="<?php echo $rowA["sil"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Sil."   placeholder="masukkan Sil" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>PFW</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="pfw" type="text" value="<?php echo $rowA["pfw"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan PFW."   placeholder="masukkan PFW" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Tan Delta</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="tandelta" type="text" value="<?php echo $rowA["tandelta"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tan Delta."   placeholder="masukkan Tan Delta" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Ct Space</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="ctspace" type="text" value="<?php echo $rowA["ctspace"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Ct Space."   placeholder="masukkan Ct Space" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Jrk Flg Btmend</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="jrkflgbtmend" type="text" value="<?php echo $rowA["jrkflgbtmend"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jrk Flg Btmend."   placeholder="masukkan Jrk Flg Btmend" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Dmtr Flg</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="dmtrflg" type="text" value="<?php echo $rowA["dmtrflg"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Dmtr Flg."   placeholder="masukkan Dmtr Flg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Dmtr Hole To Hole</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="dmtrholetohole" type="text" value="<?php echo $rowA["dmtrholetohole"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Dmtr Hole To Hole."   placeholder="masukkan Dmtr Hole To Hole" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Jml Baut</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="jmlbaut" type="text" value="<?php echo $rowA["jmlbaut"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jml Baut."   placeholder="masukkan Jml Baut" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Dmtr Baut</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="dmtrbaut" type="text" value="<?php echo $rowA["dmtrbaut"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Dmtr Baut."   placeholder="masukkan Dmtr Baut" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Creep Dist</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="creepdist" type="text" value="<?php echo $rowA["creepdist"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Creep Dist."   placeholder="masukkan Creep Dist" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Kap C1</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="kapc1" type="text" value="<?php echo $rowA["kapc1"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Kap C1."   placeholder="masukkan Kap C1" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Kap C2</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="kapc2" type="text" value="<?php echo $rowA["kapc2"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Kap C2."   placeholder="masukkan Kap C2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Kemiringan</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="kemiringan" type="text" value="<?php echo $rowA["kemiringan"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Kemiringan."   placeholder="masukkan Kemiringan" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Spark Gap</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="sparkgap" type="text" value="<?php echo $rowA["sparkgap"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Spark Gap."   placeholder="masukkan Spark Gap" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Tap Test</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="taptest" type="text" value="<?php echo $rowA["taptest"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tap Test."   placeholder="masukkan Tap Test" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Berat</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="berat" type="text" value="<?php echo $rowA["berat"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Berat."   placeholder="masukkan Berat" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Standard</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="standart" type="text" value="<?php echo $rowA["standart"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Standard."   placeholder="masukkan Standard" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Techidentno Old</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="techidentoold" type="text" value="<?php echo $rowA["techidentoold"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Techidentno Old."   placeholder="masukkan Techidentno Old" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Object Type</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="objecttype" type="text" value="<?php echo $rowA["objecttype"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Object Type."   placeholder="masukkan Object Type" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Cons Type</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="constype" type="text" value="<?php echo $rowA["constype"] ?>"  data-rule-required="true" data-msg-required="Mohon masukkan Cons Type."   placeholder="masukkan Cons Type" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Techidentno</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="techidento" type="text" value="<?php echo $rowA["techidento"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan Techidentno."   placeholder="masukkan Techidentno" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Eq Number</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="eqnumber" type="text" value="<?php echo $rowA["eqnumber"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan Eq Number."   placeholder="masukkan Eq Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>Equipment Number</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="equipmentnumber" type="text" value="<?php echo $rowA["equipmentnumber"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan Equipment Number."   placeholder="masukkan Equipment Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label>ID Functloc</label></div>
                                            <div class="col-md-7">
                                                <input class="form-control" name="idfunctloc" type="text" value="<?php echo $rowA["idfunctloc"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan ID Functloc."   placeholder="masukkan ID Functloc" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"><label></label></div>
                                            <div class="col-md-7">
                                                <img src="<?php echo $rowA["image"] == "" ? "images/foto/no-images.png" : "foto/".$rowA["image"] ?>" width="88" class="img-responsive img-rounded" />
                                                <input type="file" name="fileToUpload" id="fileToUpload"/>
                                                <input type="hidden" name="fileToUpload1" id="fileToUpload1" value="<?php echo $data["image"]; ?>"/>
                                                <label>Size gambar Max. 5MB</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-8">
                                            <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                            <a href="?bushing" class="btn btn-large btn-warning">Kembali</a>
                                        </div>
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
 $('#fileToUpload').change(function(){
      var file = $('#fileToUpload').val();
      var exts = ['jpg','jpeg'];
      if ( file ) {
        var get_ext = file.split('.');
        get_ext = get_ext.reverse();
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
          return true;
        } else {
          alert('Hanya boleh jpg ');
          $('#fileToUpload').filestyle('clear');
        }
      }

    });
    </script>
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
