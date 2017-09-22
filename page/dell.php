<?php
	ob_start();
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../config/koneksi.php";

	if( ! isset($_SESSION["level"])) header("location:login.php?noakses");

	$querystring = mysql_real_escape_string(trim($_GET["mau_delete"]));
	$explode = explode(',', $querystring);
	
	$nama_table = $explode[0];
	$pk = $explode[1];
	$id = $explode[2];
	$loc = $explode[3];
	$id2 = !empty($_GET['id']) ? $_GET['id'] : null;
	
	mysql_query("DELETE FROM $nama_table WHERE $pk ='$id'") or die(mysql_error());
	
	if($nama_table == 'pemeliharaan')
		$nama_table .= "&&id=$id2";
	
	header("location:../?$loc=$nama_table");
	die();
	
	/* if(isset($_GET["input_delete"])){
		$explode = explode(',', $querystring);
		
		$nama_table = $explode[0];
		$pk = $explode[1];
		$id = $explode[2];
		$loc = $explode[3];
		
		mysql_query("DELETE FROM $nama_table WHERE $pk ='$id'") or die(mysql_error());
		header("location:../?$loc=$nama_table");
	}
	else if(isset($_GET["maintenance_delete"])){
		$querystring = mysql_real_escape_string(trim($_GET["input_delete"]));
		$explode = explode(',', $querystring);
		
		$nama_table = $explode[0];
		$pk = $explode[1];
		$id = $explode[2];
		$loc = $explode[3];
		
		mysql_query("DELETE FROM $nama_table WHERE $pk ='$id'") or die(mysql_error());
		header("location:../?$loc=$nama_table");
	}
	else if(isset($_GET["mau_delete"])){
		$querystring = mysql_real_escape_string(trim($_GET["mau_delete"]));
		$explode = explode(',', $querystring);
		
		$nama_table = $explode[0];
		$pk = $explode[1];
		$id = $explode[2];
		$loc = $explode[3];
		
		mysql_query("DELETE FROM $nama_table WHERE $pk ='$id'") or die(mysql_error());
		header("location:../?$loc=$nama_table");
	} */
?>
