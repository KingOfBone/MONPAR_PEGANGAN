<?php
ob_start();
session_start();
if( ! isset($_SESSION["level"])) header("location:login.php?noakses");
date_default_timezone_set("Asia/Jakarta");

include "../../../config/koneksi.php";
include "../../../config/utility.php";

mysql_query("DELETE FROM tabel_simpanan_sementara ") or die (mysql_error);  
    $idArr  = $_POST['checked_id'];
    $tgl    = tglformataction($_POST['tgl']);
    $date    = date("Y-m-d h:i:s");
    mysql_query("INSERT INTO tabel_history VALUES ('','$_SESSION[username]','','$date','konfirmasi angsuran','tambah')");
    
    foreach($idArr as $noAnggota1){
        $jml = mysql_query("select * from tabel_anggota where no_anggota='$noAnggota1'");
        $hjml = mysql_fetch_array($jml);
        $jmlsetor = $hjml['setoran_wajib']; 
        mysql_query("INSERT INTO tabel_angsuran VALUES ('','','$noAnggota1','$tgl','$jmlsetor','Simpanan Wajib','setor','bank');") or die (mysql_error);
    }
    