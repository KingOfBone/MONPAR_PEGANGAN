<?php
//if(isset($_POST["cari"])){

    $keyname     = ($_POST['keyname']) ? $_POST['keyname'] : $_POST['keyname'];
    if (! $keyname==0){ $q = "WHERE  nama_lengkap LIKE '$keyname%'"; }

    $sql = mysql_query("SELECT * FROM tabel_users  $q ORDER BY nama_lengkap DESC") or die (mysql_error());
    $sqlC = mysql_query("SELECT * FROM tabel_users  $q ORDER BY nama_lengkap DESC") or die (mysql_error());
//}
?>
<!-- autocomplete-->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#keyname" ).autocomplete({
      source: 'assets/Actextbox/nameusers.php'
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
                        <h2>Data Users</h2>
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
                    <a href="?tambah-users" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
           </div>

           <div class="row">
                <div class="col-md-12">


                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel data Anggota
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="row">
                                <form method="POST" action="">
                                    <div class="col-md-4" >
                                        <div class="input-group custom-search-form">
                                            <input id="keyname" class="form-control" name="keyname" value="<?php if(isset($_POST["cari"])){ echo $_POST["keyname"]; }?>" placeholder="masukkan nama users"/>
                                              <span class="input-group-btn">
                                              <button class="btn btn-default" type="submit" name="cari">
                                              <span class="glyphicon glyphicon-search"></span>
                                             </button>
                                             </span>
                                        </div><!-- /input-group -->
                                    </div>
                                </form>
                                </div>
                                    <br />
                                <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sql)>50){ echo "paginated"; }else{}?>">
                                    <thead>

                                        <tr>
                                            <th width="2%">No</th>
                                            <th width="13%" >No Anggota</th>
                  						    <th width="17%" >Nama Lengkap</th>
                                            <th width="15%" >Level</th>
                                            <th width="15%" >Email</th>
                                            <th width="10%" >Aksi</th>
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
                            						<td><?php if($row['no_anggota']==""){ echo "-"; }else{ echo $row['no_anggota']; } ?></td>
                                                    <td><?php echo $row['nama_lengkap'];?></td>
                            						<td><?php if($row['level']=="Sa"){ echo "Super Admin"; }else if($row['level']=="Us"){ echo "Users"; }else{ echo "Supervisor"; };?></td>
                                                    <td><?php echo $row['email'];?></td>
                            						<td class="text-center">
                                                        <a href="?update-users=<?php echo $row["kode_user"]?>"  type="button">
                                                            <i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="#" id="delete-users=<?php echo $row["kode_user"]?>" class="delete">
                                                            <i class="fa fa-trash-o fa-2x"></i>
                                                            </a>

                                                    </td>
                            					</tr>
                            				<?php $no++; } } else { ?>
                                                <tr><td colspan="9" class="text-center"><i>Tabel data users kosong</i></td></tr>
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
<!-- confirm dell -->
<script src="assets/confirmdell/js/script.js"></script>
<?php /* paging */ ?>
<script type="text/javascript" src="assets/paging/scriptpaging.js"></script>
<!-- modal detail anggota -->
<script>
 $(document).on('click','.detail',function(e){
    e.preventDefault();
    $("#myModal1").modal('show');
    $.post('page/anggota/detail.php',
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
            <h4 class="modal-title">Detail Data Anggota</h4>
       </div>
      <div class="modal-body"></div>
      <!-- dialog buttons -->
      <div class="modal-footer">
      <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
    </div>
  </div>
</div>
</div>
<!-- modal detail saldo  simpanan-->
<script>
 $(document).on('click','.d_simpsaldo',function(e){
    e.preventDefault();
    $("#d_simpsaldo").modal('show');
    $.post('page/anggota/d_simpsaldo.php',
    {id:$(this).attr('data-id')},
    function(html){
    $(".modal-body").html(html);
    }
    );
 });
</script>

<div id="d_simpsaldo" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 0;">
      <!-- dialog body -->
       <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center">Detail Saldo Simpanan</h4>
       </div>
      <div class="modal-body"></div>
      <!-- dialog buttons -->
      <div class="modal-footer">
      <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
    </div>
  </div>
</div>
</div>
<!-- modal detail  saldo pinjaman -->
<script>
 $(document).on('click','.d_salpin',function(e){
    e.preventDefault();
    $("#d_salpin").modal('show');
    $.post('page/anggota/d_salpin.php',
    {id:$(this).attr('data-id')},
    function(html){
    $(".modal-body").html(html);
    }
    );
 });
</script>
<div id="d_salpin" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 0;">
      <!-- dialog body -->
       <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center">Detail Saldo Pinjaman</h4>
       </div>
      <div class="modal-body"></div>
      <!-- dialog buttons -->
      <div class="modal-footer">
      <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
    </div>
  </div>
</div>
</div>
