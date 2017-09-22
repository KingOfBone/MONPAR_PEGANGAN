<?php
$key     = ($_POST['keyword']) ? $_POST['keyword'] : $_GET['keyword'];
if (! $key==0){ $q = "and CONCAT(nama_anggota,' (', nip,')') LIKE '%$key%'"; }

$sql = mysql_query("SELECT tabel_angsuran.*, tabel_anggota.nama_anggota, tabel_anggota.nip 
FROM tabel_angsuran JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota where status_angsuran='Lunas' $q") or die (mysql_error());

$sqlutang = mysql_query("SELECT tabel_angsuran.*, tabel_anggota.nama_anggota, tabel_anggota.nip 
FROM tabel_angsuran JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota where status_angsuran='Belum Lunas' $q") or die (mysql_error());
?>
<!-- jquery data tabel -->
<link href="assets/datatables/dataTables.bootstrap.css" rel="stylesheet" />
<!-- tabs jqueryui -->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
  <script>
  
  
  $(function() {
    $( "#tabs" ).tabs();
    $( "#skills1" ).autocomplete({
      source: 'assets/Actextbox/search.php'
    });
    $( "#skills2" ).autocomplete({
      source: 'assets/Actextbox/search.php'
    });
  });
  </script>

<!-- Pick Day (datepicker) -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />

<!-- jquery paging -->
<link rel="stylesheet" type="text/css" href="assets/paging/stylepaging.css" />
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data angsuran (manual)</h2>
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
                 <!--   <a href="?tambahangsuran" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>  -->
                    <br /><br />
                </div>
           </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container1">
                    <div id="tabs">
                        <ul>
                            <li><a href="#Lunas">Lunas</a></li>
                            <li><a href="#BelumLunas">Belum Lunas</a></li>
                        </ul>
            <div class="panel-container">
            <!-- view 1-->
                <div id="Lunas">
                    <div class="panel-body">
                        <!-- page/setorsimpanan/bank/cetaksetor.php 
                            <form name="bulk_action_form" id="formsetor" method="post" action="" >-->
                            <div class="table-responsive">
                              <div class="row">
                                    <div class="col-md-4">
                                        <form method="POST" action="">
                                        <div class="input-group custom-search-form">
                                            <input id="skills1" class="form-control" name="keyword" value="<?php if(isset($_POST["cari"])){ echo $_POST["keyword"]; }?>" />
                                              <span style="font-size:14px;" class="input-group-btn">
                                              <button class="btn btn-default" type="submit" name="cari">
                                              <span  class="glyphicon glyphicon-search"></span>
                                             </button>
                                             </span>
                                        </div><!-- /input-group -->
                                        </form>
                                    </div>
                                    <div class="col-md-4"></div>                                    
                                    <div class="col-md-4"></div>         
                                </div>
                                    <br />
                                <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sql)>20){ echo "paginated"; }else{}?>">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                  						    <th width="17%">Nama Anggota</th>
                      						<th width="10%">NIP</th>
                      						<th width="13%">Tangal angsuran</th>
                                            <th width="15%">Nilai Pinjaman</th>
                                            <th width="15%">Bunga Pinjaman Perbulan</th>
                      						<th width="15%">Nilai Angsuran</th>
                                            <th width="8%">Angsuran ke</th>
                      						<th width="15%">Aksi</th>
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
                     					            <td><?php echo $row['nama_anggota'];?></td>
                            						<td><?php echo $row['nip'];?></td>
                                                    <td><?php echo tglindonesia($row['tgl_angsuran']);?></td>
                                                    <td><?php $sqlpinjaman = mysql_query("select * from tabel_pinjaman where kode_pinjaman = '".$row['no_pinjaman']."'");
                                                              $pinjaman = mysql_fetch_array($sqlpinjaman);
                                                              echo "Rp ". number_format($pinjaman['jumlah_pinjaman'], 0 , '' , '.' ); ?></td>
                                                    <td><?php $bunga = $pinjaman['jumlah_pinjaman']*($pinjaman['bunga']/100);
                                                              echo "Rp ". number_format($bunga, 0 , '' , '.' );?></td>
                                                    <td><?php echo "Rp ". number_format($row['angsuran_bayar'], 0 , '' , '.' );?></td>
                                                    <td><?php echo $row['angsuran_ke'];?></td>
                                                    <td class="center" >
                                                        <a style="color: #428BCA !important;" href="?update-angsuran=<?php echo $row["kode_angsuran"]?>"  type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a style="color: #428BCA !important;" href="#" id="delete-angsuran=<?php echo $row["kode_angsuran"]?>" class="delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                                    </td>
                            					</tr>
                            				<?php $no++; } } else { ?>
                                                <tr><td colspan="10" class="text-center"><i>Tabel data angsuran kosong</i></td></tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- </form> -->
                        </div>
                </div>
                <!-- view 2-->
                <div id="BelumLunas">
                    <div class="panel-body">
                            <!-- <form name="bulk_action_form" id="formkonfirm" method="post" action="" > -->
                            <div class="table-responsive">
                              <div class="row">
                                    <div class="col-md-4">
                                        <form method="POST" action="">
                                        <div class="input-group custom-search-form">
                                            <input id="skills2" class="form-control" name="keyword" value="<?php if(isset($_POST["cari"])){ echo $_POST["keyword"]; }?>" />
                                              <span style="font-size:14px;" class="input-group-btn">
                                              <button class="btn btn-default" type="submit" name="cari">
                                              <span  class="glyphicon glyphicon-search"></span>
                                             </button>
                                             </span>
                                        </div><!-- /input-group -->
                                        </form>
                                    </div>
                                    <div class="col-md-4"></div>                                    
                                    <div class="col-md-4"></div>         
                                </div>
                                    <br />
                                <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqlutang)>20){ echo "paginated"; }else{}?>">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                  						    <th width="17%">Nama Anggota</th>
                      						<th width="17%">NIP</th>
                      						<th width="15%">Tangal angsuran</th>
                                            <th width="15%">Nilai Pinjaman</th>
                                            <th width="15%">Bunga Pinjaman Perbulan</th>
                      						<th width="15%">Nilai Angsuran</th>
                                              <th width="20%">Angsuran ke</th>
                                     <!--       <th width="20%">Keterangan</th>  -->
                      						<th width="15%">Action</th>
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(mysql_num_rows($sqlutang) > 0){
                            				$no=1;
                                            while($row=mysql_fetch_array($sqlutang))
                            				{
                            				?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                     					            <td><?php echo $row['nama_anggota'];?></td>
                            						<td><?php echo $row['nip'];?></td>
                                                    <td><?php echo tglindonesia($row['tgl_angsuran']);?></td>
                                                    <td><?php $sqlpinjaman = mysql_query("select * from tabel_pinjaman where kode_pinjaman = '".$row['no_pinjaman']."'");
                                                              $pinjaman = mysql_fetch_array($sqlpinjaman);
                                                              echo "Rp ". number_format($pinjaman['jumlah_pinjaman'], 0 , '' , '.' ); ?></td>
                                                    <td><?php $bunga = $pinjaman['jumlah_pinjaman']*($pinjaman['bunga']/100);
                                                              echo "Rp ". number_format($bunga, 0 , '' , '.' );?></td>
                                                    <td><?php echo "Rp ". number_format($row['angsuran_bayar'], 0 , '' , '.' );?></td>
                                                    <td><?php echo $row['angsuran_ke'];?></td>
                                             <!--       <td><?php echo $row['ket_angsuran'];?></td>  -->
                                                    <td class="center">
                                                        <a href="?update-angsuran=<?php echo $row["kode_angsuran"]?>"  type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="#" id="delete-angsuran=<?php echo $row["kode_angsuran"]?>" class="delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                                    </td>
                            					</tr>
                            				<?php $no++; } } else { ?>
                                                <tr><td colspan="10" class="text-center"><i>Tabel data angsuran kosong</i></td></tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- </form>-->
                        </div>
                </div>
                
            </div>
        </div>
        </div>
                </div>
            </div>
        </div>
       </div>     
    </div>

<!-- DATA TABLE SCRIPTS -->
    <script src="assets/dataTables/jquery.dataTables.js"></script>
    <script src="assets/dataTables/dataTables.bootstrap.js"></script>
    <script>
    $(document).ready( function () {
      $('#example').dataTable( {
        "paging":   false,
        "ordering": false,
        "bInfo": false,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
    } );
    $(document).ready( function () {
      $('#example2').dataTable( {
        "paging":   false,
        "ordering": false,
        "bInfo": false,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
    } );
    </script>

<?php /* paging */ ?>    
<script type="text/javascript" src="assets/paging/scriptpaging.js"></script>