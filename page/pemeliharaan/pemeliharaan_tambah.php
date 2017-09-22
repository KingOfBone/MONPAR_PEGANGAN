<?php
	
	
	$kolom_table = information_schema($nama_table);
	
	//var_dump($kolom_table);
	
	$pk = ambil_pk($nama_table);
	$id = $_GET['id'];
	
	$table_array = ['Apar', 'Lokasi', 'Pemeliharaan'];
	
	if(isset($_POST["submit"])) {
		$FILES = in_array($nama_table, $table_array) ? $_FILES : null;
		
		if($_POST["submit"] == 'tambah') {
			unset($_POST["submit"]);
			insert($nama_table, "?".$nama_table_kecil."_tambah&&id=$id", $_POST, $kolom_table, $FILES);		
		}
		else if($_POST["submit"] == 'ubah') {
			unset($_POST["submit"]);
			$kode_pemeliharaan = $_POST['kode_pemeliharaan'];
			
			update($nama_table_kecil, $kode_pemeliharaan, $pk, "?".$nama_table_kecil."_tambah&&id=$id", $_POST, $kolom_table, $FILES);
			
		}
		
	}
	
	$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table, $id);
	$sql = mysql_query($sql);
	
	/* 
	$kolom_table = information_schema($nama_table);
	
	$pk = ambil_pk($nama_table);
	$id = $_GET['id'];
	
	if(isset($_GET['input_delete']))
		delete($nama_table, $pk, $_GET['id']);
	
	$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;;
	
	$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table);
	$sql = mysql_query($sql); */
	
?>

<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data <?php echo ucwords_kolom_table($nama_table); ?></h2>
						<hr />
                    </div>
                </div>
                <!-- /. ROW  -->
           <div class="row">
                <div class="col-md-10">
                    <?php if(isset($_GET["sukseshapus"])){?>
						 <div class="alert alert-success">Data Berhasil Di Hapus...
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
						 </div>
						 <?php }else if(isset($_GET["suksesedit"])){ ?>
						 <div class="alert alert-success">Data Berhasil Di Ubah...
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
						 </div>
						 <?php }else if(isset($_GET["suksesbalaskomen"])){ ?>
						 <div class="alert alert-success">Komentar Berhasil Di balas...
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
						 </div>
						 <?php }else if(isset($_GET["suksestambah"])){?>
						 <div class="alert alert-success" id="alertupload">Data  berhasil Ditambah,
						 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
						 </div>
						<?php } ?>
                </div>
                <div class="col-md-3">
                    <a href="?pengisian_lihat" class="btn btn-large btn-warning">Kembali</a>
                    <br /><br />
                </div>
				
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table <?php echo ucwords_kolom_table($nama_table); ?>
                        </div>
						
						<?php
							$sql2 = "
								SELECT 
									penempatan, no_apar, merk.id_merk 'merk',
									jenis_api, berat, tgl_pengisian_terakhir,
									tgl_pengisian_kembali, catatan, 
									concat('Lantai ', lantai, ' / No. ', no_apar, ' / ', penempatan) 'kode_apar'
								FROM apar
								inner join pengisian
									on pengisian.kode_apar=apar.id_apar
								inner join merk
									on merk.id_merk=apar.id_merk
								inner join jenis_api
									on jenis_api.id_jenis_api=jenis_api.id_jenis_api
							";
							$sql2 = mysql_query($sql2);
							$row2 = mysql_fetch_array($sql2);

							$depan = ['Apar', 'Penempatan', 'No Apar', 'Merk', 'Jenis Api', 'Berat', 'Tgl Pengisian Terakhir', 'Tgl Pengisian Kembali', 'Catatan'];
							$belakang = ['kode_apar', 'penempatan', 'no_apar', 'merk', 'jenis_api', 'berat', 'tgl_pengisian_terakhir', 'tgl_pengisian_kembali', 'catatan'];
						
							foreach($depan as $key=>$dpn) {
								if($belakang[$key] == 'tgl_pengisian_terakhir' || $belakang[$key] == 'tgl_pengisian_kembali')
									$value = date('d/m/Y', strtotime($row2[$belakang[$key]]));
								else
									$value = $row2[$belakang[$key]];
								
								echo "
									<div class='col-lg-6'>
										<div class='form-group'>
											<div class='row'>
												<div class='col-md-4'><label>$dpn</label></div>
												<div class='col-md-5'><label>$value</label></div>
												
											</div>
										</div>
									</div>
								";
							}
						?>
						
						
                        <div class="panel-body">
                            <div class="table-responsive">
                                <br />
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="4%">No</th>
                                            <?php
												tampil_kolom_table($kolom_table);
											?>
                    						<th width="10%">Aksi</th>
                               			</tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no=1;
										while($row=mysql_fetch_array($sql)) {
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<?php
												$i=0;
												foreach($kolom_table as $kol) {
													$cek_kolom = strpos($kol['Komen'], "penting");
													
													if($cek_kolom !== false) {
														$cek_fk = strpos($kol['Komen'], "fk");
														
														if($cek_fk !== false) {
															$explode = explode('___', $row['fk']);
															$kolom_explode = $explode[$i];
															
															$i++;
														}
														
														$kolom_explode = isset($kolom_explode) ? $kolom_explode : $kol['Kolom'];
														
														echo '<td>'. tampil_kolom_isitable('lihat', $kolom_explode, $kol['Tipe'], $nama_table, $row, $cek_fk) .'</td>';																
														
														$kolom_explode = null;
													}
												}
											?>
											
											<td class="center">
												<a href="#" data-id="<?php echo $row['kode_pemeliharaan']; ?>" data-nama_table="<?php echo $nama_table; ?>" data-objek="apar" role="button" data-toggle="modal" class='ubah' type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
												
												<a href="#" id="mau_delete=<?php echo "$nama_table_kecil,$pk,$row[id],".$nama_table_kecil."_tambah&&id=$id"; ?>" class="delete">
													<i class="fa fa-trash-o fa-2x"></i>
												</a>
											</td>
										</tr>
									<?php 	
											$no++;
										} 
									?>										
										<tr>
											<td colspan='7' style="text-align:center;">
												<a href="#" class="btn btn-sm btn-info tambah" data-id="<?php echo $id; ?>" data-nama_table="<?php echo $nama_table; ?>" data-objek="apar" role="button" data-toggle="modal">
													<i class="glyphicon glyphicon-plus"></i>
													Tambah Data Pemeliharaan
												</a>
											</td>
											<td style="display:none;"></td>
											<td style="display:none;"></td>
											<td style="display:none;"></td>
											<td style="display:none;"></td>
											<td style="display:none;"></td>
											<td style="display:none;"></td>											
										</tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--End Advanced Tables -->
                </div>
            </div>

        </div>
       </div>
    </div>
