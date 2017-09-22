<?php
if(isset($_POST["submit"])){
    $no = $_POST["no"];
    $thn = $_POST["tahun"];
    
    $bln    = mysql_query("select * from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn%'");
    $rowbln = mysql_fetch_array($bln);
    
}

$sqldetail2  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah, tabel_simpanan.jenis_simpanan, tabel_simpanan.jenis FROM tabel_anggota
INNER JOIN tabel_simpanan ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota
 WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Pokok' ORDER BY tabel_simpanan.tgl_simpanan DESC") or die (mysql_error());
 
 $sqldetail3  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah, tabel_simpanan.jenis_simpanan, tabel_simpanan.jenis FROM tabel_anggota
INNER JOIN tabel_simpanan ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota
 WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Wajib' ORDER BY tabel_simpanan.tgl_simpanan DESC") or die (mysql_error());

$sqldetail4  = mysql_query("SELECT tabel_simpanan.tgl_simpanan, tabel_simpanan.jumlah, tabel_simpanan.jenis_simpanan, tabel_simpanan.jenis FROM tabel_anggota
INNER JOIN tabel_simpanan ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota
 WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Sukarela' ORDER BY tabel_simpanan.tgl_simpanan DESC") or die (mysql_error());
  
$jmlsalsim1  = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah FROM tabel_anggota INNER JOIN tabel_simpanan 
 ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Pokok' and tabel_simpanan.jenis='setor'") or die (mysql_error());
$jmlsalsim2  = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah FROM tabel_anggota INNER JOIN tabel_simpanan 
 ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Wajib' and tabel_simpanan.jenis='setor'") or die (mysql_error());
 $jmlsalsim3  = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah FROM tabel_anggota INNER JOIN tabel_simpanan 
 ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Sukarela' and tabel_simpanan.jenis='setor'") or die (mysql_error());

$jmlsalsim4  = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah FROM tabel_anggota INNER JOIN tabel_simpanan 
 ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Pokok' and tabel_simpanan.jenis='tarik'") or die (mysql_error());
$jmlsalsim5  = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah FROM tabel_anggota INNER JOIN tabel_simpanan 
 ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Wajib' and tabel_simpanan.jenis='tarik'") or die (mysql_error());
 $jmlsalsim6  = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah FROM tabel_anggota INNER JOIN tabel_simpanan 
 ON tabel_anggota.no_anggota = tabel_simpanan.no_anggota WHERE tabel_anggota. no_anggota = '".$_SESSION["no_anggota"]."' AND tabel_simpanan.jenis_simpanan='Simpanan Sukarela' and tabel_simpanan.jenis='tarik'") or die (mysql_error());

$rowsalsim1  = mysql_fetch_array($jmlsalsim1); 
$rowsalsim2  = mysql_fetch_array($jmlsalsim2);
$rowsalsim3  = mysql_fetch_array($jmlsalsim3);
$rowsalsim4  = mysql_fetch_array($jmlsalsim4); 
$rowsalsim5  = mysql_fetch_array($jmlsalsim5);
$rowsalsim6  = mysql_fetch_array($jmlsalsim6);


$totalsim1 = $rowsalsim1["jumlah"] - $rowsalsim4["jumlah"];
$totalsim2 = $rowsalsim2["jumlah"] - $rowsalsim5["jumlah"];
$totalsim3 = $rowsalsim3["jumlah"] - $rowsalsim6["jumlah"];

$totalsim = $totalsim1 + $totalsim2 + $totalsim3;
?>

    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($_GET["simpanan-wajib"])){?>
                            <h2>Detail simpanan wajib</h2>   
                        <?php }else if(isset($_GET["simpanan-pokok"])){?>
                            <h2>Detail simpanan pokok</h2>
                        <?php }else if(isset($_GET["simpanan-sukarela"])){?>
                            <h2>Detail simpanan sukarela</h2>
                        <?php }else{?>
                            <h2>Detail simpanan</h2>
                        <?php } ?>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <?php if($_SESSION["sessionsim"] == 1){?>
                 <div class="row">
                     <div class="col-md-12">
                        <div class="alert alert-warning">Data Gagal di tambah, saldo tidak cukup...
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                        </div>
                     </div> 
                </div>
                 <?php } ?>
       <!-- content -->
