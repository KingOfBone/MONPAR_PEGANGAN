<?php
$key  = ($_POST['bln']) ? $_POST['bln'] : $_GET['bln'];
if (! $key==0){ $q = "AND substr(tgl_angsuran, 1, 7) =  '$key' "; }
/*
echo $sqls = "SELECT tabel_angsuran.*, tabel_anggota.nama_anggota, tabel_anggota.nip 
FROM tabel_angsuran JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota WHERE 
status_angsuran='Belum Lunas' $q";
*/
$sql = mysql_query("SELECT tabel_angsuran.*, tabel_anggota.nama_anggota, tabel_anggota.nip 
FROM tabel_angsuran JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota WHERE 
status_angsuran='Belum Lunas' $q") or die (mysql_error());
?>
<!-- jquery data tabel -->
<link href="assets/datatables/dataTables.bootstrap.css" rel="stylesheet" />
<!-- tabs jqueryui 
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
  </script>-->

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
                        <h2>Tunggakan angsuran </h2>
                        <hr />  
                    </div>
                </div>
                <!-- /. ROW  -->
           <div class="row">
                <div class="col-md-8">
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
                <form name="angsuran" method="POST" action="">
                <div class="col-md-2">
                    <select name="bln" class="form-control">
                    <option value=""></option>
                        <?php 
                        $date = date("Y");
                        for($bln=1; $bln<=12; $bln++){ ?>
                            <option value="<?php echo $date."-".$bln; ?>" <?php //if($key == $date."-".$bln || $bln==date("m")){ echo "selected='selected'" ;  } ?>> <?php echo get_namabulan($bln)." - ".$date; ?></option>
                        <?php } ?>
                    </select>
                    <br /><br />
                </div>
                <div class="col-md-2">
                    <button name="submit" type="submit" class="btn btn-primary">Cari</button>
                </div>
                </form>
           </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container1">
                        <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sql)>20){ echo "paginated"; }else{}?>">
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