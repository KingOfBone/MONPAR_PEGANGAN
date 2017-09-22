
<?php
	$kolom_table = information_schema($nama_table);
	
	$table_array = ['Apar', 'Lokasi'];
	
	if(isset($_POST["submit"])){
		$FILES = in_array($nama_table, $table_array) ? $_FILES : null;
		
		
		insert($nama_table, "?".$nama_table_kecil."_tambah=$nama_table", $_POST, $kolom_table, $FILES);		
	}
?>



<link rel="stylesheet" href="script/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="script/dhtmlwindow_fol.js"></script>
<link rel="stylesheet" href="librari/stylesuggest.css" type="text/css" />

<!-- Pick Day -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<script type="text/javascript" src="page/gangguan/triger.js"></script>

<div id="wrapper">
    <!-- /. NAV SIDE  -->
   <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tambah <?php echo ucwords_kolom_table($nama_table); ?> </h2>
                </div>
            </div>
			<!-- /. ROW  -->
			<hr />
			
			
			<?php if(!empty($_GET["pesan"]) && $_GET["pesan"] == 'berhasil'){?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success">Data berhasil ditambah
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
						</div>
					</div>
				</div>
            <?php } ?>
			
			
			<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Ubah <?php echo ucwords_kolom_table($nama_table); ?>
            </div>
            <div class="panel-body">
                <div class="row">
					<form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
						
							<?php
								$i = 1;
								$ketemu_hidden = 0;
								
								foreach($kolom_table as $key=>$kol) {
									$cek_primary = strpos($kol['Komen'], 'primary');
									$cek_fk = strpos($kol['Komen'], 'fk');
									$cek_gambar = strpos($kol['Komen'], 'gambar');
									
									$hidden = $cek_primary !== false ? "hidden" : null;
									
									$kolom = ucwords_kolom_table($kol['Kolom']);
									$kolom2 = strtolower($kol['Kolom']);
									
									if($i==1 || $i%10 == 1) {
										echo "<div class='col-lg-6'>";										
									}
									
									if($cek_fk !== false) {
										$q = multiple_query_form_update($nama_table_kecil);
										
										$sql = mysql_query($q[($key-1)]);
							?>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label <?php echo $hidden; ?>><?php echo $kolom; ?></label></div>
												<div class="col-md-5">
													<select name='<?php echo $kolom2; ?>' class="form-control">
														<?php
															while($datatemp = mysql_fetch_array($sql)) {
																echo "<option value='$datatemp[id]'>$datatemp[val]</option>";
															}
														?>
													</select>
												</div>
											</div>
										</div>
							<?php
									}
									else {
										if($cek_primary !== false) {
											echo "<input type='hidden' name='$kolom2' />";
											$ketemu_hidden++;
										}
										else {
											$kolom = $kol['Kolom'];				
											$kolom = label_khusus($kolom);
							?>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>
															<?php echo $kolom; ?>
														</label>
													</div>
													<div class="col-md-5">
														<?php if($kol['Tipe'] == 'date') { ?>
															<input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="<?php echo $kolom2; ?>"  />
															<!--
															<input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="<?php echo $kolom2; ?>" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
															-->
														<?php } else if($cek_gambar !== false) { ?>
															<input type="file" class="form-control" name="<?php echo $kolom2; ?>" value="<?php echo $row[$kol['Kolom']]; ?>" />															
														<?php 
															} 
															else {
																if(
																	$kol['Tipe'] == 'int' || 
																	$kol['Tipe'] == 'float' || 
																	$kol['Tipe'] == 'double'
																) {
														?>
																	<input type="text" onKeyPress="return isNumberKey(event)" class="form-control" name="<?php echo $kolom2; ?>" data-rule-required="true" />
														<?php } else { ?>
																	<input type="text" class="form-control" name="<?php echo $kolom2; ?>" data-rule-required="true" />
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
									
									if($i%10 == 0) {
										$i -= $ketemu_hidden;
										$ketemu_hidden = 0;
										
										if($i%10 == 0)
											echo "</div>";
									}
									
									$i++;
								}
							?>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-8">
									<button type="submit" name="submit" id="submit" value="submit" class="btn btn-large btn-success">Simpan</button>
									<a href="?<?php echo $nama_table_kecil; ?>_lihat" class="btn btn-large btn-warning">Kembali</a>
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

<!--datepicker pikaday-->
<!--
<script src="assets/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script>
    $('.mulai').datetimepicker({
		dayOfWeekStart : 1,
		lang:'en',
		disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
		startDate:	'2017/01/05'
	});

	$('#normal1').datetimepicker({
	dayOfWeekStart : 1,
	lang:'en',
	disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
	startDate:	'2017/01/05'
	});
</script>
-->






<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2500, 12, 31),
        yearRange: [1960, 2500],
        format: 'DD/MM/YYYY'
    });
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
    });
</script>
