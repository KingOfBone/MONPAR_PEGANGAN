<?php
	
	
	$kolom_table = information_schema($nama_table);
	
	$pk = ambil_pk($nama_table);
	$id = $_GET['idp'];
	
	$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table, $id);
	$sql = mysql_query($sql);
	
?>

		<div id="page-inner">
			<div class="row">
				<div class="col-md-12">
					<h2>Data <?php echo ucwords_kolom_table($nama_table); ?></h2>
					<hr />
				</div>
			</div>
			<!-- /. ROW  -->
			<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table <?php echo ucwords_kolom_table($nama_table); ?>
                        </div>
						
						<?php
							$id = $_GET['idp'];
							
							$sql2 = "
								SELECT 
									penempatan, no_apar, merk.id_merk 'merk',
									jenis_api, berat, tgl_pengisian_terakhir,
									tgl_pengisian_kembali, catatan
								FROM apar
								inner join pengisian
									on pengisian.kode_apar=apar.id_apar
								inner join merk
									on merk.id_merk=apar.id_merk
								inner join jenis_api
									on jenis_api.id_jenis_api=jenis_api.id_jenis_api
								where kode_pengisian = $id
							";
							$sql2 = mysql_query($sql2);
							$row2 = mysql_fetch_array($sql2);

							$depan = ['Penempatan', 'No Apar', 'Merk', 'Jenis Api', 'Berat', 'Tgl Pengisian Terakhir', 'Tgl Pengisian Kembali', 'Catatan'];
							$belakang = ['penempatan', 'no_apar', 'merk', 'jenis_api', 'berat', 'tgl_pengisian_terakhir', 'tgl_pengisian_kembali', 'catatan'];
						
							foreach($depan as $key=>$dpn) {
								echo "
									<div class='col-lg-6'>
										<div class='form-group'>
											<div class='row'>
												<div class='col-md-4'><label>$dpn</label></div>
												<div class='col-md-4'><label>".$row2[$belakang[$key]]."</label></div>
												
											</div>
										</div>
									</div>
								";
							}
						?>
						
						
                        <div class="panel-body">
                            <div class="table-responsive">
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>
                                            <th width="4%">No</th>
                                            <?php
												$nama_table = 'Pemeliharaan';
												$kolom_table = information_schema($nama_table);
												
												tampil_kolom_table($kolom_table);
											?>
                               			</tr>
                                    </thead>
                                    <tbody>
                                    <?php
										
										$pk = ambil_pk($nama_table);
										
										//echo "nama_table=$nama_table";
										
										$tgl = $_SESSION['tgl'];
										//var_dump($tgl);
										
										$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table, $tgl);
										$sql = mysql_query($sql);
										
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
											
										</tr>
									<?php 	
											$no++;
										} 
									?>										
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--End Advanced Tables -->
                </div>
            </div>

        </div>