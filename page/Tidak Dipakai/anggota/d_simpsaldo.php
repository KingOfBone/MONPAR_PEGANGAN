<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];


$sql = mysql_query("SELECT *, 
(SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='setor') - 
(SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='tarik') as simpanan
FROM `tabel_anggota` a
WHERE  no_anggota = '$detail' ") or die (mysql_error()); 
   
   
//$sqldetail  = mysql_query("SELECT * FROM tabel_anggota '") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sql);
/*
$sqlsimpanan = mysql_query("SELECT *, (SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='setor') - (SELECT SUM(jumlah) FROM tabel_simpanan b WHERE a.no_anggota= b.no_anggota AND jenis='tarik') as simpanan
FROM `tabel_anggota` a
WHERE  no_anggota = '$detail' ") or die (mysql_error()); 
*/
$sqlsimpanan  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah, tabel_simpanan.jenis_simpanan, tabel_simpanan.jenis FROM tabel_anggota
INNER JOIN tabel_simpanan ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota
 WHERE tabel_anggota. no_anggota = '$detail' ORDER BY tabel_simpanan.tgl_simpanan ASC") or die (mysql_error());



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
      </div>

  
<br />
<h4>Tabel Detail Simpanan Anggota</h4>
<table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqlsimpanan)>20){ echo "paginated"; }else{}?>">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="18%" >Tanggal Transaksi</th>
            <th width="15%" >Debet</th>
            <th width="15%" >Kredit</th>
            <th width="15%" >saldo</th>
            <th width="18%" >Jenis</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(mysql_num_rows($sqlsimpanan) > 0){
    $no=1;
    while($rowsim=mysql_fetch_array($sqlsimpanan)){
    ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo tglindonesia($rowsim['tgl_simpanan']);?></td>
            <td><?php
              
                if($rowsim["jenis"]=="setor"){
                    
                echo  'Rp. ' . number_format( $rowsim['jumlah'], 0 , '' , '.' );
                }
                ?>
            </td>
            <td>
            <?php 
          
                if($rowsim["jenis"]=="tarik"){
                    echo  'Rp. ' . number_format( $rowsim['jumlah'], 0 , '' , '.' );
              
                }
            ?>
            </td>
            <td>
            <?php 
            
            if($rowsim["jenis"]=="setor"){
                $saldoakhir = $saldoakhir + $rowsim["jumlah"];
            }else if($rowsim["jenis"]=="tarik"){
                $saldoakhir = $saldoakhir - $rowsim["jumlah"];
            }
            $saldo = $rowsim["jumlah"] ;
            echo  'Rp. ' . number_format( $saldoakhir, 0 , '' , '.' );
            ?>
            </td>
            <td>
            <?php echo $rowsim['jenis_simpanan']; ?>
            </td>
        </tr>
    <?php $no++; } } else { ?>
        <tr><td colspan="6" class="text-center"><i>Tabel data anggota kosong</i></td></tr>
    <?php } ?>
                            				
    </tbody>
</table>
<?php 
//include "d_simpsaldo2.php";
?>