<script>
	$(document).on('click','.tambah',function(e) {
		e.preventDefault();
		$("#myModal1").modal('show');
		
		$.post('page/<?php echo $nama_table_kecil; ?>/<?php echo $nama_table_kecil; ?>_modal_tambah.php',
			{
				id:$(this).attr('data-id'), 
				nama_table:$(this).attr('data-nama_table'),
				objek:$(this).attr('data-objek')
			},
			function(html) {
				$(".modal-body").html(html);
			}
		);
	});
	
	$(document).on('click','.ubah',function(e) {
		e.preventDefault();
		$("#myModal2").modal('show');
		
		$.post('page/<?php echo $nama_table_kecil; ?>/<?php echo $nama_table_kecil; ?>_modal_ubah.php',
			{
				id:$(this).attr('data-id'), 
				nama_table:$(this).attr('data-nama_table'),
				objek:$(this).attr('data-objek')
			},
			function(html) {
				$("#modal-body2").html(html);
			}
		);
	});
</script>


<div id="myModal1" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<!-- dialog body -->
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah <?php echo $nama_table; ?></h4>
			</div>
			<div class="modal-body"></div>
			
			<!-- dialog buttons -->
			<div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div id="myModal2" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<!-- dialog body -->
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Ubah <?php echo $nama_table; ?></h4>
			</div>
			<div id="modal-body2"></div>
			
			<!-- dialog buttons -->
			<div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
			</div>
		</div>
	</div>
</div>




<!-- confirm dell -->
<script src="assets/confirmdell/js/script.js"></script>

<!-- DATA TABLE SCRIPTS -->
    <script src="assets/datatables/jquery.dataTables.js"></script>
    <script src="assets/datatables/dataTables.bootstrap.js"></script>
    <script>
    $(document).ready( function () {
      $('#datatabel').dataTable( {
        "paging":   true,
        "ordering": false,
        "bInfo": false,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
    } );

    </script>
