<?php
include "librari/class_paging_pensiun.php";
if($_GET["sort"]==1){
    $sort = "ORDER BY nama_anggota  ASC"; 
    $sort2 = "ORDER BY a.nama_anggota  ASC";    
} else if($_GET["sort"]==2){
    $sort = "ORDER BY nama_anggota DESC";
    $sort2 = "ORDER BY a.nama_anggota DESC";
}else if($_GET["sort"]==3){
    $sort = "ORDER BY simpanan  ASC";
    $sort2 = "ORDER BY b.simpanan  ASC";
}else if($_GET["sort"]==4){
    $sort = "ORDER BY simpanan  DESC";
    $sort2 = "ORDER BY b.simpanan  DESC";
}else if($_GET["sort"]==5){
    $sort = "ORDER BY pinjaman  ASC";
    $sort2 = "ORDER BY b.pinjaman  ASC";
}else if($_GET["sort"]==6){
    $sort = "ORDER BY pinjaman  DESC";
    $sort2 = "ORDER BY b.pinjaman  DESC";
} 
else{
    $sort = "order by no_anggota";
    $sort2 = "ORDER BY a.nip ";
}

    $p      = new Paging;
    $batas  = 100;
    $posisi = $p->cariPosisi($batas);
    $no=1 + $posisi ;
  
  
    $bagianWhere = "";
   
    $keyword    = ($_GET['keyword']);
    $fp2=explode(' (',$keyword); //first phrase
   
    
    if (empty($bagianWhere)) { $bagianWhere .= "nama_anggota LIKE '%$fp2[0]%'"; }
       else { $bagianWhere .= " AND nama_anggota LIKE '%$fp2[0]%'";}
    
  
  
  if($_SESSION["level"]=="Us")
  { 
   
    $sql = mysql_query("SELECT *, 
(SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='setor') - (SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='tarik') as simpanan
FROM `tabel_anggota` a
    WHERE no_anggota = '$_SESSION[no_anggota]' AND $bagianWhere order by no_anggota limit $posisi,$batas") or die (mysql_error());
  } else if($_SESSION["level"]=="Sa" || $_SESSION["level"]=="Spv")
  {
   $th = date('Y')-55;
  
    $sql = mysql_query("SELECT *, (SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='setor') - CASE (SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='tarik') WHEN 'null' THEN '0' ELSE 'SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis=tarik' END as simpanan
   , ((SELECT SUM(jumlah_angsuran) FROM tabel_pinjaman b WHERE a.no_anggota= b.no_anggota ) * (SELECT SUM(jangka_waktu) FROM tabel_pinjaman b WHERE a.no_anggota= b.no_anggota)  - ((SELECT SUM(angsuran_ke) FROM tabel_angsuran b WHERE a.no_anggota= b.no_anggota ) * (SELECT SUM(angsuran_bayar) FROM tabel_angsuran b WHERE a.no_anggota= b.no_anggota))) as pinjaman
FROM `tabel_anggota` a
WHERE substr(nip,1,2) = substr($th,3,4) AND $bagianWhere  $sort limit $posisi,$batas ") or die (mysql_error()); 


 

  }   
    
?>

<script>
$(document).ready(function() {
    
$(".iconpre").hide();

    $('#kliksaldoa , #kliksaldod , #kliknamea, #kliknamed , #klik5 , #klik6').click(function(){
        $(".iconpre").slideToggle();
    });

});

</script>


<!-- autocomplete-->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#keyword" ).autocomplete({
      source: 'assets/aCtextbox/searchpensiun.php'
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
                        <h2>Data Anggota</h2>
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
                <?php 
                if($_SESSION["level"]=="Us"){} 
                else if($_SESSION["level"]=="Sa" || $_SESSION["level"]=="Spv"){   
                ?>
                <div class="col-md-2">
                    <a href="?tambahanggota" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
                <?php } ?>
           </div>
           <div class="row">
                <div class="col-md-12">
                    
                    
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel data Anggota yang akan pensiun
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php 
                             if($_SESSION["level"]=="Us"){} 
                             else if($_SESSION["level"]=="Sa" || $_SESSION["level"]=="Spv"){   
                            ?>
                                <div class="row">
                                <form method="GET" action="?akanpensiun">
                                    <!-- <div class="col-md-3" >
                                        <input id="nomor" class="form-control" name="keyno" value="<?php // if(isset($_POST["cari"])){ echo $_POST["keyno"]; }?>" placeholder="masukkan nip anggota"/>
                                    </div> -->
                                    <div class="col-md-5" >
                                        <input id="keyword" class="form-control" name="keyword" type="text" value="<?php  echo $_GET["keyword"]; ?>" placeholder="masukkan nama nip atau anggota"/>
                                        <input id="akanpensiun" class="form-control" name="akanpensiun" value="" type="hidden"/>
                                        <input id="sort" class="form-control" name="sort" value="" type="hidden"/>
                                    </div>
                                    <div class="col-md-3" >
                                        <button name="cari" class="btn btn-sm btn-success">CARI</button>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="iconpre"></div>
                                    </div>
                                </form>
                                </div>
                            <?php } ?>
                                    <br />
                                <table id="myTable" class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sql) > 50){ ?> paginated <?php } ?>">
                                    <thead>
                                        
                                        <tr>
                                            <th width="2%">No</th>
                                            <th width="10%" >No Anggota</th>
                  						    <th width="10%" >Nip</th>
                                            <th width="13%">
                                                <div class="pull-left" >Nama</div> 
                                                <div class="pull-right">
                                                    <a id="kliknamea" class="pull-left" href="?akanpensiun&sort=1"><img src="images/sortasc.png" class="img-responsive" /></a>
                                                    <a id="kliknamea" class="pull-right" href="?akanpensiun&sort=2"><img src="images/sortdesc.png" class="img-responsive" /></a>
                                                </div>
                                            </th>
                      						<th  width="15%">
                                              <div class="pull-left">Saldo Simpanan</div>
                                              <div class="pull-right" >
                                                <a id="kliksaldoa" class="pull-left" href="?akanpensiun&sort=3"><img src="images/sortasc.png" class="img-responsive" /></a>
                                                <a id="kliksaldod" class="pull-right" href="?akanpensiun&sort=4"><img src="images/sortdesc.png" class="img-responsive" /></a>
                                              </div>
                                            </th>
                                            <th  width="15%">
                                            <div class="pull-left">Saldo Pinjaman</div> 
                                            <div class="pull-right" >
                                                <a id="klik5" class="pull-left" href="?akanpensiun&sort=5"><img src="images/sortasc.png" class="img-responsive" /></a>
                                                <a id="klik6" class="pull-right" href="?akanpensiun&sort=6"><img src="images/sortdesc.png" class="img-responsive" /></a>
                                            </div>
                                            </th>
                                            <th width="10%">Status</th>
                                     <!--       <th class="text-center" width="15%">PHU Simpanan<br />(A/C)*E</th>
                                            <th class="text-center" width="15%">PHU Pinjaman<br />(B/D)*E</th> 
                                            <th class="text-center" width="10%">Divisi</th> -->
                      						<th class="text-center" width="10%" >Aksi</th>
                       					</tr>
                                       
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(mysql_num_rows($sql) > 0){
                                    // $no=1;
                                    while($row=mysql_fetch_array($sql))
                    				{
                    				    $jml=mysql_num_rows($sql);
                    				    ?>
                            					<tr>
                                                    <td><?php echo $no;?></td>
                            						<td><?php echo $row['no_anggota'];?></td>
                                                    <td><?php echo $row['nip'];?></td>
                            						<td><?php echo $row['nama_anggota'];?></td>
                                                    <td class="text-right" >
                                                        <a  href="#" class="d_simpsaldo" data-id="<?php echo $row["no_anggota"]; ?>" role="button" data-toggle="modal">
                                                        <?php echo number_format( $row["simpanan"], 0 , '' , '.' )."<br>";?>
                                                        </a>
                                                    </td>
                                                     <td class="text-right" >
                                                        <a  href="#" class="d_salpin" data-id="<?php echo $row["no_anggota"]; ?>" role="button" data-toggle="modal">
                                                        <?php echo number_format( $row["pinjaman"], 0 , '' , '.' )."<br>";?></a>
                                                    </td>
                                                    <!-- <td class="text-right" >
                                                    <?php

                                                    $sqlpinj = mysql_query("select * from tabel_pinjaman where no_anggota = '".$row['no_anggota']."'");
                                                    $pinj = mysql_fetch_array($sqlpinj);
                                                    $sqlangs = mysql_query("select * from tabel_angsuran where no_anggota = '".$row['no_anggota']."' order by kode_angsuran desc");
                                                    $angs = mysql_fetch_array($sqlangs);
                                                    $jmlbayar = $pinj['jumlah_angsuran']*$pinj['jangka_waktu'];
                                                    $sisapinjaman = $jmlbayar - ($angs['angsuran_ke'] * $angs['angsuran_bayar']);
                                                    ?>
                                                    <a href="#" class="d_salpin" data-id="<?php echo $row["no_anggota"]; ?>" role="button" data-toggle="modal">
                                                        <?php echo number_format( $sisapinjaman, 0 , '' , '.' ); ?>
                                                    </a>
                                                    </td>-->
                                            <!--       <td>
                                                    <?php 
                                                    /*
                                                    $shu = 100000000*0.2;
                                                    $phu = ($saldo/$jmlsimpanan)*$shu;
                                                    
                                                    echo "Rp ".number_format($phu,0,'.','.')."<br>";
                                                   
                                                    ?>   
                                                    </td>
                                                    <td>
                                                    <?php 
                                                   
                                                    $sqlbunga = mysql_query("select sum(bunga_angs) as bunga from tabel_angsuran where no_anggota='".$row["no_anggota"]."' and status_angsuran = 'Lunas'");
                                                    $bunga = mysql_fetch_array($sqlbunga);
                                                    
                                                    $phupinj = ($bunga['bunga']/$pinj['jml'])*$shu;
                                                    echo "Rp ".number_format($phupinj,0,'.','.')."<br>"; */
                                                    ?>
                                                    </td> 
                                                    <td class="text-center" ><?php //echo $row["divisi"]?></td>-->
                                                    <td><?php echo $row["status"]; ?></td>
                            						<td class="text-center">
                                                        <a href="#" class="detail" data-id="<?php echo $row["kode_anggota"]; ?>" role="button" data-toggle="modal">
                                                            <i class="glyphicon glyphicon-zoom-in fa-2x"></i></a>
                                                        <?php 
                                                         if($_SESSION["level"]=="Us"){} 
                                                         else if($_SESSION["level"]=="Sa" || $_SESSION["level"]=="Spv"){   
                                                        ?>
                                                        <a href="?update-anggota=<?php echo $row["kode_anggota"]?>"  type="button">
                                                            <i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="#" id="delete-anggota=<?php echo $row["no_anggota"]?>" class="delete"> 
                                                            <i class="fa fa-trash-o fa-2x"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                            					</tr>
                            				<?php $no++; } } else { ?>
                                                <tr><td colspan="9" class="text-center"><i>Tabel data anggota kosong</i></td></tr>
                                            <?php } ?>
                            				
                                    </tbody>
                                </table>
                                <div class="pager">
                                            	<?php
                                            	       if($_SESSION["level"]=="Us")
                                                        {
                                                            $jmldata = mysql_num_rows(mysql_query("SELECT * FROM tabel_anggota WHERE $bagianWhere no_anggota = '$_SESSION[no_anggota]' order by no_anggota "));
                                                        } 
                                                        else if($_SESSION["level"]=="Sa")
                                                        {   
                                                            $datath = date('Y')-55;
                                                            $jmldata = mysql_num_rows(mysql_query("SELECT * FROM tabel_anggota WHERE substr(nip,1,2) = substr($datath,3,4) and $bagianWhere order by no_anggota ")); 
                                                        }   
                                                	
                                                    $jmlhalaman   = $p->jumlahHalaman($jmldata, $batas);
                                            		$linkHalaman  = $p->navHalaman($_GET[halaman], $jmlhalaman);
                                            	?>
                                            	<?php echo "$linkHalaman<br>"; ?>	
                                </div>
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
<!-- <script type="text/javascript" src="assets/paging/scriptpaging.js"></script>
 modal detail anggota -->
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
  <div class="modal-dialog ">
    <div class="modal-content wrap-dialog" style="border-radius: 0;">
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
    $.post('page/anggota/d_salpin2.php',
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