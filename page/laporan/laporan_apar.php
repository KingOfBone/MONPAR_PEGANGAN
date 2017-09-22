<?php
	//echo "nama_table = $nama_table";
	$kolom_table = information_schema($nama_table);

	$pk = ambil_pk($nama_table);
	
	//$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table, $_POST);
	
	$jenisuser = $_SESSION['jenisuser'];
	$kode_kantor = $_SESSION["kode$jenisuser"];
	
	$klausa = '';
	$kodegi = '';
	
	$kodegi = !empty($_POST['kodegi']) && $_POST['kodegi'] != 'semua' ? " = $_POST[kodegi]" : '';
	$kodegi = !empty($_GET['kodegi']) && $_GET['kodegi'] != 'semua' ? " = $_GET[kodegi]" : '';
	
	$kodeapp = !empty($_POST['kodeapp']) && $_POST['kodeapp'] != 'semua' ? " = $_POST[kodeapp]" : '';
	$kodeapp = !empty($_GET['kodeapp']) && $_GET['kodeapp'] != 'semua' ? " = $_GET[kodeapp]" : '';
	
	
	$innerjoin = '';
	$klausa = "where";
	
	if($jenisuser == 'ki') {
		$innerjoin = "
			inner join master.gi 
				on master.gi.kodegi=apar.kode_kantor				
		";
		
		$klausa .= "
			kantor = 'app' AND
			kode_kantor $kodeapp OR
			kantor = 'gi' AND
			kode_kantor $kodegi
		";
	}
	$sql = "
		select 
			$nama_table.*, 
			$pk 'id', 
			concat(merk, '___', jenis_api) 'fk' from $nama_table 
		inner join merk 
			on $nama_table.id_merk=merk.id_merk 
		inner join jenis_api 
			on $nama_table.id_jenis_api=jenis_api.id_jenis_api
		$innerjoin
		$klausa 
		order by no_apar asc 
	";
	
	//echo $sql;
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