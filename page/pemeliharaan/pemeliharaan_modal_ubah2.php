<?php
	include "../../config/koneksi.php";
	include "../../config/utility.php";
	session_start();

	$kode_pengisian = $_POST['id'];
	$nama_table = $_POST['nama_table'];
	$objek = $_POST['objek'];
	
	/* $kode_pengisian = 3;
	$nama_table = 'Pemeliharaan';
	$objek = 'apar'; */
	
	$nama_table_kecil = strtolower($nama_table);
	
	$pk = ambil_pk($nama_table);
	$sql = "select $nama_table.*, Apar.gambar_apar, Apar.foto_lokasi, $pk 'id', Apar.id_apar 'fk' from $nama_table inner join Apar on $nama_table.kode_pengisian=apar.id_apar where kode_pengisian = $kode_pengisian order by $pk desc limit 0, 30";
	//$sql = "SELECT * from $nama_table WHERE $pk = '$id'";
	$sqldetail = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($sqldetail);
	
	
	$kolom_table = information_schema($nama_table);	
?>








<div class="row">

    <div class="col-md-3">
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
						$ketemu_date = 0;
						$i_gambar_dinamis = 0;
						
						foreach($kolom_table as $key=>$kol) {
							$cek_hidden = strpos($kol['Komen'], 'hidden');
							$cek_primary = strpos($kol['Komen'], 'primary');
							$cek_fk = strpos($kol['Komen'], 'fk');
							$cek_gambar = strpos($kol['Komen'], 'gambar');
							
							$hidden = $cek_primary !== false ? "hidden" : null;
							
							$kolom_asli = $kol['Kolom'];
							$kolom = ucwords_kolom_table($kolom_asli);
							$kolom2 = alias_kolom_fk(strtolower($kolom_asli), $cek_primary);
							
							if($i==1 || $i%8 == 1) {
								echo "<div class='col-lg-9'>";										
							}
							
							if($cek_fk !== false) {
								$q = multiple_query_form_update($nama_table_kecil);
								
								$sql = mysql_query($q[$kol['Kolom']]);
					?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"><label <?php echo $hidden; ?>><?php echo $kolom2; ?></label></div>
										<div class="col-md-5"><label><?php echo $kode_pengisian; ?></label></div>										
										<div class="col-md-5">
											<input type='hidden' name='<?php echo $kolom_asli; ?>' value='<?php echo $kode_pengisian; ?>'>
										</div>
									</div>
								</div>
					<?php
							}
							else {
								if($cek_primary !== false) {
									echo "<input type='hidden' name='$kolom_asli' value='$kolom_asli'/>";
									$ketemu_hidden++;
								}
								else if($cek_hidden !== false) {
									echo "<input type='hidden' name='$kolom_asli' value=''/>";
									$ketemu_hidden++;
								}
								else {
									$kolom = label_khusus($kolom_asli);
									
									
					?>
									<div class="form-group">
										<div class="row">
											<div class="col-md-4">
												<label>
													<?php echo $kolom; ?>
												</label>
											</div>
											<div class="col-md-5">
												<?php if($kol['Tipe'] == 'date') { ?>
													<input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="<?php echo $kolom_asli; ?>"  />
													<!--
													<input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="<?php echo $kolom_asli; ?>" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
													-->
												<?php 
													} else if($cek_gambar !== false) { 
														$i_gambar_dinamis++;
												?>
													<input type="file" class="form-control" id='imgInp' name="<?php echo $kolom_asli; ?>" value="<?php echo $row[$kolom_asli]; ?>" />
													<img id="blah" src="#" alt="your image" style='width:150px; height:150px;' />
												<?php 
													} 
													else {
														if(
															$kol['Tipe'] == 'int' || 
															$kol['Tipe'] == 'float' || 
															$kol['Tipe'] == 'double'
														) {
												?>
															<input type="text" onKeyPress="return isNumberKey(event)" class="form-control" name="<?php echo $kolom_asli; ?>" data-rule-required="true" />
												<?php 
														} else if($kol['Tipe'] == 'enum') { 
															preg_match("/^enum\(\'(.*)\'\)$/", $kol['Nilai_Kolom'], $matches);
															$enum = explode("','", $matches[1]);
															
															echo "<select class='form-control' name='$kolom_asli'>";
															foreach($enum as $enum_val) {
																echo "<option value='$enum_val'>$enum_val</option>";
															}
															echo "</select>";
												
														} else { 
												?>
															<input type="text" class="form-control" name="<?php echo $kolom_asli; ?>" data-rule-required="true" />
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
						<div class="col-md-4"></div>
						<div class="col-md-8">
							<button type="submit" name="submit" id="submit" value="tambah" class="btn btn-large btn-success">Simpan</button>
							
						</div>
					</div>
			</form>
		</div>
	</div>
</div>





<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
	var datepicker_class = document.getElementsByClassName('datepicker');
	
	var picker = new Pikaday({
		field: datepicker_class,
		firstDay: 1,
		minDate: new Date(1960, 0, 1),
		maxDate: new Date(2500, 12, 31),
		yearRange: [1960, 2500],
		format: 'DD/MM/YYYY'
	});
	
	
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
