<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];
$sqldetail  = mysql_query("SELECT * FROM tabel_anggota WHERE no_anggota = '$detail'") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sqldetail);


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
            <th width="15%" >Tanggal</th>
            <th width="15%" >Simpanan Pokok</th>
            <th width="15%" >Simpanan Wajib</th>
            <th width="15%" >Simpanan Sukarela</th>
            <th width="18%" >Saldo</th>
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
               $sqlsimpok  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah FROM tabel_simpanan
                WHERE tabel_simpanan.tgl_simpanan ='".$rowsim["tgl_simpanan"]."' AND tabel_simpanan.no_anggota=".$rowDetail["no_anggota"]." AND jenis_simpanan='Simpanan Pokok'") or die (mysql_error()); 
                
                $rowpok=mysql_fetch_array($sqlsimpok);
                
                echo 'Rp. ' . number_format( $rowpok['jumlah'], 0 , '' , '.' );
                ?>
            </td>
            <td>
            <?php 
            $sqlsimwaj  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah FROM tabel_simpanan
                WHERE tabel_simpanan.tgl_simpanan ='".$rowsim["tgl_simpanan"]."' AND tabel_simpanan.no_anggota=".$rowDetail["no_anggota"]." AND jenis_simpanan='Simpanan wajib'") or die (mysql_error()); 
            $rowwaj=mysql_fetch_array($sqlsimwaj);
            echo 'Rp. ' . number_format( $rowwaj['jumlah'], 0 , '' , '.' );
            ?>
            </td>
            <td>
            <?php 
            $sqlsimsuk  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah FROM tabel_simpanan
                        WHERE tabel_simpanan.tgl_simpanan ='".$rowsim["tgl_simpanan"]."' AND tabel_simpanan.no_anggota=".$rowDetail["no_anggota"]." AND jenis_simpanan='Simpanan sukarela'") or die (mysql_error()); 
            $rowsuk     = mysql_fetch_array($sqlsimsuk);
            echo 'Rp. ' . number_format( $rowsuk['jumlah'], 0 , '' , '.' );
            ?>
            </td>
            <td><?php 
            $sqltotal   = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah FROM tabel_simpanan
                            WHERE tabel_simpanan.tgl_simpanan ='".$rowsim["tgl_simpanan"]."' AND tabel_simpanan.no_anggota=".$rowDetail["no_anggota"]) or die (mysql_error()); 
            $rowtotal   = mysql_fetch_array($sqltotal);
            $hasil = $rowpok['jumlah'] + $rowwaj['jumlah']+ $rowsuk['jumlah'] ;
            $nominal = $rowtotal["jumlah"] + $hasil;
            echo  'Rp. ' . number_format( $hasil, 0 , '' , '.' );?></td>
            
        </tr>
        
    <?php $no++; } } else { ?>
        <tr><td colspan="6" class="text-center"><i>Tabel data anggota kosong</i></td></tr>
    <?php } ?>
                            				
    </tbody>
</table>
<?php 
//include "d_simpsaldo2.php";
?>