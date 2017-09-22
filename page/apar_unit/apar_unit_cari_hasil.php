<?php
	$level = $_SESSION['jenisuser'];
	$kode_kantor = $_SESSION["kode$level"];
	
	$klausa = '';
	if($_POST['kodegi'] != 'semua') {
		$klausa = "AND kode_kantor = $_POST[kodegi]";
	}
	
	if($level == 'ki')
		$sql = "
			select master.gi.namagi, master.app.namaapp, apar.apar.no_apar from master.app 
			inner join master.gi 
				on master.app.kodeapp=master.gi.kodeapp 
			inner join apar.apar 
				on apar.apar.kode_kantor=master.gi.kodegi 
			where 	
				master.app.kodeapp = $_POST[kodeapp] AND 
				kantor = 'gi' $klausa
		";
	else 
		$sql = "
			select master.gi.namagi, apar.apar.no_apar from apar.apar 
			inner join master.gi
				on master.gi.kodegi=apar.apar.kode_kantor
			where kantor = 'gi' $klausa
			order by master.gi.namagi asc
		";
	
	//echo $sql;
	$sql = mysql_query($sql);
	
?>

<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
				
				
				
				
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data <?php echo ucwords_kolom_table($nama_table); ?></h2>
						<hr />
                    </div>
                </div>
                <!-- /. ROW  -->
				
				<div class="col-md-3">
                    <a href="?<?php echo $nama_table_kecil; ?>_cari" class="btn btn-large btn-warning">Kembali</a>
                    <br /><br />
                </div>
				
			<div class="row">
				<div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table <?php echo ucwords_kolom_table($nama_table); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>
                                            <th width="4%">No</th>
                                            <th width="20%">No Apar</th>
                                            <th width="20%">GI</th>
                                            <?php if($level == 'ki') { ?><th width="4%">APP</th> <?php } ?>
                               			</tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no=1;
										if(mysql_num_rows($sql) > 0) {
											while($row=mysql_fetch_array($sql)) {											
									?>
												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo $row['no_apar']; ?></td>
													<td><?php echo $row['namagi']; ?></td>
													<?php if($level == 'ki') { ?><td><?php echo $row['namaapp']; ?></td> <?php } ?>
												</tr>
										<?php 
												$no++; 
											}
										}
										else {
											echo "
												<tr>
													<td></td>
													<td></td>
											";
											
											if($level == 'ki')
												echo "<td></td>";
												
											echo "
													<td></td>
												</tr>
											";
										}
										?>
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
    $.post('page/<?php echo $nama_table_kecil; ?>/<?php echo $nama_table_kecil; ?>_modal.php',
    {
		id:$(this).attr('data-id'), 
		nama_table:$(this).attr('data-nama_table'),
		objek:$(this).attr('data-objek')
	},
    function(html){
    $(".modal-body").html(html);
    }
    );
 });
 
 $(document).on('click','.detail_peta',function(e){
    e.preventDefault();
    $("#myModal2").modal('show');
    $.post('page/<?php echo $nama_table_kecil; ?>/<?php echo $nama_table_kecil; ?>_modal_peta.php',
    {
		id:$(this).attr('data-id'), 
		nama_table:$(this).attr('data-nama_table'),
		objek:$(this).attr('data-objek2')
	},
    function(html){
    $(".modal-body2").html(html);
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
            <h4 class="modal-title">Detail Data <?php echo $nama_table; ?></h4>
       </div>
      <div class="modal-body"></div>
      <!-- dialog buttons -->
      <div class="modal-footer">
      <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
    </div>
  </div>
</div>
</div>


<div id="myModal2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 0;">
      <!-- dialog body -->
       <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Peta Apar</h4>
       </div>
      <div class="modal-body2"></div>
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
