<?php
$key     = ($_POST['keyword']) ? $_POST['keyword'] : $_GET['keyword'];
if (! $key==0){ $q = "and CONCAT(nama_anggota,' (', nip,')') LIKE '%$key%'"; }

//angsuran 3 bln terakhir
//$sqlBlnTr = mysql_query("SELECT distinct(a.no_pinjaman) FROM `tabel_angsuran` a, `tabel_pinjaman` b where a.no_pinjaman = b.kode_pinjaman and b.jangka_waktu-3 <= a.angsuran_ke AND b.status_pinjaman='lunas' order by a.angsuran_ke desc");                    
$sqlBlnTr = mysql_query("SELECT distinct(a.no_pinjaman) FROM `tabel_angsuran` a, `tabel_pinjaman` b where a.no_pinjaman = b.kode_pinjaman and b.jangka_waktu-3 <= a.angsuran_ke AND b.status_pinjaman='belum lunas' order by a.angsuran_ke desc");

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
                        <h2>Data angsuran 3 Bulan Terakhir </h2>
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
                
           </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqlBlnTr)>20){ echo "paginated"; }else{}?>">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                  						    <th width="17%">Nama Anggota</th>
                      						<th width="10%">NIP</th>
                                            <th width="15%">Nilai Pinjaman</th>
                                            <th width="15%">Bunga Pinjaman Perbulan</th>
                      						<th width="15%">Nilai Angsuran</th>
                                            <th width="5%">Angsuran ke</th>
                                            <th width="5%">Total Angsuran</th>
                      						
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(mysql_num_rows($sqlBlnTr) > 0){
                            				$no=1;
                                            while($row=mysql_fetch_array($sqlBlnTr))
                            				{
                            				    
                                            $sqltotal = mysql_query("SELECT
                                                tabel_pinjaman.no_anggota,
                                                tabel_pinjaman.tgl_pinjaman,
                                                tabel_pinjaman.jumlah_pinjaman,
                                                tabel_pinjaman.bunga,
                                                tabel_angsuran.bunga_angs,
                                                tabel_angsuran.angsuran_bayar,
                                                tabel_angsuran.angsuran_ke,
                                                tabel_pinjaman.jangka_waktu,
                                                tabel_anggota.nama_anggota,
                                                tabel_anggota.nip
                                                FROM
                                                tabel_pinjaman
                                                INNER JOIN tabel_angsuran ON tabel_pinjaman.kode_pinjaman = tabel_angsuran.no_pinjaman
                                                INNER JOIN tabel_anggota ON tabel_pinjaman.no_anggota = tabel_anggota.no_anggota
                                            
                                            WHERE tabel_pinjaman.kode_pinjaman=".$row["no_pinjaman"]." order by tabel_angsuran.angsuran_ke desc");
                                            
                                            $rowtotal = mysql_fetch_array($sqltotal);
                            				?>
                            				<tr>
                                                    <td><?php echo $no; ?></td>
                     					            <td><?php echo $rowtotal['nama_anggota'];?></td>
                            						<td><?php echo $rowtotal['nip'];?></td>
                                                    <td><?php echo "Rp ". number_format($rowtotal['jumlah_pinjaman'], 0 , '' , '.' ); ?></td>
                                                    <td><?php $bunga = $rowtotal['jumlah_pinjaman']*($rowtotal['bunga']/100);
                                                              echo "Rp ". number_format($bunga, 0 , '' , '.' );?></td>
                                                    <td><?php echo "Rp ". number_format($rowtotal['angsuran_bayar'], 0 , '' , '.' );?></td>
                                                    <td><?php echo $rowtotal['angsuran_ke'];?></td>
                                                    <td><?php echo $rowtotal['jangka_waktu'];?></td>
                                                    
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