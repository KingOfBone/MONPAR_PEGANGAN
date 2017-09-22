<?php
	//echo "nama_table = $nama_table";
	$kolom_table = information_schema($nama_table);

	$pk = ambil_pk($nama_table);
	
	$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table, $_POST);
	//var_dump($sql);
	$sql = mysql_query($sql);

?>

<div class="panel-body">
	<div class="table-responsive">
		<br />
		<table class="table table-striped table-bordered table-hover" id="datatabel">
			<thead>
				<tr>
					<th width="4%">No</th>
					<?php
						tampil_kolom_table($kolom_table);
					?>
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
						
						
					</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>