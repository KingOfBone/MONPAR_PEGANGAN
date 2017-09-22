<?php
	$nama_table = strtoupper('pemakaian');
	
	$kolom_table = information_schema($nama_table);
	
	$pk = ambil_pk($nama_table);
	
	if(isset($_GET['maintenance_delete']))
		delete($nama_table, $pk, $_GET['id']);
	
	$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;;
	$sql = "select *, $pk 'id' from $nama_table order by $pk desc limit 0, 30";
	$sql = mysql_query($sql);
?>

<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $nama_table; ?></h2>
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
                    <a href="?maintenance_tambah=<?php echo $nama_table; ?>" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $nama_table; ?>
                        </div>
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
                    						<th width="7%">Aksi</th>
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
													foreach($kolom_table as $kol) {
														if($kol['Komen'] == 'penting')
															echo '<td>'. tampil_kolom_isitable('lihat', $kol['Kolom'], $kol['Tipe'], $nama_table, $row) .'</td>';
													}
												?>
												
												<td class="center">
													<a href="#" class="detail" data-id="<?php echo $row['id']; ?>" data-nama_table="<?php echo $nama_table; ?>" role="button" data-toggle="modal">
														<i class="glyphicon glyphicon-zoom-in fa-2x"></i></a>
													<a href="?maintenance_update=<?php echo $nama_table; ?>&&id=<?php echo $row['id']; ?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
													 <a href="#" id="maintenance_delete=<?php echo "$nama_table,$pk,$row[id],maintenance_lihat"; ?>" class="delete">
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
<script>
 $(document).on('click','.detail',function(e){
    e.preventDefault();
    $("#myModal1").modal('show');
    $.post('page/maintenance/maintenance_modal.php',
    {
		id:$(this).attr('data-id'), 
		nama_table:$(this).attr('data-nama_table')
	},
    function(html){
    $(".modal-body").html(html);
    }
    );
 });
</script>


<div id="myModal1" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 0;">
      <!-- dialog body -->
       <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detail Data Trafo</h4>
       </div>
      <div class="modal-body"></div>
      <!-- dialog buttons -->
      <div class="modal-footer">
      <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
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
