<?php
if(isset($_POST["submit"])){
   $kode    = mysql_real_escape_string(strip_tags($_POST["kode"]));
   $noSim   = mysql_real_escape_string(strip_tags($_POST["noSim"]));
   $nmAng   = mysql_real_escape_string(strip_tags($_POST["no_anggota"]));
   $tglSim  = tglformataction($_POST["tglSim"]);
   $jmlSim  = mysql_real_escape_string(strip_tags($_POST["jmlSim"]));
   $ket     = mysql_real_escape_string(strip_tags($_POST["ket"]));
   $date    = date("Y-m-d h:i:s");
   
   mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','$nmAng','$date','setor simpanan manual','ubah')");
   mysql_query("UPDATE tabel_simpanan
    set  no_anggota='$nmAng', tgl_simpanan='$tglSim', jumlah = '$jmlSim', 
    jenis_simpanan = '$ket' WHERE kode_simpanan = '$kode' ");
    
   header("location:?SetoranManual&suksesedit");
}
$idA = (int)mysql_real_escape_string(trim($_GET["update-SetoranManual"]));
//$idB = (int)mysql_real_escape_string(trim($_GET["agt"]));

$sqlSetor = mysql_query("SELECT tabel_simpanan.*, tabel_anggota.* FROM tabel_simpanan JOIN tabel_anggota
                    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota 
                    WHERE tabel_simpanan.kode_simpanan = '$idA' 
                    AND jenis='setor'") or die (mysql_error());
//if(mysql_num_rows($sqlSetor)==0) header("location:?SetoranManual");
$rowA = mysql_fetch_array($sqlSetor);
?>
<!-- date picker -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<!-- autocomplete-->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#nmAng" ).autocomplete({
      source: 'assets/Actextbox/search.php'
    });
  });
  </script>
<script type="text/javascript">
	
	var ajaxRequest;
	function getAjax() //fungsi untuk mengecek AJAX pada browser
	{
		try
		{
			ajaxRequest = new XMLHttpRequest();
		}
		catch (e)
		{
			try
			{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e) 
			{
				try
				{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e)
				{
					alert("Your browser broke!");
					return false;
				}
			}
		}
	}
	
		
	function autoComplete() //fungsi menangkap input search dan menampilkan hasil search
	{
		getAjax();
		
		var namaanggota = document.getElementById("nmAng").value;
		
		if (namaanggota == "") 
		{		
			document.getElementById("no_anggota").value = "";
			document.getElementById("email").value = "";
			document.getElementById("no_telp").value = "";
		}
		else
		{
			ajaxRequest.open("GET","page/cari.php?run=carianggota&namaanggota="+namaanggota);
			ajaxRequest.onreadystatechange = function()
			{	
					if ((ajaxRequest.readyState == 4) && (ajaxRequest.status == 200))
					{
						
						var ss = ajaxRequest.responseText.split("||");
						for(var i=0; i < ss.length; i++){
							var a1 = ss[0];
							var a2 = ss[1];
							var a3 = ss[2];
							var a4 = ss[3];
							var a5 = ss[4];
						
						}
						if(a1 != ""){
						document.getElementById("no_anggota").value = a1;
						document.getElementById("email").value = a2;
						document.getElementById("no_telp").value = a3;
						}
						
					} else
					{
					document.getElementById("no_anggota").innerHTML = "<img src='images/ajax-loader.gif'>";
					document.getElementById("email").innerHTML = "<img src='images/ajax-loader.gif'>";
					document.getElementById("no_telp").innerHTML = "<img src='images/ajax-loader.gif'>";
					}
				
			}
			ajaxRequest.send(null);
		}
				
	}
	
	</script>
<script type="text/javascript">
    function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
      function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
     //    if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
</script>
<script src="librari/currency.js"></script>
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Edit Setor Simpanan (Manual)</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Edit Setor Simpanan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form id="form1" name="form1" role="form" action="" method="post">
                        <input class="form-control" name="kode" type="hidden" value="<?php echo $rowA["kode_simpanan"]?>"/>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="nmAng" name="nmAng" type="text" onBlur="autoComplete()" placeholder="masukkan nama anggota atau kode anggota" value="<?php echo $rowA["nama_anggota"]." (".$rowA["nip"].")"?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_anggota" name="no_anggota" type="text" placeholder="auto data" value="<?php echo $rowA["no_anggota"]?>" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Email</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="auto data" value="<?php echo $rowA["email"]?>" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No telp</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_telp" name="no_telp" type="text"  placeholder="auto data" value="<?php echo $rowA["no_telp"]?>" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Tanggal Simpanan</label></div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="datepicker" name="tglSim" placeholder="ketik kolom tanggal" onKeyPress="return isNumberKey(event)" value="<?php echo format_tgl($rowA["tgl_simpanan"]); ?>" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data tanggal." />
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Jumlah Setor Simpanan</label></div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                          <div class="input-group-addon">Rp</div>
                                          <input id="nominalA" onkeyup="reformatText(this)" class="form-control" onKeyPress="return isNumberKey(event)" type="text" data-rule-required="true" data-msg-required="Mohon masukkan nominal setoran wajib." value="<?php echo number_format( $rowA["jumlah"], 0 , '' , ',' )?>" />
                                          <input class="textboxH" type="hidden" id="nominalB" onkeyup="kali()" name="jmlSim" value="<?php echo $rowA["jumlah"]?>" />
                                          <div class="input-group-addon">.00</div>
                                          <span id="errmsg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Jenis Simpanan</label></div>
                                    <div class="col-md-6">
                                        <select class="form-control" id="ket" name="ket" data-rule-required="true" data-msg-required="Mohon masukkan data Jumlah setor Simpanan.">
                                            <option value="<?php echo $rowA['jenis_simpanan']; ?>"><?php echo $rowA['jenis_simpanan']; ?></option>
                                            <option value="Simpanan Pokok">Simpanan Pokok</option>
                                            <option value="Simpanan Wajib">Simpanan Wajib</option>
                                            <option value="Simpanan Sukarela">Simpanan Sukarela</option>
                                            
                                          </select>
                                    </div>
                                </div>
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
    
        </div>
       </div>
               
    </div>
<!-- tanggal -->
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
<!-- validate -->
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
jQuery.validator.methods["date"] = function (value, element) { return true; } 
</script>