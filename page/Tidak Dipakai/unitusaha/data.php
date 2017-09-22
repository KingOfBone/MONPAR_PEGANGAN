<?php
$key     = ($_POST['keyword']) ? $_POST['keyword'] : $_GET['keyword'];
if (! $key==0){ $q = " CONCAT(nama_anggota,' (', nip,')') LIKE '%$key%' AND"; }

$sql = mysql_query("SELECT * FROM tabel_unitusaha ORDER BY id_unitusaha DESC") or die (mysql_error());
/*
$sqljml = mysql_query("SELECT sum(jumlah) as jml FROM tabel_simpanan JOIN tabel_anggota
ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE $q tabel_simpanan.jenis='tarik' 
ORDER BY tabel_simpanan.kode_simpanan DESC") or die (mysql_error());
*/

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

<!-- jquery paging -->
<link rel="stylesheet" type="text/css" href="assets/paging/stylepaging.css" />  
<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data unit usaha</h2>
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
                                     <div class="alert alert-success" id="alertupload">Data berhasil Ditambah,  
                                     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                     </div>
                                    <?php } ?>
                </div>
                <div class="col-md-2">
                    <a href="index.php?tambah-unitusaha" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table data unit usaha</div>
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
                                    <div class="col-md-4"></div>                                    
                                    <!-- <div class="col-md-4">
                                        <p>Jumlah : 
                                        <?php 
                                        /*
                                        $rowjml     = mysql_fetch_array($sqljml);
                                        echo 'Rp. ' . number_format( $rowjml["jml"], 0 , '' , '.' );
                                        */
                                        ?></p>
                                    </div>  -->                                  
                                    <div class="col-md-5" style="padding: 0;">
                                    </div>
                                    
                                </div>
                                <br />
                                <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sql)>20){ echo "paginated"; }else{}?>">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                                            <th width="20%">Unit usaha</th>
                      						<th width="8%">Tahun</th>
                      						<th width="15%">Penanggung Jawab</th>
                                            <th width="15%">Modal</th>
                                            <th width="15%">Omset</th>
                                            <th width="15%">Keuntungan</th>
                                           	<th width="15%" class="text-center">Aksi</th>
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(mysql_num_rows($sql) > 0){
                            				$no=1;
                                            while($row=mysql_fetch_array($sql))
                            				{
                            				?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                            						<td><?php echo $row['unitusaha'];?></td>
                                                    <td><?php echo $row['tahun'];?></td>
                                                    <td><?php echo $row['pngng_jwb'];?></td>
                                                    <td><?php echo "Rp ".number_format($row['modal'],0,'.','.'); ?></td>
                                                    <td><?php echo "Rp ".number_format($row['omset'],0,'.','.'); ?></td>
                                                    <td><?php 
                                                    $oms = $row['omset'];
                                                    $mod = $row['modal'];
                                                    $hit = $oms-$mod;
                                                    echo "Rp ".number_format($hit,0,'.','.'); ?></td>
                                                    <td class="text-center">
                                                        <a href="index.php?update-unitusaha=<?php echo $row["id_unitusaha"]?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="#" id="delete-unitusaha=<?php echo $row["id_unitusaha"]?>" class="delete"> 
                                                            <i class="fa fa-trash-o fa-2x"></i>
                                                            </a>
                                                    </td>
                            					</tr>
                            				<?php $no++; } } else { ?>
                                                <tr><td colspan="8" class="text-center"><i>Tabel data kosong</i></td></tr>
                                            <?php } ?>
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
<?php /* paging */ ?>    
<script type="text/javascript" src="assets/paging/scriptpaging.js"></script>
<!-- confirm dell -->

<script src="assets/confirmdell/js/script.js"></script>