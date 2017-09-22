<?php
	include "../../config/koneksi.php";
	include "../../config/utility.php";
	session_start();

	$ses_kodelogin = $_SESSION['kodelogin'];
	$kode_pemeliharaan = $_POST['id'];
	$nama_table = $_POST['nama_table'];
	$objek = $_POST['objek'];
	
	/* $kode_pemeliharaan = 3;
	$nama_table = 'Pemeliharaan';
	$objek = 'apar'; */
	
	$nama_table_kecil = strtolower($nama_table);
	
	$pk = ambil_pk($nama_table);
	$sql = "
		select Pemeliharaan.*, Apar.gambar_apar, Apar.foto_lokasi, kode_pemeliharaan 'id', Apar.id_apar 'fk' from Pemeliharaan 
		inner join pengisian 
			on pengisian.kode_pengisian=Pemeliharaan.kode_pengisian 
		inner join Apar 
			on Apar.id_apar=pengisian.kode_apar 
		where kode_pemeliharaan = $kode_pemeliharaan 
		order by kode_pemeliharaan desc 
		 limit 0, 30
	";
	//$sql = "SELECT * from $nama_table WHERE $pk = '$id'";
	$sqldetail = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($sqldetail);
	
	
	$kolom_table = information_schema($nama_table);	
?>

<div class="row">
	
	<div class="col-md-4">
        <?php 
			$lihat_peta = lihat_peta($nama_table, $row, $objek);
			
			$gambar = $lihat_peta[0];
			$nama_gambar = $lihat_peta[1];
		?>
		
		<img src="<?php echo $gambar; ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo "$nama_gambar"; ?></p>
    </div>
	
	
	<div class="panel-body">
		<div class="row">
			<form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
				<?php
					$i = 1;
					$ketemu_hidden = 0;
					
					foreach($kolom_table as $key=>$kol) {
						$cek_hidden = strpos($kol['Komen'], 'hidden');
						$cek_primary = strpos($kol['Komen'], 'primary');
						$cek_fk = strpos($kol['Komen'], 'fk');
						$cek_gambar = strpos($kol['Komen'], 'gambar');
						
						$hidden = $cek_primary !== false ? "hidden" : null;
						
						$kolom_asli = $kol['Kolom'];
						$kolom = ucwords_kolom_table($kol['Kolom']);
						$kolom2 = strtolower($kol['Kolom']);
						
						if($i==1 || $i%8 == 1) {
							echo "<div class='col-lg-6'>";										
						}
						
						if($cek_fk !== false) {
							$kolomtest = alias_kolom_fk($kol['Kolom'], $cek_primary);
							
							$ucwords_kolom_table = ucwords_kolom_table($kolomtest);
							$key = cari_ukuran($kol['Kolom']);
							
							if($key) {
								$ucwords_kolom_table = "$ucwords_kolom_table ($key)";
							}
							
							$q = multiple_query_form_update($nama_table_kecil);
							
							$sql_fk = mysql_query($q[$kol['Kolom']]);
							$row_fk = mysql_fetch_array($sql_fk);
							
							//echo $q[($key-1)];
				?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-5"><label <?php echo $hidden; ?>><?php echo $ucwords_kolom_table; ?></label></div>
									<div class="col-md-5"><label><?php echo $row_fk['id']; ?></label></div>										
									<div class="col-md-5">
										<input type='hidden' name='<?php echo $kolom_asli; ?>' value='<?php echo $row_fk['id']; ?>'>
									</div>
								</div>
							</div>
				<?php
						}
						else {
							if($cek_primary !== false) {
								echo "<input type='hidden' name='$kolom2' value='".$row[$kol['Kolom']]."' />";
								$ketemu_hidden++;
							}
							else if($cek_hidden !== false) {
								echo "<input type='hidden' name='$kolom_asli' value='$ses_kodelogin'/>";
								$ketemu_hidden++;
							}
							else {
								$kolom = $kol['Kolom'];				
								$kolom = label_khusus($kolom);
								
				?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-5">
											<label>
												<?php echo $kolom; ?>
											</label>
										</div>
										<div class="col-md-7">
											<?php 
												if($kol['Tipe'] == 'date') {
											?>
													<input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="<?php echo $kolom2; ?>" value="<?php echo date('d/m/y', strtotime($row[$kol['Kolom']])); ?>"  placeholder="masukkan Tgl Oprs" />
													<!--
													<input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="<?php echo $kolom2; ?>" value="sssss <?php echo date('d/m/y', strtotime($row[$kol['Kolom']])); ?>" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
													-->
											<?php 
												} else if($cek_gambar !== false) { 
													$objek = $kolom_asli == 'foto_tacometer' ? 'tacometer' : null;
													
													$lihat_peta = lihat_peta($nama_table, $row, $objek);
													$img_src = $lihat_peta[0];
											?>
												<input type="file" class="form-control" id='imgInp' name="<?php echo $kolom_asli; ?>" value="<?php echo $row[$kolom_asli]; ?>" />
												<img id="blah" src="<?php echo $img_src; ?>" alt="your image" style='width:150px; height:150px;' />
												<input type="hidden" name="<?php echo $kolom2.'_cadangan'; ?>" value="<?php echo $row[$kol['Kolom']]; ?>" />
												
											<?php 
												} 
												else {
													if(
														$kol['Tipe'] == 'int' || 
														$kol['Tipe'] == 'float' || 
														$kol['Tipe'] == 'double'
													) {
											?>
														<input type="text" onKeyPress="return isNumberKey(event)" class="form-control" name="<?php echo $kolom2; ?>" data-rule-required="true" value="<?php echo $row[$kol['Kolom']]; ?>" />
											<?php 
													} else if($kol['Tipe'] == 'enum') { 
														preg_match("/^enum\(\'(.*)\'\)$/", $kol['Nilai_Kolom'], $matches);
														$enum = explode("','", $matches[1]);
														
														echo "<select class='form-control' name='$kolom_asli'>";
														foreach($enum as $enum_val) {
															if($enum_val == $row[$kol['Kolom']])
																echo "<option selected value='$enum_val'>$enum_val</option>";
															else
																echo "<option value='$enum_val'>$enum_val</option>";
															
														}
														echo "</select>";
											
													} else { 
												?>
														<input type="text" class="form-control" name="<?php echo $kolom2; ?>" data-rule-required="true" value="<?php echo $row[$kol['Kolom']]; ?>" />
											<?php 
													} 
												}
											?>
										</div>
									</div>
								</div>
				<?php									
							}
						}
						
						if($i%8 == 0) {
							$i -= $ketemu_hidden;
							$ketemu_hidden = 0;
							
							if($i%8 == 0)
								echo "</div>";
						}
						
						$i++;
					}
				?>
				
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-7">
						<button type="submit" name="submit" id="submit" value="ubah" class="btn btn-large btn-success">Ubah</button>
						
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
	var datepicker_class = document.getElementById('datepicker');
	
	var picker = new Pikaday({
		field: datepicker_class,
		firstDay: 1,
		minDate: new Date(1960, 0, 1),
		maxDate: new Date(2500, 12, 31),
		yearRange: [1960, 2500],
		format: 'DD/MM/YYYY'
	});
	
</script>


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
    
    $("#imgInp").change(function(){
        readURL(this);
    });

</script>
