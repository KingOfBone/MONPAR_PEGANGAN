<?php
$sql = mysql_query("SELECT
bushing.kodebushing,
bushing.serialid,
bushing.tipeid,
bushing.kodestatus,
bushing.tegoprs,
bushing.phasa,
bushing.penempatan,
bushing.tgloprs,
bushing.kodemerk,
bushing.thnbuat,
bushing.kodetrafo,
bushing.tipe,
bushing.housing,
bushing.jenis,
bushing.pasangan,
bushing.outerterm,
bushing.tegmaks,
bushing.arusmaks,
bushing.bil,
bushing.sil,
bushing.pfw,
bushing.tandelta,
bushing.ctspace,
bushing.jrkflgbtmend,
bushing.dmtrflg,
bushing.dmtrholetohole,
bushing.jmlbaut,
bushing.dmtrbaut,
bushing.creepdist,
bushing.kapc1,
bushing.kapc2,
bushing.kemiringan,
bushing.sparkgap,
bushing.taptest,
bushing.berat,
bushing.standart,
bushing.techidentoold,
bushing.objecttype,
bushing.constype,
bushing.techidento,
bushing.eqnumber,
bushing.equipmentnumber,
bushing.idfunctloc,
bushing.image,
trafo.kodegi,
gi.namagi,
app.namaapp,
merk.merk,
buatan.buatan
FROM
bushing
INNER JOIN trafo ON bushing.kodetrafo = trafo.kodetrafo
INNER JOIN gi ON gi.kodegi = trafo.kodegi
INNER JOIN app ON app.kodeapp = gi.kodeapp
INNER JOIN merk ON bushing.kodemerk = merk.kodemerk
INNER JOIN buatan ON buatan.kodebuatan = merk.kodebuatan


 ") or die (mysql_error());

?>

<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data Bushing</h2>
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
                    <a href="?tambahbushing" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Data Bushing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <br />
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>
                                            <th width="4%">No</th>
                                            <th width="10%">Serial ID</th>
                            						    <th width="13%">Tipe ID</th>
                                						<th width="8%">Kode Status</th>
                                            <th width="8%">Teg Oprs</th>
                                            <th width="8%">Phasa</th>
                                            <th width="9%">Penempatan</th>
                                            <th width="10%">Tanggal Oprs</th>
                                            <th width="7%">Merk</th>
                                						<th width="10%">Tahun Buat</th>
                                            <th width="7%">Aksi</th>
                               					</tr>
                                    </thead>
                                    <tbody>
                                    <?php

                            				$no=1;
                                            while($row=mysql_fetch_array($sql))
                            				{
                            				?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['serialid'];?></td>
                                                    <td><?php echo $row['tipeid'];?></td>
                                                    <td><?php echo $row['kodestatus'];?></td>
                                                    <td><?php echo $row['tegoprs'];?></td>
                                                    <td><?php echo $row['phasa'];?></td>
                                                    <td><?php echo $row['penempatan'];?></td>
                                                    <td><?php echo $row['tgloprs'];?></td>
                                                    <td><?php echo $row['merk'];?></td>
                                                    <td><?php echo $row['thnbuat'];?></td>
                                                    <td class="center">
                                                     <a href="#" class="detail" data-id="<?php echo $row["kodebushing"]; ?>" role="button" data-toggle="modal">
                                                            <i class="glyphicon glyphicon-zoom-in fa-2x"></i></a>
                                                        <a href="?update-bushing=<?php echo $row["kodebushing"]?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                         <a href="#" id="delete-bushing=<?php echo $row["kodebushing"]?>" class="delete">
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
    $.post('page/bushing/detail.php',
    {id:$(this).attr('data-id')},
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
      <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tutup</button>
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
