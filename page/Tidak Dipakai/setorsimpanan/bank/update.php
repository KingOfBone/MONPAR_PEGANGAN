<?php
if(isset($_POST["submit"])){
   $kode         = mysql_real_escape_string(strip_tags($_POST["kode"]));
    $noSim        = mysql_real_escape_string(strip_tags($_POST["noSim"]));
    $nmAng        = mysql_real_escape_string(strip_tags($_POST["no_anggota"]));
    $tglSim       = tglformataction($_POST["tglSim"]);
    $jmlSim       = mysql_real_escape_string(strip_tags($_POST["jmlSim"]));
    $ket          = mysql_real_escape_string(strip_tags($_POST["ket"]));
    
   mysql_query("UPDATE tabel_simpanan
    set  no_anggota='$nmAng', tgl_simpanan='$tglSim', jumlah = '$jmlSim', 
    keterangan = '$ket' WHERE kode_simpanan = '$kode' ");
    
   header("location:?SetoranManual&suksesedit");
}
$idA = (int)mysql_real_escape_string(trim($_GET["update-SetoranManual"]));
$idB = (int)mysql_real_escape_string(trim($_GET["agt"]));
$sqlSetor = mysql_query("SELECT tabel_simpanan.*, tabel_anggota.* FROM tabel_simpanan JOIN tabel_anggota
                    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota 
                    WHERE tabel_simpanan.kode_simpanan = '$idA' AND tabel_anggota.no_anggota='$idB'
                    AND jenis='setor'") or die (mysql_error());
if(mysql_num_rows($sqlSetor)==0) header("location:?simpanan");
$rowA = mysql_fetch_array($sqlSetor);
?>
<!-- date picker -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />


<link rel="stylesheet" type="text/css" href="librari/jquery.autocomplete.css" />
<script type="text/javascript" src="librari/jquery.js"></script>
<script type="text/javascript" src="librari/jquery.autocomplete.js"></script>

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
$(document).ready(function(){
 $("#nmAng").autocomplete("page/autocomplete.php", {
		selectFirst: true
	});
});

</script>

    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Edit Setor Simpanan</h2>
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
                        <form id="form1" name="form1" role="form" action="" method="post">
                        <input class="form-control" name="kode" type="hidden" value="<?php echo $rowA["kode_simpanan"]?>"/>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="nmAng" name="nmAng" type="text" onBlur="autoComplete()" placeholder="masukkan nama anggota atau kode anggota" value="<?php echo $rowA["nama_anggota"]?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_anggota" name="no_anggota" type="text" placeholder="auto data" value="<?php echo $rowA["no_anggota"]?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Email</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="auto data" value="<?php echo $rowA["email"]?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No telp</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_telp" name="no_telp" type="text"  placeholder="auto data" value="<?php echo $rowA["no_telp"]?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Tanggal Simpanan</label></div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="datepicker" name="tglSim" placeholder="ketik kolom tanggal" value="<?php echo format_tgl($rowA["tgl_simpanan"]); ?>"  />
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Jumlah Simpanan</label></div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="jmlSim"  placeholder="ketik kolom jumlah" value="<?php echo $rowA["jumlah"]?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Keterangan</label></div>
                                    <div class="col-md-6">
                                        <textarea name="ket" class="form-control"  placeholder="masukkan keterangan" ><?php echo $rowA["keterangan"]?></textarea>
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
    <div class="row"></div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
            <div class="row"></div>
                <!-- /. ROW  -->
        </div>
       </div>
               
    </div>

<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>

  <script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'DD-MM-YYYY'
    });
</script>