<?php if(isset($_GET["simpanan-pokok"])){?>
<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabel Simpanan Pokok
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail2)>20){ echo "paginated"; }else{}?>">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="12%" >Tanggal setor</th>
                                <th width="12%" >Nominal</th>
                                <th width="12%" >Jenis</th>
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
                                <td><?php echo tglindonesia($rowDetail2['tgl_simpanan']);?></td>
                                <td><?php echo  'Rp. ' . number_format( $rowDetail2['jumlah'], 0 , '' , '.' );?></td>
                                <td><?php echo $rowDetail2['jenis'];?></td>
                            </tr>
                            
                        <?php $no++; } ?>
                        <tr><td colspan="3" align="right">Saldo</td><td>Rp <?php echo number_format( $totalsim1, 0 , '' , '.' );?></td></tr>
                        <?php } else { ?>
                            <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
                        <?php } ?>
                                                				
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else if(isset($_GET["simpanan-wajib"])){?>
<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabel Simpanan Wajib
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail3)>20){ echo "paginated"; }else{}?>">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="12%" >Tanggal setor</th>
                                <th width="12%" >Nominal</th>
                                <th width="12%" >Jenis</th>
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
                                <td><?php echo tglindonesia($rowDetail3['tgl_simpanan']);?></td>
                                <td><?php echo  'Rp. ' . number_format( $rowDetail3['jumlah'], 0 , '' , '.' );?></td>
                                <td><?php echo $rowDetail3['jenis'];?></td>
                            </tr>
                            
                        <?php $no++; } ?>
                        <tr><td colspan="3" align="right">Saldo</td><td>Rp <?php echo number_format( $totalsim2, 0 , '' , '.' );?></td></tr>
                        <?php } else { ?>
                            <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
                        <?php } ?>
                                                				
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else if(isset($_GET["simpanan-sukarela"])){?>
<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabel Simpanan Sukarela
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail4)>20){ echo "paginated"; }else{}?>">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="12%" >Tanggal setor</th>
                                <th width="12%" >Nominal</th>
                                <th width="12%" >Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(mysql_num_rows($sqldetail4) > 0){
                        $no=1;
                        while($rowDetail4=mysql_fetch_array($sqldetail4)){
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo tglindonesia($rowDetail4['tgl_simpanan']);?></td>
                                <td><?php echo  'Rp. ' . number_format( $rowDetail4['jumlah'], 0 , '' , '.' );?></td>
                                <td><?php echo $rowDetail4['jenis'];?></td>
                            </tr>
                            
                        <?php $no++; } ?>
                        <tr><td colspan="3" align="right">Saldo</td><td>Rp <?php echo number_format( $totalsim3, 0 , '' , '.' );?></td></tr>
                        <?php } else { ?>
                            <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
                        <?php } ?>
                                                				
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabel Simpanan Pokok
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail2)>20){ echo "paginated"; }else{}?>">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="12%" >Tanggal setor</th>
                                <th width="12%" >Nominal</th>
                                <th width="12%" >Jenis</th>
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
                                <td><?php echo tglindonesia($rowDetail2['tgl_simpanan']);?></td>
                                <td><?php echo  'Rp. ' . number_format( $rowDetail2['jumlah'], 0 , '' , '.' );?></td>
                                <td><?php echo $rowDetail2['jenis'];?></td>
                            </tr>
                            
                        <?php $no++; } ?>
                        <tr><td colspan="3" align="right">Saldo</td><td>Rp <?php echo number_format( $totalsim1, 0 , '' , '.' );?></td></tr>
                        <?php } else { ?>
                            <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
                        <?php } ?>
                                                				
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabel Simpanan Wajib
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail3)>20){ echo "paginated"; }else{}?>">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="12%" >Tanggal setor</th>
                                <th width="12%" >Nominal</th>
                                <th width="12%" >Jenis</th>
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
                                <td><?php echo tglindonesia($rowDetail3['tgl_simpanan']);?></td>
                                <td><?php echo  'Rp. ' . number_format( $rowDetail3['jumlah'], 0 , '' , '.' );?></td>
                                <td><?php echo $rowDetail3['jenis'];?></td>
                            </tr>
                            
                        <?php $no++; } ?>
                        <tr><td colspan="3" align="right">Saldo</td><td>Rp <?php echo number_format( $totalsim2, 0 , '' , '.' );?></td></tr>
                        <?php } else { ?>
                            <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
                        <?php } ?>
                                                				
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabel Simpanan Sukarela
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover <?php if(mysql_num_rows($sqldetail4)>20){ echo "paginated"; }else{}?>">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="12%" >Tanggal setor</th>
                                <th width="12%" >Nominal</th>
                                <th width="12%" >Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(mysql_num_rows($sqldetail4) > 0){
                        $no=1;
                        while($rowDetail4=mysql_fetch_array($sqldetail4)){
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo tglindonesia($rowDetail4['tgl_simpanan']);?></td>
                                <td><?php echo  'Rp. ' . number_format( $rowDetail4['jumlah'], 0 , '' , '.' );?></td>
                                <td><?php echo $rowDetail4['jenis'];?></td>
                            </tr>
                            
                        <?php $no++; } ?>
                        <tr><td colspan="3" align="right">Saldo</td><td>Rp <?php echo number_format( $totalsim3, 0 , '' , '.' );?></td></tr>
                        <?php } else { ?>
                            <tr><td colspan="4" class="text-center"><i>Tabel data kosong</i></td></tr>
                        <?php } ?>
                                                				
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>