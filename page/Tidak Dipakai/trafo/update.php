<?php
if(isset($_POST["submit"])){
    $a      = mysql_real_escape_string(strip_tags($_POST["gi"]));
    $b      = mysql_real_escape_string(strip_tags($_POST["namabay"]));
    $c      = mysql_real_escape_string(strip_tags($_POST["serialid"]));
    $d      = mysql_real_escape_string(strip_tags($_POST["typeid"]));
    $e      = mysql_real_escape_string(strip_tags($_POST["idbay"]));
    $f      = mysql_real_escape_string(strip_tags($_POST["kodepst"]));
    $g      = mysql_real_escape_string(strip_tags($_POST["kodestatus"]));
    $h      = mysql_real_escape_string(strip_tags($_POST["tegoprs"]));
    $i      = tglformataction($_POST["tgloprs"]);
    $j      = mysql_real_escape_string(strip_tags($_POST["impdns"]));
    $k      = mysql_real_escape_string(strip_tags($_POST["merk"]));
    $l      = mysql_real_escape_string(strip_tags($_POST["thnbuat"]));
    $m      = mysql_real_escape_string(strip_tags($_POST["jenis"]));
    $n      = mysql_real_escape_string(strip_tags($_POST["penempatan"]));
    $o      = mysql_real_escape_string(strip_tags($_POST["keterangan"]));
    $p      = mysql_real_escape_string(strip_tags($_POST["flag"]));
    $q      = mysql_real_escape_string(strip_tags($_POST["jeniskonsv"]));
    $r      = tglformataction($_POST["tglhistory"]);
    $s      = mysql_real_escape_string(strip_tags($_POST["tmsaktif"]));
    $t      = mysql_real_escape_string(strip_tags($_POST["tegoperasi"]));
    $u      = mysql_real_escape_string(strip_tags($_POST["idfireprotection"]));
    $v      = mysql_real_escape_string(strip_tags($_POST["idproteksimekanik"]));
    $w      = mysql_real_escape_string(strip_tags($_POST["idonlinemonitoring"]));
    $x      = mysql_real_escape_string(strip_tags($_POST["constype"]));
    $y      = mysql_real_escape_string(strip_tags($_POST["description"]));
    $z      = mysql_real_escape_string(strip_tags($_POST["asset"]));
    $aa     = mysql_real_escape_string(strip_tags($_POST["techidentno"]));
    $ab     = mysql_real_escape_string(strip_tags($_POST["eqnumber"]));
    $ac     = mysql_real_escape_string(strip_tags($_POST["daya"]));
    $ad     = mysql_real_escape_string(strip_tags($_POST["vectorx"]));
    $ae     = mysql_real_escape_string(strip_tags($_POST["equipmentnumber"]));
    $af     = mysql_real_escape_string(strip_tags($_POST["idfunctloc"]));
    $ag     = mysql_real_escape_string(strip_tags($_POST["tipe"]));
    $ah     = mysql_real_escape_string(strip_tags($_POST["tegprimrated"]));
    $ai     = mysql_real_escape_string(strip_tags($_POST["tegsecrated"]));
    $aj     = mysql_real_escape_string(strip_tags($_POST["tegprimmax"]));
    $ak     = mysql_real_escape_string(strip_tags($_POST["tegsecmax"]));
    $al     = mysql_real_escape_string(strip_tags($_POST["tegtermax"]));
    $am     = mysql_real_escape_string(strip_tags($_POST["arusprim"]));
    $an     = mysql_real_escape_string(strip_tags($_POST["arussec"]));
    $ao     = mysql_real_escape_string(strip_tags($_POST["aruster"]));
    $ap     = mysql_real_escape_string(strip_tags($_POST["vector"]));
    $aq     = mysql_real_escape_string(strip_tags($_POST["bil"]));
    $ar     = mysql_real_escape_string(strip_tags($_POST["sil"]));
    $as     = mysql_real_escape_string(strip_tags($_POST["pfwv"]));
    $at     = mysql_real_escape_string(strip_tags($_POST["suhu"]));
    $au     = mysql_real_escape_string(strip_tags($_POST["suhunaikw"]));
    $av     = mysql_real_escape_string(strip_tags($_POST["suhunaiko"]));
    $aw     = mysql_real_escape_string(strip_tags($_POST["cooling"]));
    $ax     = mysql_real_escape_string(strip_tags($_POST["jmlkips"]));
    $ay     = mysql_real_escape_string(strip_tags($_POST["jnsisokertas"]));
    $az     = mysql_real_escape_string(strip_tags($_POST["klsiso"]));
    $ba     = mysql_real_escape_string(strip_tags($_POST["panjang"]));
    $bb     = mysql_real_escape_string(strip_tags($_POST["lebar"]));
    $bc     = mysql_real_escape_string(strip_tags($_POST["tinggi"]));
    $bd     = mysql_real_escape_string(strip_tags($_POST["brtminyak"]));
    $be     = mysql_real_escape_string(strip_tags($_POST["brtintibltn"]));
    $bf     = mysql_real_escape_string(strip_tags($_POST["brttot"]));
    $bg     = mysql_real_escape_string(strip_tags($_POST["jnsminyak"]));
    $bh     = mysql_real_escape_string(strip_tags($_POST["jrkroda"]));
    $bi     = mysql_real_escape_string(strip_tags($_POST["jrkas"]));
    $bj     = mysql_real_escape_string(strip_tags($_POST["standard"]));
    $bk     = mysql_real_escape_string(strip_tags($_POST["pasangan"]));
    $bl     = mysql_real_escape_string(strip_tags($_POST["bilsec"]));
    $bm     = mysql_real_escape_string(strip_tags($_POST["bilter"]));
    $bn     = mysql_real_escape_string(strip_tags($_POST["pfwsec"]));
    $bo     = mysql_real_escape_string(strip_tags($_POST["pfwter"]));
    $bp     = mysql_real_escape_string(strip_tags($_POST["brtmainfitting"]));
    $bq     = mysql_real_escape_string(strip_tags($_POST["dayater"]));
    $br     = mysql_real_escape_string(strip_tags($_POST["deltategtap"]));
    $bs     = mysql_real_escape_string(strip_tags($_POST["jmlcoolingpump"]));
    $bt     = mysql_real_escape_string(strip_tags($_POST["jmlgroupkipas"]));
    $bu     = mysql_real_escape_string(strip_tags($_POST["jmltap"]));
    $bv     = mysql_real_escape_string(strip_tags($_POST["tegtapbawah"]));
    $bw     = mysql_real_escape_string(strip_tags($_POST["tegtapatas"]));
    $bx     = mysql_real_escape_string(strip_tags($_POST["tegtapnormal"]));
    $by     = mysql_real_escape_string(strip_tags($_POST["tipeminyak"]));
    $bz     = mysql_real_escape_string(strip_tags($_POST["waktusc"]));
    $ca     = mysql_real_escape_string(strip_tags($_POST["app"]));
    $cb     = mysql_real_escape_string(strip_tags($_POST["phasa"]));
    $cc     = mysql_real_escape_string(strip_tags($_POST["buatan"]));
    $kode   = mysql_real_escape_string(strip_tags($_POST["kodetrafo"]));

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

     mysql_query("UPDATE trafo SET kodeapp='$ca',kodegi='$a',namabay='$b',serialid='$c',typeid='$d',idbay='$e',kodepst='$f',kodestatus='$g',tegoprs='$h',tgloprs='$i',impdns='$j',phasa='$cb',kodemerk='$k',thnbuat='$l',buatan='$cc',jenis='$m',penempatan='$n',keterangan='$o',flag='$p',jeniskonsv='$q',tglhistory='$r',tmsaktif='$s',tegoprs='$t',idfireprotection='$u',idproteksimekanik='$v',idonlinemonitoring='$w',constype='$x',description='$y',asset='$z',techidentno='$aa',eqnumber='$ab',daya='$ac',vectorx='$ad',equipmentnumber='$ae',idfunctloc='$af',tipe='$ag',tegprimrated='$ah',tegsecrated='$ai',tegprimmax='$aj',tegsecmax='$ak',tegtermax='$al',arusprim='$am',arussec='$an',aruster='$ao',vector='$ap',bil='$aq',sil='$ar',pfwv='$as',suhu='$at',suhunaikw='$au',suhunaiko='$av',cooling='$aw',jmlkips='$ax',jnsisokertas='$ay',klsiso='$az',panjang='$ba',lebar='$bb',tinggi='$bc',brtminyak='$bd',brtintibltn='$be',brttot='$bf',jnsminyak='$bg',jrkroda='$bh',jrkas='$bi',standard='$bj',pasangan='$bk',bilsec='$bl',bilter='$bm',pfwsec='$bn',pfwter='$bo',brtmainfitting='$bp',dayater='$bq',deltategtap='$br',jmlcoolingpump='$bs',jmlgroupkipas='$bt',jmltap='$bu',tegtapbawah='$bv',tegtapatas='$bw',tegtapnormal='$bx',tipeminyak='$by',waktusc='$bz',image='$newfilerks' WHERE kodetrafo='$kode'");
    header("location:?trafo&suksesedit");

}
$idA = (int)mysql_real_escape_string(trim($_GET["update-trafo"]));
$sqlA = mysql_query("SELECT * FROM trafo WHERE kodetrafo = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?trafo");
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
                        <h2>Ubah Trafo</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah Trafo
            </div>
            <div class="panel-body">
                <div class="row">
                    <form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"> <label>Kode Trafo</label></div>
                                <div class="col-md-7">
                                    <input type="text" disabled="" class="form-control" value="<?php echo $rowA["kodetrafo"]; ?>" />
                                    <input type="hidden" name="kodetrafo" class="form-control" value="<?php echo $rowA["kodetrafo"]; ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"> <label>Nama APP</label></div>
                                <div class="col-md-7">
                                    <?php $sql = mysql_query("SELECT * FROM app") or die (mysql_error()); ?>
                                      <select name="app" id="app" class="form-control" autofocus="">
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
                                <div class="col-md-4"> <label>Gardu Induk</label></div>
                                <div class="col-md-7">
                                    <?php $sql = mysql_query("SELECT * FROM gi") or die (mysql_error()); ?>
                                      <select name="gi" id="gi" class="form-control" autofocus="">
                                            <option value="">- Pilih -</option>
                                            <?php while ($data = mysql_fetch_array($sql)) { ?>
                                              <option value="<?php echo $data["kodegi"]; ?>" <?php if($rowA["kodegi"]==$data["kodegi"]){ ?> selected="selected" <?php } ?>><?php echo $data["namagi"]; ?></option>
                                             <?php } ?>
                                      </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Nama Bay</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="namabay" type="text" value="<?php echo $rowA["namabay"] ?>" data-rule-required="true" data-msg-required="Mohon masukkan Nama Bay." placeholder="masukkan Nama Bay" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Serial ID</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="serialid" type="text" value="<?php echo $rowA["serialid"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Serial ID."   placeholder="masukkan Serial ID" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tipe ID</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="typeid" type="text" value="<?php echo $rowA["typeid"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tipe ID."   placeholder="masukkan Tipe ID" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>ID Bay</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="idbay" type="text" value="<?php echo $rowA["idbay"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan ID Bay."   placeholder="masukkan Serial ID" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Kode PST</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="kodepst" type="text" value="<?php echo $rowA["kodepst"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Kode PST."   placeholder="masukkan Kode PST" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Kode Status</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="kodestatus" type="text" value="<?php echo $rowA["kodestatus"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Kode Status."   placeholder="masukkan Kode Status" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Teg Oprs</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="tegoprs" type="text" value="<?php echo $rowA["tegoprs"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Oprs."   placeholder="masukkan Teg Oprs" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tgl Oprs</label></div>
                                    <div class="col-md-7">
                                        <input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="tgloprs" value="<?php if($rowA["tgloprs"]=="0000-00-00"){}else{ echo format_tgl($rowA["tgloprs"]); } ?>" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>IMPDNS</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="impdns" type="text" value="<?php echo $rowA["impdns"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan IMPDNS."   placeholder="masukkan IMPDNS" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Phasa</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="phasa" type="text" value="<?php echo $rowA["phasa"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan phasa."   placeholder="masukkan phasa" />
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
                                    <div class="col-md-4"><label>Tahun Buat</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="thnbuat" type="text" value="<?php echo $rowA["thnbuat"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tahun Buat."   placeholder="masukkan Tahun Buat" />
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
                                    <div class="col-md-4"><label>Jenis</label></div>
                                    <div class="col-md-7">
                                            <select class="form-control" name="jenis" data-rule-required="true" data-msg-required="Mohon masukkan Jenis.">
                                                <option value="">- Pilih -</option>
                                                <option value="distribusi" <?php if($rowA["jenis"]=="distribusi"){ ?> selected="selected" <?php } ?>>Distribusi</option>
                                                <option value="ibt" <?php if($rowA["jenis"]=="ibt"){ ?> selected="selected" <?php } ?>>IBT</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Penempatan</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="penempatan" type="text" value="<?php echo $rowA["penempatan"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Penempatan."   placeholder="masukkan Penempatan" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Keterangan</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="keterangan" type="text" value="<?php echo $rowA["keterangan"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Keterangan."   placeholder="masukkan Keterangan" />
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
                                    <div class="col-md-4"><label>Jenis Konsv</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="jeniskonsv" type="text" value="<?php echo $rowA["jeniskonsv"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jenis Konsv."   placeholder="masukkan Jenis Konsv" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Tgl History</label></div>
                                    <div class="col-md-7">
                                        <input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker2" name="tglhistory" value="<?php if($rowA["tglhistory"]=="0000-00-00"){}else{ echo format_tgl($rowA["tglhistory"]); } ?>" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl History." placeholder="masukkan Tgl History" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>TMS Aktif</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="tmsaktif" type="text" value="<?php echo $rowA["tmsaktif"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan TMS Aktif."   placeholder="masukkan TMS Aktif" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Teg Operasi</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="tegoperasi" type="text" value="<?php echo $rowA["tegoperasi"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Operasi."   placeholder="masukkan Teg Operasi" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>ID Fire Protection</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="idfireprotection" type="text" value="<?php echo $rowA["idfireprotection"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan ID Fire Protection."   placeholder="masukkan ID Fire Protection" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>ID Proteksi Mekanik</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="idproteksimekanik" type="text" value="<?php echo $rowA["idproteksimekanik"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan ID Proteksi Mekanik."   placeholder="masukkan ID Proteksi Mekanik" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>ID Online Monitoring</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="idonlinemonitoring" type="text" value="<?php echo $rowA["idonlinemonitoring"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan ID Online Monitoring."   placeholder="masukkan ID Online Monitoring" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Constype</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="constype" type="text" value="<?php echo $rowA["constype"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Constype."   placeholder="masukkan Constype" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Description</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="description" type="text" value="<?php echo $rowA["description"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Description."   placeholder="masukkan Description" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Asset</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="asset" type="text" value="<?php echo $rowA["asset"]?>" data-rule-required="true" data-msg-required="Mohon masukkan Asset."   placeholder="masukkan Asset" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Techidentno</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="techidentno" type="text" value="<?php echo $rowA["techidentno"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Techidentno."   placeholder="masukkan Techidentno" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"><label>Eq Number</label></div>
                                    <div class="col-md-7">
                                        <input class="form-control" name="eqnumber" type="text" value="<?php echo $rowA["eqnumber"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Eq Number."   placeholder="masukkan Eq Number" />
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Daya</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="daya" type="text" value="<?php echo $rowA["daya"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Daya."   placeholder="masukkan Daya" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Vectorx</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="vectorx" type="text" value="<?php echo $rowA["vectorx"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Vectorx."   placeholder="masukkan Vectorx" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Equipment Number</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="equipmentnumber" type="text" value="<?php echo $rowA["equipmentnumber"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Equipment Number."   placeholder="masukkan Equipment Number" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>ID Functloc</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="idfunctloc" type="text" value="<?php echo $rowA["idfunctloc"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan ID Functloc."   placeholder="masukkan ID Functloc" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Tipe</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tipe" type="text" value="<?php echo $rowA["tipe"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tipe."   placeholder="masukkan Tipe" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Prim Rated</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegprimrated" type="text" value="<?php echo $rowA["tegprimrated"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Prim Rated."   placeholder="masukkan Teg Prim Rated" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Sec Rated</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegsecrated" type="text" value="<?php echo $rowA["tegsecrated"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Sec Rated."   placeholder="masukkan Teg Sec Rated" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Prim Max</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegprimmax" type="text" value="<?php echo $rowA["tegprimmax"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Prim Max."   placeholder="masukkan Teg Prim Max" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Sec Max</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegsecmax" type="text" value="<?php echo $rowA["tegsecmax"]?>" data-rule-required="true" data-msg-required="Mohon masukkan Teg Sec Max."   placeholder="masukkan Teg Sec Max" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Ter Max</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegtermax" type="text" value="<?php echo $rowA["tegtermax"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Ter Max."   placeholder="masukkan Teg Ter Max" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Arus Prim</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="arusprim" type="text" value="<?php echo $rowA["arusprim"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Arus Prim."   placeholder="masukkan Arus Prim" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Arus Sec</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="arussec" type="text" value="<?php echo $rowA["arussec"]?>" data-rule-required="true" data-msg-required="Mohon masukkan Arus Sec."   placeholder="masukkan Arus Sec" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Arus Ter</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="aruster" type="text" value="<?php echo $rowA["aruster"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Arus Ter."   placeholder="masukkan Arus Ter" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Vector</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="vector" type="text" value="<?php echo $rowA["vector"]?> " data-rule-required="true" data-msg-required="Mohon masukkan Vector."   placeholder="masukkan Vector" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Bil</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="bil" type="text" value="<?php echo $rowA["bil"]?> " data-rule-required="true" data-msg-required="Mohon masukkan Bil."   placeholder="masukkan Bil" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Sil</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="sil" type="text" value="<?php echo $rowA["sil"]?>" data-rule-required="true" data-msg-required="Mohon masukkan Sil."   placeholder="masukkan Sil" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>PFWV</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="pfwv" type="text" value="<?php echo $rowA["pfwv"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan PFWV."   placeholder="masukkan PFWV" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Suhu</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="suhu" type="text" value="<?php echo $rowA["suhu"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Suhu."   placeholder="masukkan Suhu" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Suhu Naik W</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="suhunaikw" type="text" value="<?php echo $rowA["suhunaikw"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Suhu Naik W."   placeholder="masukkan Suhu Naik W" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Suhu Naik O</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="suhunaiko" type="text" value="<?php echo $rowA["suhunaiko"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Suhu Naik O."   placeholder="masukkan Suhu Naik O" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Cooling</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="cooling" type="text" value="<?php echo $rowA["cooling"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Cooling."   placeholder="masukkan Cooling" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jml Kips</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jmlkips" type="text" value="<?php echo $rowA["jmlkips"]?>" data-rule-required="true" data-msg-required="Mohon masukkan Jml Kips."   placeholder="masukkan Jml Kips" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jns Iso Kertas</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jnsisokertas" type="text" value="<?php echo $rowA["jnsisokertas"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jns Iso Kertas."   placeholder="masukkan Jns Iso Kertas" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Kls Iso</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="klsiso" type="text" value="<?php echo $rowA["klsiso"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Kls Iso."   placeholder="masukkan Kls Iso" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Panjang</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="panjang" type="text" value="<?php echo $rowA["panjang"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Panjang."   placeholder="masukkan Panjang" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Lebar</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="lebar" type="text" value="<?php echo $rowA["lebar"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Lebar."   placeholder="masukkan Lebar" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Tinggi</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tinggi" type="text" value="<?php echo $rowA["tinggi"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tinggi."   placeholder="masukkan Tinggi" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Brt Minyak</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="brtminyak" type="text" value="<?php echo $rowA["brtminyak"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Brt Minyak."   placeholder="masukkan Brt Minyak" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Brt Inti Bltn</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="brtintibltn" type="text" value="<?php echo $rowA["brtintibltn"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Brt Inti Bltn."   placeholder="masukkan Brt Inti Bltn" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Brt Tot</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="brttot" type="text" value="<?php echo $rowA["brttot"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Brt Tot."   placeholder="masukkan Brt Tot" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jenis Minyak</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jnsminyak" type="text" value="<?php echo $rowA["jnsminyak"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jenis Minyak."   placeholder="masukkan Jenis Minyak" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jarak Roda</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jrkroda" type="text" value="<?php echo $rowA["jrkroda"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jarak Roda."   placeholder="masukkan Jarak Roda" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jarak As</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jrkas" type="text" value="<?php echo $rowA["jrkas"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jarak As."   placeholder="masukkan Jarak As" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Standard</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="standard" type="text" value="<?php echo $rowA["standard"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Standard."   placeholder="masukkan Standard" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Pasangan</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="pasangan" type="text" value="<?php echo $rowA["pasangan"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Pasangan."   placeholder="masukkan Pasangan" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Bil Sec</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="bilsec" type="text" value="<?php echo $rowA["bilsec"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Bil Sec."   placeholder="masukkan Bil Sec" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Bil Ter</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="bilter" type="text" value="<?php echo $rowA["bilter"]?>" data-rule-required="true" data-msg-required="Mohon masukkan Bil Ter."   placeholder="masukkan Bil Ter" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>PFW Sec</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="pfwsec" type="text" value="<?php echo $rowA["pfwsec"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan PFW Sec."   placeholder="masukkan PFW Sec" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>PFW Ter</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="pfwter" type="text" value="<?php echo $rowA["pfwter"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan PFW Ter."   placeholder="masukkan PFW Ter" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Brt Main Fitting</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="brtmainfitting" type="text" value="<?php echo $rowA["brtmainfitting"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Brt Main Fitting."   placeholder="masukkan Brt Main Fitting" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Daya Ter</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="dayater" type="text" value="<?php echo $rowA["dayater"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Daya Ter."   placeholder="masukkan Daya Ter" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Delta Teg Tap</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="deltategtap" type="text" value="<?php echo $rowA["deltategtap"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Delta Teg Tap."   placeholder="masukkan Delta Teg Tap" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jml Cooling Pump</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jmlcoolingpump" type="text" value="<?php echo $rowA["jmlcoolingpump"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jml Cooling Pump."   placeholder="masukkan Jml Cooling Pump" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jml Group Kipas</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jmlgroupkipas" type="text" value="<?php echo $rowA["jmlgroupkipas"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jml Group Kipas."   placeholder="masukkan Jml Group Kipas" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Jml Tap</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="jmltap" type="text" value="<?php echo $rowA["jmltap"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Jml Tap."   placeholder="masukkan Jml Tap" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Tap Bawah</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegtapbawah" type="text" value="<?php echo $rowA["tegtapbawah"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Tap Bawah."   placeholder="masukkan Teg Tap Bawah" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Tap Atas</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegtapatas" type="text" value="<?php echo $rowA["tegtapatas"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Tap Atas."   placeholder="masukkan Teg Tap Atas" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Teg Tap Normal</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tegtapnormal" type="text" value="<?php echo $rowA["tegtapnormal"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Teg Tap Normal."   placeholder="masukkan Teg Tap Normal" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Tipe Minyak</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="tipeminyak" type="text" value="<?php echo $rowA["tipeminyak"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Tipe Minyak."   placeholder="masukkan Tipe Minyak" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label>Waktu SC</label></div>
                                <div class="col-md-7">
                                    <input class="form-control" name="waktusc" type="text" value="<?php echo $rowA["waktusc"]?>"  data-rule-required="true" data-msg-required="Mohon masukkan Waktu SC."   placeholder="masukkan Waktu SC" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label></label></div>
                                <div class="col-md-7">
                                    <img src="<?php echo $rowA["image"] == "" ? "images/foto/no-images.png" : "foto/".$rowA["image"] ?>" width="88" class="img-responsive img-rounded" />
                                    <input type="file" name="fileToUpload" id="fileToUpload"/>
                                    <input type="hidden" name="fileToUpload1" id="fileToUpload1"/>
                                    <label>Size gambar Max. 5MB</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-5">
                                <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                <a href="?trafo" class="btn btn-large btn-warning">Kembali</a>
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
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker2'),
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
