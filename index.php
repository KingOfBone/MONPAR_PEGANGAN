<?php
    ob_start();
	session_start();

    date_default_timezone_set("Asia/Jakarta");
	
	
    if( ! isset($_SESSION["level"])) header("location:login.php");
	include    "page/beranda/headadmin.php";
    include    "page/beranda/kumpulan_menu.php";
    include     "librari/inc.librari1.php";
    include     "config/koneksi.php";
    include     "config/utility.php";
	
	
	$jenisuser = $_SESSION["jenisuser"];
	
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo headadmin(); ?>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
<script type="text/javascript" >
	$(document).ready(function() {
		$("#notificationLink").click(function()
		{
		$("#notificationContainer").fadeToggle(300);
		$("#notification_count").fadeOut("slow");
		return false;
		});

		//Document Click
		$(document).click(function()
		{
		$("#notificationContainer").hide();
		});
		//Popup Click
		$("#notificationContainer").click(function()
		{
		return false
		});

	});

	$( "" ).click(function( eventObject ) {
		var elem = $( this );
		if ( elem.attr( "href" ).match( /evil/ ) ) {
			eventObject.preventDefault();
			elem.addClass( "evil" );
		}
	});
	
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
        return false;
        return true;
    }
    
	
	
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#gambar_dinamis").change(function(){
        readURL(this);
    });

</script>

<!-- 
	script baru nih - awalannya
-->
<!-- 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	script baru nih - akhirannya
-->


