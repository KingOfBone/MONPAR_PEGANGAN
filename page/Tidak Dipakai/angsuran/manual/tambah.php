<?php
if(isset($_POST["submit"])){
    $nopin      = mysql_real_escape_string(strip_tags($_POST["nopin"]));
    $noAng      = mysql_real_escape_string(strip_tags($_POST["no_anggota"]));
    $tglAng     = tglformataction($_POST["tglSim"]);
    $angsbayar  = mysql_real_escape_string(strip_tags($_POST["angsbayar"]));
    $angK       = mysql_real_escape_string(strip_tags($_POST["angK"]));
    $ket        = mysql_real_escape_string(strip_tags($_POST["ket"]));
    

     
     $date  = date("Y-m-d h:i:s");
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','$date','angsuran manual','tambah')");
     $sql = "INSERT INTO tabel_angsuran VALUES ('','$nopin','$noAng','$tglAng','$angK','$angsbayar','$ket','manual')"; 
    $insert = mysql_query($sql);
//    echo $sql;
    if ($insert){
        header("location:?angsuran&suksestambah");
    } else {
        echo $sql;
    }
    
}


/*$sqlPriciPal = mysql_query("SELECT * FROM principal ORDER BY kodeprincipal ASC") or die (mysql_error()); */
?>
 <link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<!-- autocomplete-->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#skills" ).autocomplete({
      source: 'assets/Actextbox/search2.php'
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
		
		var namaanggota = document.getElementById("skills").value;
		
		if (namaanggota == "") 
		{		
			document.getElementById("no_anggota").value = "";
			document.getElementById("angs").value = "";
            document.getElementById("nopin").value = "";
            document.getElementById("email").value = "";
			document.getElementById("no_telp").value = "";
            document.getElementById("angK").value = "";
			}
		else
		{
			ajaxRequest.open("GET","page/cari.php?run=caripinjaman&namaanggota="+namaanggota);
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
                            var a6 = ss[5];
							
						}
						if(a1 != ""){
						document.getElementById("no_anggota").value = a1;
						document.getElementById("angs").value = a2;
						document.getElementById("nopin").value = a3;
						document.getElementById("email").value = a4;
						document.getElementById("no_telp").value = a5;
                        document.getElementById("angK").value = a6;
						}
						
					} else
					{
					document.getElementById("no_anggota").innerHTML = "<img src='images/ajax-loader.gif'>";
					document.getElementById("angs").innerHTML = "<img src='images/ajax-loader.gif'>";
				    document.getElementById("nopin").innerHTML = "<img src='images/ajax-loader.gif'>";
				    document.getElementById("email").innerHTML = "<img src='images/ajax-loader.gif'>";
					document.getElementById("no_telp").innerHTML = "<img src='images/ajax-loader.gif'>";
                    document.getElementById("angK").innerHTML = "<img src='images/ajax-loader.gif'>";
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
   //      if (charCode > 31 && (charCode < 47 || charCode > 57))
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
                        <h2>Tambah Angsuran</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah Angsuran
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="validate-me-plz" action="" method="post">
                             <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Anggota</label></div>
                                    <div class="col-md-5">
                                        
                                        <input id="skills" class="form-control" name="keyword" value="<?php if(isset($_POST["cari"])){ echo $_POST["keyword"]; }?>" onBlur="autoComplete()" placeholder="masukkan nama anggota atau kode anggota" data-rule-required="true" data-msg-required="Mohon masukkan data NIP" placeholder="masukkan nama anggota atau NIP"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_anggota" name="no_anggota" type="text" placeholder="" readonly=""/>
                                        <input class="form-control" id="nopin" name="nopin" type="hidden" placeholder="" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Email</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No telp</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_telp" name="no_telp" type="text"  placeholder="" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Jumlah Angsuran Perbulan</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="angs" name="angs" type="text" placeholder="" readonly="" />
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Jumlah Angsuran yg Dibayarkan</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="angsbayar" name="angsbayar" type="text" onKeyPress="return isNumberKey(event)" placeholder="ketik jumlah angsuran yang dibayarkan" data-rule-required="true" data-msg-required="Mohon masukkan data jumlah angsuran"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Tanggal Angsuran</label></div>
                                    <div class="col-md-3">
                                        <div class="has-feedback " id="basicExample">
                                        <input type="text" class='form-control' onKeyPress="return isNumberKeyTgl(event)" id="datepicker" name="tglSim" placeholder="ketik kolom tanggal" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"> <label>Angsuran Ke</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="angK" name="angK" type="text" readonly="" data-rule-required="true" data-msg-required="Mohon masukkan data angsuran ke"  />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Keterangan</label></div>
                                    <div class="col-md-8">
                                       <textarea name="ket" class="form-control" data-rule-required="true" data-msg-required="Mohon masukkan data keterangan" data-rule-minlength="4" placeholder="masukkan keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                        <a href="?angsuran" class="btn btn-large btn-warning">Kembali</a>
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
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1990, 2020],
        format: 'DD/MM/YYYY'
    });
</script>
<!-- validate -->
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
    jQuery.validator.methods["date"] = function (value, element) { return true; } 
</script>