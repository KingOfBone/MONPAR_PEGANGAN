<?php
ob_start();
session_start();
if( ! isset($_SESSION["level"])) header("location:login.php?noakses");

include "../../../config/koneksi.php";
include "../../../config/utility.php";
date_default_timezone_set("Asia/Jakarta");


header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache-control: private");
header("Content-Type: application/vnd.ms-excel; name='excel'");
header("Content-disposition: attachment; filename=cetaklistangsuranbank.xls");

if($_POST["checked_id"]==""){
$sqljml = mysql_query("SELECT SUM(tabel_angsuran.jumlah) as jmlhistory FROM tabel_simpanan JOIN tabel_anggota 
ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota ");

$sqlKKB = mysql_query("SELECT tabel_anggota.no_anggota, tabel_anggota.nip, tabel_anggota.nama_anggota, tabel_anggota.nama_bank,
tabel_anggota.no_rek FROM tabel_angsuran_sementara INNER JOIN tabel_anggota ON tabel_angsuran_sementara.no_anggota = tabel_anggota.no_anggota
ORDER BY tabel_angsuran_sementara.kode_angs_sem DESC");
}else{
      mysql_query("DELETE FROM tabel_angsuran_sementara ") or die (mysql_error);
    $idArr  = $_POST['checked_id'];
    $tgl    = tglformataction($_POST['tgl']);
    $date  = date("Y-m-d h:i:s");
    
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','kirim angsuran bank','tambah')");
    foreach($idArr as $id){
        mysql_query("INSERT INTO tabel_angsuran_sementara VALUES ('','$id','$tgl');") or die (mysql_error);
    }
}
?>
<h2>Data angsuran bank</h2>
<br /><br />
<p>tanggal : <?php echo tglindonesia(date("Y/m/d"))?></p>
<p>Jumlah : <?php 
/*
$rowjml     = mysql_fetch_array($sqljml);
echo 'Rp. ' . number_format( $rowjml["jmlhistory"], 0 , '' , '.' );
*/
?></p>
<table border="1" >
    <thead>
        <tr>                                        
        <th width="2%">No</th>
        <th width="15%">No anggota</th>
        <th width="15%">NIP</th>
        <th width="17%">Nama Anggota</th>
        <th width="15%">Bank</th>
        <th width="13%">No Rek</th>
        <th width="15%">Nilai Angsuran</th>
        <th width="15%">Angsur Ke</th>
                       					</tr>
    </thead>
    <tbody>
                                    <?php
                                        if(mysql_num_rows($sqlKKB) > 0){
                            				$no=1;
                                            while($row=mysql_fetch_array($sqlKKB))
                            				{
                            				    $sqlangsur = mysql_query("select * from tabel_angsuran where no_anggota = '".$row['no_anggota']."' ORDER BY angsuran_ke DESC");
                                                $angsur = mysql_fetch_array($sqlangsur);
                                                
                            				    $sqlpinjam = mysql_query("select * from tabel_pinjaman where no_anggota = '".$row['no_anggota']."'");
                                                $pinjaman = mysql_fetch_array($sqlpinjam);
                            				?>
                            					<tr>                                                
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['no_anggota'];?></td>
                                                    <td><?php echo $row['nip'];?></td>
                            						<td><?php echo $row['nama_anggota'];?></td>
                                                    <td><?php echo $row['nama_bank'];?></td>
                                                    <td><?php echo $row['no_rek'];?></td>
                                                    <td><?php echo  'Rp. ' . number_format( $angsur['angsuran_bayar'], 0 , '' , '.');?></td>
                                                    <td><?php echo $angsur['angsuran_ke'];?></td>
                            					</tr>
                				    <?php $no++; } } else { ?>
                                            <tr><td colspan="7" class="text-center"><i>Maaf data yang anda cari tidak ada</i></td></tr>
                                    <?php }?>
                                    </tbody>
</table>
<br /><br />
<?php
 //header("Location:../../../?SetoranBank&suksestambah");
?>