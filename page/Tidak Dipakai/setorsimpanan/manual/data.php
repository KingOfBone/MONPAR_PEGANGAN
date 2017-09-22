<?php
include "librari/class_paging.php";

$p      = new Paging;
  $batas  = 100;
  $posisi = $p->cariPosisi($batas);
  if($_GET["keyword"]==""){
    $no=1;
  }else{
    $no=0 + $posisi ;  
  }
  
  
$key     = ($_POST['keyword']) ? $_POST['keyword'] : $_GET['keyword'];
if (! $key==0){ $q = " CONCAT(nama_anggota,' (', nip,')') LIKE '%$key%' AND"; } 

if($_GET["SetoranManual"]=="simpanan-pokok"){
    $jenissimpanan = "AND tabel_simpanan.jenis_simpanan='Simpanan Pokok'";   
}else if($_GET["SetoranManual"]=="simpanan-wajib"){
    $jenissimpanan = "AND tabel_simpanan.jenis_simpanan='Simpanan Wajib'";
}else if($_GET["SetoranManual"]=="simpanan-sukarela"){
    $jenissimpanan = "AND tabel_simpanan.jenis_simpanan='Simpanan Sukarela'";
}
    
$sql = mysql_query("SELECT tabel_simpanan.*, tabel_anggota.nama_anggota , tabel_anggota.nip FROM tabel_simpanan JOIN tabel_anggota
    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE $q  tabel_simpanan.jenis='setor' $jenissimpanan
    ORDER BY tabel_simpanan.kode_simpanan DESC limit $posisi,$batas") or die (mysql_error());
    
$sqljml = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah , tabel_simpanan.tgl_simpanan, tabel_simpanan.jenis_simpanan, tabel_anggota.nama_anggota , 
tabel_anggota.nip FROM tabel_simpanan JOIN tabel_anggota
    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE $q  tabel_simpanan.jenis='setor' 
    ORDER BY tabel_simpanan.kode_simpanan DESC limit $posisi,$batas") or die (mysql_error());

?>

<!-- autocomplete-->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#skills" ).autocomplete({
      source: 'assets/Actextbox/search.php'
    });
  });
  </script>

<!-- jquery paging 
<link rel="stylesheet" type="text/css" href="assets/paging/stylepaging.css" /> -->

    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data Setor Simpanan (Manual)</h2>
                        <hr />  
                    </div>
                </div>
                <!-- /. ROW  -->
           <div class="row">
                <div class="col-md-9">
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
                                     <div class="alert alert-success" id="alertupload">Data berhasil Ditambah,  
                                     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                     </div>
                                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <a href="?upload-setoran-excel" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Upload Excel</a>
                    <a href="?tambahSetoranManual" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table data setor Simpanan</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                              <div class="row">
                                    <div class="col-md-4">
                                        <form method="POST" action="">
                                        <div class="input-group custom-search-form">
                                            <input id="skills" class="form-control" name="keyword" value="<?php if(isset($_POST["cari"])){ echo $_POST["keyword"]; }?>" />
                                              <span class="input-group-btn">
                                              <button class="btn btn-default" type="submit" name="cari">
                                              <span class="glyphicon glyphicon-search"></span>
                                             </button>
                                             </span>
                                        </div><!-- /input-group -->
                                        </form>
                                    </div>
                                    <div class="col-md-5"></div>                                    
                                    <div class="col-md-3">
                                        <p>Jumlah : 
                                        <?php 
                                        $rowjml     = mysql_fetch_array($sqljml);
                                        echo 'Rp. ' . number_format( $rowjml["jumlah"], 0 , '' , '.' );
                                        ?></p>
                                    </div>                                    
                                    <div class="col-md-5" style="padding: 0;">
                                    </div>
                                </div>
                                    <br />
                                <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sql)>50){ echo "paginated"; }else{}?>">
                                    <thead>
                                        <tr class="text-right" > 
                                            <th width="2%">No</th>
                                            <th width="17%">Nama Anggota</th>
                                            <th width="13%">NIP</th>
                      						<th width="15%">Tanggal</th>
                      						<th width="18%">Jumlah</th>
                                            <th width="20%">Jenis Simpanan</th>
                      						<th width="15%">Aksi</th>
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                        
                                        if(mysql_num_rows($sql) > 0){
                            			//	$no=1;
                                            while($row=mysql_fetch_array($sql))
                            				{
                            				?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['nama_anggota'];?></td>
                                                    <td><?php echo $row['nip'];?></td>
                                                    <td><?php echo format_tgl($row['tgl_simpanan']);?></td>
                                                    <td class="text-right" ><?php echo number_format( $row['jumlah'], 0 , '' , '.' );?></td>
                                                    <td><?php echo $row['jenis_simpanan'];?></td>
                                                    <td class="text-center">
                                                        <a href="?update-SetoranManual=<?php echo $row["kode_simpanan"]?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="#" id="delete-SetoranManual=<?php echo $row["no_anggota"]?>" class="delete"> 
                                                            <i class="fa fa-trash-o fa-2x"></i>
                                                            </a>
                                                    </td>
                            					</tr>
                                                
                				    <?php $no++; } } else { ?>
                                            <tr><td colspan="7" class="text-center"><i>Tabel data setor simpanan manual kosong</i></td></tr>
                                    <?php }?>
                                    <tr class="Tabledetail">
                                                <td colspan="7" align="center">
                                            	<?php
                                            	 
                                                	$jmldata      = mysql_num_rows(mysql_query("SELECT tabel_simpanan.*, tabel_anggota.nama_anggota , tabel_anggota.nip FROM tabel_simpanan JOIN tabel_anggota
                                                                    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE $q  tabel_simpanan.jenis='setor' 
                                                                    ORDER BY tabel_simpanan.kode_simpanan DESC")); 
                                                    $jmlhalaman   = $p->jumlahHalaman($jmldata, $batas);
                                            		$linkHalaman  = $p->navHalaman($_GET[halaman], $jmlhalaman);
                                            	?>
                                            	<?php echo "Halaman : $linkHalaman<br>"; ?>	</td>
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
<!-- confirm dell -->
<script src="assets/confirmdell/js/script.js"></script>
<?php /* paging */ ?>    
<!-- <script type="text/javascript" src="assets/paging/scriptpaging.js"></script> -->