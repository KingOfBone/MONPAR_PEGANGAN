<?php
if(isset($_POST["submit"])){
    $nmAng        = mysql_real_escape_string(strip_tags($_POST["no_anggota"]));
    $tglSim       = mysql_real_escape_string(strip_tags(tglformataction($_POST["tglSim"])));
    $jmlSim       = mysql_real_escape_string(strip_tags($_POST["jmlSim"]));
    $ket          = mysql_real_escape_string(strip_tags($_POST["ket"]));
   
    mysql_query("INSERT INTO tabel_simpanan VALUES ('','','$nmAng','$tglSim','$jmlSim','$ket','setor')");
    
    header("location:?SetoranManual&suksestambah");
}

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
                        <h2>Tambah Setor Simpanan</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah Setor Simpanan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form1" name="form1" role="form" action="" method="post">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Nama Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="nmAng"  type="text" onBlur="autoComplete()" placeholder="masukkan nama anggota atau kode anggota" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No Anggota</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_anggota" name="no_anggota" type="text" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Email</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="email"  type="text" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>No telp</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="no_telp"  type="text"  readonly=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Tanggal Simpanan</label></div>
                                    <div class="col-md-3">
                                        <input type="text" class='form-control' id="datepicker" name="tglSim" placeholder="ketik kolom tanggal" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Jumlah Simpanan</label></div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="jmlSim"  placeholder="ketik kolom jumlah" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Keterangan</label></div>
                                    <div class="col-md-6">
                                        <textarea name="ket" class="form-control"  placeholder="masukkan keterangan" ></textarea>
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
        firstDay: 1,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1990, 2020],
        format: 'DD-MM-YYYY'
    });
</script>
