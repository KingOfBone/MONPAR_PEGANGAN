<?php
$sql = mysql_query("SELECT
oltc.kodeoltc,
oltc.kodetrafo,
oltc.serialid,
oltc.typeid,
oltc.kodepst,
oltc.kodestatus,
oltc.tegoprs,
oltc.tgloprs,
oltc.kodemerk,
oltc.thnbuat,
oltc.keterangan,
oltc.tipe,
oltc.techidentoold,
oltc.objecttype,
oltc.constype,
oltc.techidento,
oltc.eqnumber,
oltc.equipmentnumber,
oltc.idfunctloc,
oltc.image,
trafo.kodegi,
gi.namagi,
merk.merk,
buatan.buatan,
gi.kodeapp,
app.namaapp
FROM
oltc
INNER JOIN merk ON oltc.kodemerk = merk.kodemerk
INNER JOIN trafo ON oltc.kodetrafo = trafo.kodetrafo
INNER JOIN gi ON trafo.kodegi = gi.kodegi
INNER JOIN buatan ON merk.kodebuatan = buatan.kodebuatan
INNER JOIN app ON gi.kodeapp = app.kodeapp

 ") or die (mysql_error());

?>

<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data OLTC</h2>
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
                    <a href="?tambah-oltc" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Data OLTC
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <br />
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>
                                          <th width="4%">No</th>
                                          <th width="18%">APP</th>
                                          <th width="13%">Nama Gardu Induk</th>
                                          <th width="11%">Serial ID</th>
                                          <th width="10%">Teg Opr</th>
                                          <th width="11%">Tanggal Oprs</th>
                                          <th width="9%">Merk</th>
                                          <th width="7%">Tipe</th>
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
                                                    <td><?php echo $row['namaapp'];?></td>
                                                    <td><?php echo $row['namagi'];?></td>
                                                    <td><?php echo $row['serialid'];?></td>
                                                    <td><?php echo $row['tegoprs'];?></td>
                                                    <td><?php echo $row['tgloprs'];?></td>
                                                    <td><?php echo $row['merk'];?></td>
                                                    <td><?php echo $row['tipe'];?></td>
                                                    <td class="center">
                                                     <a href="#" class="detail" data-id="<?php echo $row["kodeoltc"]; ?>" role="button" data-toggle="modal">
                                                            <i class="glyphicon glyphicon-zoom-in fa-2x"></i></a>
                                                        <a href="?update-oltc=<?php echo $row["kodeoltc"]?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                         <a href="#" id="delete-oltc=<?php echo $row["kodeoltc"]?>" class="delete">
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
    $.post('page/oltc/detail.php',
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
            <h4 class="modal-title">Detail Data oltc</h4>
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
