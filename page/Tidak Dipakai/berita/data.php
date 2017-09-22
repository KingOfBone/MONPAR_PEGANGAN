<?php
$key     = ($_POST['keyword']) ? $_POST['keyword'] : $_GET['keyword'];
if (! $key==0){ $q = "WHERE CONCAT(nama_anggota,' (', nip,')') LIKE '%$key%'"; }

$sql = mysql_query("SELECT * FROM tabel_berita $q ORDER BY id_berita DESC ") or die (mysql_error());  

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
                        <h2>Data berita</h2>
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
                <div class="col-md-2">
                    <a href="?tambah-berita" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Data berita
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                                            <th width="10%">Tanggal Posting</th>
                                            <th width="15%">Gambar</th>
                  						    <th width="20%">Judul</th>
                      						<th width="20%">Deskripsi</th>
                      						<th width="5%">Aksi</th>
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    while($row=mysql_fetch_array($sql)){
                            				?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                            						<td><?php echo tglindonesia($row['datetime']);?></td>
                                                    <td><img src="<?php echo $row["gambar"] == "" ? "images/berita/no-images.png" : "images/berita/".$row["gambar"] ?>" class="img-responsive center-block" style="width: 60%;" /></td>
                                                    <td><?php echo $row['judul'];?></td>
                                                    
                                                    <td><?php echo $row['sinopsis'];?></td>
                                                    <td class="center">
                                                        <a href="?update-berita=<?php echo $row["id_berita"]?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                         <a href="#" id="delete-berita=<?php echo $row["id_berita"]?>" class="delete"> 
                                                            <i class="fa fa-trash-o fa-2x"></i>
                                                         </a>
                                                    </td>
                            					</tr>
                            				<?php $no++; } ?>
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