<div class="main">
  <header class="header-main">
  <br /><br />
    <nav class="navbar navbar-default navbar-cls-top navbar-fixed-top" role="navigation" style="margin-bottom: 0">

    <div class="page-wrapper">
            <div class="navbar-header">
                <button class="button-nav-toggle navbar-toggle"  >
                <span class="icon">&#9776;</span> Menu</button>
                <a class="navbar-brand" href="?dashboard">
                   <!-- <img class="img-responsive" src="images/kp3.png" />--><i>MONPAR</i>
                </a>
            </div>

       <!--
        <div style="color: white; padding: 12px 11px 5px; float: right;font-size: 16px;">
        <strong style="padding: 2px 0;"><?php echo $_SESSION["nama_lengkap"];?></strong> &nbsp;
        <a href="#" class="btn btn-danger square-btn-adjust logoutK"><i class="fa fa-power-off"></i></a>
        <button class="button-nav-toggle hdbtn"><span class="icon">&#9776;</span></button>
        </div>
     -->

     <ul class="nav navbar-top-links navbar-right">

             <li class="dropdown">
                    <a  title="Panel Pengaturan Akun" class="dropdown-toggle putih" data-toggle="dropdown" href="#">
                        <strong style="padding: 2px 0;">
							<?php 
								if($jenisuser == 'gi')
									$sql = "select namagi 'nama' from master.gi where kodegi = '$_SESSION[kodegi]'";
								else if($jenisuser == 'app' || $jenisuser == 'ki')
									$sql = "select namaapp 'nama' from master.app where kodeapp = '$_SESSION[kodeapp]'";
								else if($jenisuser == 'apd')
									$sql = "select namaapd 'nama' from master.apd where kodeapd = '$_SESSION[kodeapd]'";
								else if($_SESSION["level"] == 'superadmin')
									$sql = "select namaapd 'nama' from master.apd where kodeapd = '$_SESSION[kodeapd]'";
								
								$level_diatas = strtoupper($jenisuser);
								
								$hasil = mysql_query($sql);
								$row = mysql_fetch_array($hasil);
								echo $username = "$level_diatas ".$row['nama'];
							?>
						</strong> &nbsp; <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--
						<li>
                            <a href="?password"><i class="fa fa-cogs"></i> Ganti Password</a>
                        </li>
						-->
                        <li>
                            <a href="#" class="logoutK"><i class="fa fa-power-off"></i> Log out</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
             <li class="dropdown">
                <button title="Tombol Menu" class="button-nav-toggle hdbtn" style="float: none;"><span class="icon">&#9776;</span></button>
             </li>
     </ul>


 </div>
 </nav>

  </header>

    <div id="wrapper">

        <!-- /. NAV SIDE  -->
         <!-- /. Content Page  -->
        <?php
			$querystring = array_keys($_GET);
			
			if(isset($querystring[0]))
				$querystring_key = $querystring[0];
				
				/* echo "if($querystring_key == 'dashboard' && $_SESSION[level] != 'superadmin')";
				
				if($querystring_key == 'dashboard' && $_SESSION["level"] != 'superadmin')
					header("location:http://localhost/MONPAR/?apar_lihat"); */
			else {
				if($_SESSION["level"] == 'superadmin')
					header("location:http://localhost/MONPAR/?dashboard");
				else
					header("location:http://localhost/MONPAR/?apar_lihat");				
			}
			
			$ses_kodelogin = $_SESSION['kodelogin'];
			
			$i_gambar_dinamis = 0;
			
			$querystring_value = isset($_GET[$querystring_key]) ? $_GET[$querystring_key] : null;
			$nama_table = ambil_nama_table_dari_querystring($querystring, $querystring_value);
			$nama_table_kecil = strtolower($nama_table['querystring']);
			
			//khusus datamaster - awal
			$foldernyah = $nama_table_kecil;
			//khusus datamaster - akhir
			
			$aksinyah = strtolower($nama_table['aksinyah']);
			$nama_table = $nama_table['querystring'] == 'Datamaster' ? $nama_table['value'] : $nama_table['querystring'];
			//echo "nama_table_kecil = $nama_table_kecil || aksinyah $aksinyah";
			
			
			$get_menu_depan = [
				'dashboard', 'merk', 'datamaster', 'apar', 'apar_unit', 'pengisian', 'pemeliharaan', 'pemakaian', 'laporan'
			];
			
			if(in_array($nama_table_kecil, $get_menu_depan)) {
				
				if($nama_table_kecil == 'dashboard') {
					$filename = "page/dashboard/dashboard.php";
				}
				else {
					//if($nama_table_kecil != 'pengisian' && $aksinyah != 'lihat') {
						if($aksinyah == 'lihat' && isset($_GET["id"]))
							$filename = "page/$nama_table_kecil/".$nama_table_kecil."_lihat_detail.php";				
						else if($aksinyah == 'lihat' && isset($_GET["idp"]))
							$filename = "page/$nama_table_kecil/".$nama_table_kecil."_lihat.php";				
						else 
							$filename = "page/$nama_table_kecil/".$nama_table_kecil."_$aksinyah.php";
					//}
				}
				
				if(file_exists($filename)) {
					include "$filename";
				}
				else
					include "page/notfound.php";
			}
			else
				include "page/notfound.php";
			
			//echo "filename = $filename;";
			
			
			
			
			/* if(isset($_GET["dashboard"])){ include "page/dashboard/index.php";}
			die();
            
			
			else if (isset($_GET["datamaster"])){ include "page/datamaster/datamaster.php";}
            else if (isset($_GET["datamaster_tambah"])){ include "page/datamaster/datamaster_tambah.php";}
            else if (isset($_GET["datamaster_tambah_p"])){ include "page/datamaster/datamaster_tambah_p.php";}
            else if (isset($_GET["datamaster_lihat"]) && isset($_GET["id"])){ include "page/datamaster/datamaster_lihat_detail.php";}
            else if (isset($_GET["datamaster_lihat"])){ include "page/datamaster/datamaster_lihat.php";}
            else if (isset($_GET["datamaster_update"])){ include "page/datamaster/datamaster_update.php";}
            
			
			else if (isset($_GET["apar_lihat"])){ include "page/apar/apar_lihat.php";}
            else if (isset($_GET["apar_tambah"])){ include "page/apar/apar_tambah.php";}
            else if (isset($_GET["apar_tambah_p"])){ include "page/apar/apar_tambah_p.php";}
            else if (isset($_GET["apar_lihat"]) && isset($_GET["id"])){ include "page/apar/apar_lihat_detail.php";}
            else if (isset($_GET["apar_lihat"])){ include "page/apar/apar_lihat.php";}
            else if (isset($_GET["apar_update"])){ include "page/apar/apar_update.php";}
            
			
			
			else if (isset($_GET["pemeliharaan_lihat"])){ include "page/pemeliharaan/pemeliharaan_lihat.php";}
            else if (isset($_GET["pemeliharaan_tambah"])){ include "page/pemeliharaan/pemeliharaan_tambah.php";}
            else if (isset($_GET["pemeliharaan_tambah_p"])){ include "page/pemeliharaan/pemeliharaan_tambah_p.php";}
            else if (isset($_GET["pemeliharaan_lihat"]) && isset($_GET["id"])){ include "page/pemeliharaan/pemeliharaan_lihat_detail.php";}
            else if (isset($_GET["pemeliharaan_lihat"])){ include "page/pemeliharaan/pemeliharaan_lihat.php";}
            else if (isset($_GET["pemeliharaan_update"])){ include "page/pemeliharaan/pemeliharaan_update.php";}
            
			
			else if (isset($_GET["pemakaian_lihat"])){ include "page/pemakaian/pemakaian_lihat.php";}
            else if (isset($_GET["pemakaian_tambah"])){ include "page/pemakaian/pemakaian_tambah.php";}
            else if (isset($_GET["pemakaian_tambah_p"])){ include "page/pemakaian/pemakaian_tambah_p.php";}
            else if (isset($_GET["pemakaian_lihat"]) && isset($_GET["id"])){ include "page/pemakaian/pemakaian_lihat_detail.php";}
            else if (isset($_GET["pemakaian_lihat"])){ include "page/pemakaian/pemakaian_lihat.php";}
            else if (isset($_GET["pemakaian_update"])){ include "page/pemakaian/pemakaian_update.php";}
            
			else{include "page/notfound.php";} */
        ?>
          <?php /* PAGE WRAPPER */ ?>
    </div>
     <!-- /. WRAPPER  -->
  <!-- menu -->
        <div class="menu">
          <nav class="nav-main">
            <div class="nav-container">

                <?php
					menu_sa($username);
					
					if($_SESSION["level"]=="superadmin") {					
						menu_beranda();
						menu_data_master();
						menu_laporan();
					}
					else {
						menu_apar();
						
						if($_SESSION['jenisuser'] != 'gi')
							menu_apar_unit();
						
						menu_pengisian();
						menu_pemeliharaan();
						menu_pemakaian();
						menu_laporan();
					}/* 
					else if($jenisuser=="gi") {
						menu_apar();
						menu_laporan();
					} */
                ?>

            </div>
          </nav>
        </div>
	</div>
	
	
	

	<script>
		$("#notif1").click(function(event){
			event.preventDefault(); console.log(event.target.nodeName);
			$.ajax({ type: 'POST', url: 'pinjaman=lunas', data: {id:0, module:'Module',source:'Source'}, complete: function(data){
				console.log("DONE"); window.location = "?pinjaman&Status=lunas" } }); });
		$("#notif2").click(function(event){
			event.preventDefault(); console.log(event.target.nodeName);
			$.ajax({ type: 'POST', url: 'angsuranterakhir', data: {id:0, module:'Module',source:'Source'}, complete: function(data){
				console.log("DONE"); window.location = "?tigablnterakhir" } }); });
		$("#notif3").click(function(event){
			event.preventDefault(); console.log(event.target.nodeName);
			$.ajax({ type: 'POST', url: 'simpananwajib=lunas', data: {id:0, module:'Module',source:'Source'}, complete: function(data){
				console.log("DONE"); window.location = "?SetoranManual&simpanawajib=lunas" } }); });
		
		
		<?php 
			if($i_gambar_dinamis > 0) {
				for($igamdin = 1; $igamdin <= $i_gambar_dinamis; $igamdin++) {
		?>
					function readURL_<?php echo $igamdin; ?>(input) {
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							
							reader.onload = function (e) {
								$('#blah_<?php echo $igamdin; ?>').attr('src', e.target.result);
							}
							
							reader.readAsDataURL(input.files[0]);
						}
					}
					
					$("#gambar_dinamis_<?php echo $igamdin; ?>").change(function(){
						readURL_<?php echo $igamdin; ?>(this);
					});
		<?php 
				} 
			} 
		?>

	</script>
	
	<style>
		.rotateimg90 {
		  -webkit-transform:rotate(90deg);
		  -moz-transform: rotate(90deg);
		  -ms-transform: rotate(90deg);
		  -o-transform: rotate(90deg);
		  transform: rotate(90deg);
		}
	</style>
	

	<script src="assets/pickday/moment.js"></script>
	<script src="assets/pickday/pikaday.js"></script>
	<script>
		var datepicker_class = document.getElementsByClassName('datepicker');
		var datepicker_length = datepicker_class.length;
		
		for(var i=0; i<datepicker_length; i++) {
			var picker = new Pikaday({
				field: datepicker_class[i],
				firstDay: 1,
				minDate: new Date(1960, 0, 1),
				maxDate: new Date(2500, 12, 31),
				yearRange: [1960, 2500],
				format: 'DD/MM/YYYY'
			});
		}
	</script>
	<script>
		var picker = new Pikaday({
			field: document.getElementById('datepicker2'),
			firstDay: 1,
			minDate: new Date(1960, 0, 1),
			maxDate: new Date(2500, 12, 31),
			yearRange: [1960, 2500],
			format: 'DD/MM/YYYY'
		});
	</script>
	




	<?php if($aksinyah == 'tambah' && $nama_table != 'Pemeliharaan') {  ?>
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
			
			/* 
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
			}); */
		</script>
	<?php } ?>
	

    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- konfirmasi -->
    <script src="assets/js/custom.js"></script>
    <!-- confirm -->

	<script src="assets/confirmdell/js/script2.js"></script>
    <script src="assets/confirmdell/jquery.confirm/jquery.confirm.js"></script>
    <!--
	-->

</body>
</html>
<?php ob_end_flush(); ?>
