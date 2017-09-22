<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];
$sqlanggota =  mysql_query("SELECT * FROM tabel_anggota WHERE no_anggota = '$detail'") or die (mysql_error());
$rowAnggota     = mysql_fetch_array($sqlanggota);

$sqlsimpanan  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah, tabel_simpanan.jenis_simpanan, tabel_simpanan.jenis FROM tabel_anggota
INNER JOIN tabel_simpanan ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota
 WHERE tabel_anggota. no_anggota = '$detail' ORDER BY tabel_simpanan.tgl_simpanan ASC") or die (mysql_error());
 
?>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4"><label>No Anggota </label></div>
        <div class="col-md-6"><?php echo $rowAnggota["no_anggota"];; ?></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4"><label>Nip</label></div>
        <div class="col-md-6"><?php echo $rowAnggota["nip"];; ?></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4"><label>Nama Anggota</label></div>
        <div class="col-md-6"><?php echo $rowAnggota["nama_anggota"];; ?></div>
      </div>
<h4>Tabel Pinjaman</h4>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="12%" >Tanggal Pinjaman</th>
            <th width="12%" >Jumlah</th>
        </tr>
    </thead>
    <tbody>
<?php if(mysql_num_rows($sqldetail1) > 0){ ?>
        <tr>
            <td><?php echo tglindonesia($rowDetail1['tgl_pinjaman']);?></td>
            <td><?php echo  'Rp. ' . number_format( $rowDetail1['jumlah_pinjaman'], 0 , '' , '.' );?></td>
        </tr>
    <?php } else { ?>
        <tr><td colspan="3" class="text-center"><i>Tabel data kosong</i></td></tr>
    <?php } ?>              				
    </tbody>
</table>
<h4>Tabel Angsuran</h4>
<table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail2)>10){ echo "pagingdetail"; }else{}?>">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="12%" >Tanggal Angsuran</th>
            <th width="12%" >Angsuran Ke</th>
            <th width="12%" >Jumlah Bayar</th>
       <!--     <th width="12%" >Status</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
    if(mysql_num_rows($sqldetail2) > 0){
    $no=1;
    while($rowDetail2=mysql_fetch_array($sqldetail2)){
    ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo tglindonesia($rowDetail2['tgl_angsuran']);?></td>
            <td><?php echo $rowDetail2['angsuran_ke'];?></td>
            <td><?php echo  'Rp. ' . number_format( $rowDetail2['angsuran_bayar'], 0 , '' , '.' );?></td>
       <!--     <td><?php echo $rowDetail2['status_angsuran'];?></td>  -->
        </tr>
    <?php $no++; } } else { ?>
        <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
    <?php } ?>
                            				
    </tbody>
</table>
<h4>Tabel Tunggakan</h4>
<table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail3)>10){ echo "pagingdetail"; }else{}?>">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="12%" >Tanggal Angsuran</th>
            <th width="12%" >Angsuran Ke</th>
            <th width="12%" >Jumlah Bayar</th>
       <!--     <th width="12%" >Status</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
    if(mysql_num_rows($sqldetail3) > 0){
    $no=1;
    while($rowDetail3=mysql_fetch_array($sqldetail3)){
    ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo tglindonesia($rowDetail3['tgl_angsuran']);?></td>
            <td><?php echo $rowDetail3['angsuran_ke'];?></td>
            <td><?php echo  'Rp. ' . number_format( $rowDetail3['angsuran_bayar'], 0 , '' , '.' );?></td>
       <!--     <td><?php echo $rowDetail3['status_angsuran'];?></td> -->
        </tr>
    <?php $no++; } } else { ?>
        <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
    <?php } ?>
                            				
    </tbody>
</table>
<?php /* paging */ ?>    
<script type="text/javascript" src="assets/paging/scriptpaging.js"></script>
      