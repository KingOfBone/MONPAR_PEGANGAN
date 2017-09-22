	<?php 	
		function menu_sa() {  
			$arg = func_get_args();
			$username = $arg[0];
	?>
      <ul>
        <li><a class="text-right closeclick" href="#">close &times;</a></li>
        <li>
            <div class="imgprofile text-center">
            <?php
				$sqluserImg = mysql_query("SELECT * FROM tabel_users WHERE username ='$username'") or die (mysql_error());
				$rowImg = mysql_fetch_array($sqluserImg);
            ?>

                <img src="<?php echo $rowImg["images"] == "" ? "images/foto/no-images.png" : "images/foto/".$rowImg["images"] ?>" class="img-circle img-responsive center-block"  />
                <br /><strong><?php echo $rowImg["nama_lengkap"];?></strong>
            </div>
        </li>
		<?php } function menu_beranda() { ?>
        <li>
            <a href="?dashboard"><i class="fa fa-dashboard fa-2x"></i> Beranda</a>
		</li>
		<?php } function menu_data_master() { ?>
		<li>
			<a href="#"><i class="fa fa-building fa-2x"></i> Data Master<span class="fa arrow"></span></a>
			<ul >
				<li><a href="#" class="back">Main Menu</a></li>
				<li class="nav-label"><strong>Input Data Monitoring</strong></li>
				<li>
					<a href="?datamaster_lihat=Merk"><i class="fa fa-building fa-2x"></i> Merk</a>
				</li>
				<li>
					<a href="?datamaster_lihat=Jenis_Api"><i class="fa fa-building fa-2x"></i> Jenis Api</a>
				</li>				
			</ul>
		</li>
		<?php } function menu_apar() { ?>
		<li>
			<a href="?apar_lihat"><i class="fa fa-refresh fa-2x"></i> APAR</a>
		</li>
		<?php } function menu_apar_unit() { ?>
		<li>
			<a href="?apar_unit_cari"><i class="fa fa-money fa-2x"></i> APAR Unit</a>
		</li>
		<?php } function menu_pengisian() { ?>
		<li>
			<a href="?pengisian_lihat"><i class="fa fa-money fa-2x"></i> Pengisian</a>
		</li>
		<?php } function menu_pemeliharaan() { ?>
		<li>
			<a href="?pemeliharaan_lihat"><i class="fa fa-money fa-2x"></i> Pemeliharaan</a>
		</li>
		<?php } function menu_pemakaian() { ?>
		<li>
			<a href="?pemakaian_lihat"><i class="fa fa-sign-out fa-2x"></i>Pemakaian</a>
		</li>
		<?php } function menu_laporan() { ?>
		<li>
			<a href="#"><i class="fa fa-file fa-2x"></i> Laporan</a>
			<ul >
				<li><a href="#" class="back">Main Menu</a></li>
				<li class="nav-label"><strong>Laporan</strong></li>
				<li>
					<a href="?laporan_lihat=apar"><i class="fa fa-file fa-2x"></i> Apar</a>
				</li>
				<li>
					<a href="?laporan_lihat=pengisian"><i class="fa fa-file fa-2x"></i> Pengisian</a>
				</li>
				<li>
					<a href="?laporan_lihat=pemakaian"><i class="fa fa-file fa-2x"></i> Pemakaian</a>
				</li>				
			</ul>
		</li>
		<?php } ?>
      </ul>
