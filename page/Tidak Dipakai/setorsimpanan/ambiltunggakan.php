<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "asp_train";

mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName);

$no    = $_GET['no'];
$thn    = $_GET['thn'];
$sim = mysql_query("SELECT tgl_simpanan, jumlah FROM tabel_simpanan WHERE no_anggota='$no'AND tgl_simpanan LIKE '%$thn%'");

while($r = mysql_fetch_array($sim)){
    echo $r["jumlah"];
}
?>