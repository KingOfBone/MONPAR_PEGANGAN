<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];
$sqldetail  = mysql_query("SELECT * FROM tabel_anggota WHERE no_anggota = '$detail'") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sqldetail);

$sqlpinj = mysql_query("select * from tabel_pinjaman where no_anggota ='$detail'");

$sqlpinjaman  = mysql_query("SELECT tabel_pinjaman.tgl_pinjaman, tabel_pinjaman.jumlah_pinjaman, tabel_anggota.no_anggota,
tabel_anggota.nip, tabel_anggota.nama_anggota FROM tabel_anggota INNER JOIN tabel_pinjaman 
ON tabel_anggota.no_anggota = tabel_pinjaman.no_anggota WHERE tabel_anggota.no_anggota = '$detail'") or die (mysql_error());
// $rowpinjaman     = mysql_fetch_array($sqlpinjaman);


?>
</div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4"><label>No Anggota </label></div>
        <div class="col-md-6"><?php echo $rowDetail["no_anggota"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4"><label>Nip</label></div>
        
        <div class="col-md-6"><?php echo $rowDetail["nip"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4"><label>Nama Anggota</label></div>
        
        <div class="col-md-6"><?php echo $rowDetail["nama_anggota"]; ?></div>
      </div><br />
      <h4>Data Pinjaman</h4>
      <table id="datatable" class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqlpinj)>20){ echo "paginated"; }else{}?>">
        <thead>
        <tr>
            <th width="2%">No</th>
            <th width="18%" >Tanggal Pencairan</th>
            <th width="15%" >Jumlah Pinjaman</th>
            <th width="15%" >Bunga Per Bulan</th>
            <th width="15%" >Jangka Waktu</th>
            <th width="15%" >Jumlah Bayar</th>
            <th width="10%" >Sumber Dana</th>
            <th width="10%" >Status</th>
        </tr>
        </thead>
    <tbody>
    <?php $no=0; while ($pinj = mysql_fetch_array($sqlpinj)){ $no++;?>
    <tr>
        <td><?php echo $no;?></td>
        <td><?php echo format_tgl($pinj['tgl_pinjaman']);?></td>
        <td><?php echo number_format($pinj["jumlah_pinjaman"],0,'.','.'); ?></td>
        <td><?php echo $pinj["bunga"]." %"; ?></td>
        <td><?php echo $pinj["jangka_waktu"]." Bulan"; ?></td>
        <td><?php $jml = $pinj['jumlah_angsuran']*$pinj['jangka_waktu'];
                  echo number_format($jml,0,'.','.'); ?></td>
        <td><?php echo $pinj['sumberdana'];?></td>
        <td><?php echo $pinj['status_pinjaman'];?></td>
    </tr>
   <?php } ?>
   </tbody>
</table>
<br />
<h4>Detail Angsuran Anggota</h4>
<table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqlpinjaman)>20){ echo "paginated"; }else{}?>">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="18%" >Tanggal Transaksi</th>
            <th width="15%" >Angsuran Ke</th>
            <th width="15%" >Angsuran Bayar</th>
            <th width="18%" >Sisa pinjaman</th>
        </tr>
    </thead>
    <tbody>
    <?php
    
    $no=1;
    $sqlangs = mysql_query("select * from tabel_angsuran where no_anggota = '".$rowDetail["no_anggota"]."'");
    if(mysql_num_rows($sqlangs) > 0){
                      while ($angs = mysql_fetch_array($sqlangs)){
    ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php 
            echo format_tgl($angs['tgl_angsuran']);?></td>
            <td><?php 
                        echo number_format($angs['angsuran_ke'],0,'.','.'); ?></td>
            <td>   <?php echo number_format($angs['angsuran_bayar'],0,'.','.');  ?></td>
            <td><?php              $sisapinj = $jml - ($angs['angsuran_ke']* $angs['angsuran_bayar']); 
                           echo number_format($sisapinj,0,'.','.'); ?></td>
            
        </tr>
        
    <?php $no++; } } else { ?>
        <tr><td colspan="6" class="text-center"><i>Tabel data anggota kosong</i></td></tr>
    <?php } ?>
                            				
    </tbody>
</table>
<?php 
//include "d_simpsaldo2.php";
?>