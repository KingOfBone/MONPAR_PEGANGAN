<?php
if(isset($_POST["submit"])){
    $file = $_POST['file'];
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES["file"]["type"];
    $RandomAccountNumber = uniqid();
    $namafile = ($RandomAccountNumber.".csv");
    copy($_FILES['file']['tmp_name'],"file/".$namafile); 
    $source = fopen('file/'.$namafile, 'r') or die("Problem open file"); 
    while (($data = fgetcsv($source, 1024, ";",",")) !== FALSE)
    {
        
        $noanggota = $data[0];
        $tgl = $data[1];
        $jumlah = $data[2];
        $jenis_simpan = $data[3];
        $jenis = $data[4];
        $jenis_setor = $data[5];
        
        $insert = mysql_query("insert into tabel_simpanan (no_anggota,tgl_simpanan,jumlah,jenis_simpanan,jenis,jenis_setor) values ('$noanggota','$tgl','$jumlah','$jenis_simpan','$jenis','$jenis_setor')");
     }   
    if ($insert) { ?>
                    <script type="text/javascript">
                    				alert("Tabel Simpanan berhasil ditambah");
                    				window.location.href='?SetoranManual&suksestambah';
                              //      window.top.location.reload();
                    			</script>
                    <?php    }else { ?>
                    <script type="text/javascript">
                    				alert("Tabel Data LKAI gagal diperbarui");
                    				window.location.href='?SetoranManual&gagaltambah';
                                    window.top.location.reload();
                    			</script>
                    <?php    }

}
?>
<!-- date picker -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<!-- autocomplete-->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>

<script src="librari/currency.js"></script>
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Upload Simpanan</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Upload Simpanan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="validate-me-plz" enctype="multipart/form-data"  name="form1" role="form" action="" method="post">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Upload File</label></div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="file" id="input01" data-rule-required="true" data-msg-required="Mohon masukkan data file Simpanan." />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="row">
                               <div class="col-md-12"> <font color=red><b> PERHATIAN !!!</b> <br />
                                -> Pastikan File anda berbentuk .csv <br />
                                -> Pastikan urutan kolom pada file csv adalah NO Anggota, Tgl Simpan, Jumlah, Jenis Simpanan (Simpanan Pokok / Simpanan Wajib / Simpanan Sukarela),jenis(setor / tarik), Jenis Setor (Manual / Bank)<br />
                                -> Pastikan format tanggal simpanan (YYYY-m-d)<br />
                                -> Pastikan tidak ada nama kolom pada baris atas   </font>     
                            </div> </div>
                        </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                        <a href="?SetoranManual" class="btn btn-large btn-warning">Kembali</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row"></div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
        </div>
       </div>
               
    </div>
<script type="text/javascript" src="../validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#input01').filestyle();
$('#input01').change(function(){
      var file = $('#input01').val();
      var exts = ['csv'];
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
          alert('Hanya boleh csv ');
          $('#input01').filestyle('clear');
        }
      }
      
    });
    
    $('#validasi').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
jQuery.validator.methods["date"] = function (value, element) { return true; } 
</script>
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
$('#nominalA').keyup(function () {
         $('#nominalB').val($(this).val());
        var $th = $('#nominalB').val($(this).val());
        $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) { return ''; }));
     });
     
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'DD/MM/YYYY'
    });
</script>
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