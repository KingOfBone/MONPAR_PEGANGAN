<?php
if(isset($_POST["submit"])){
    $no = $_POST["no"];
    $thn = $_POST["tahun"];
    
    $q1     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-01%'");
    $row1 = mysql_fetch_array($q1);
    
    $q2     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-02%'");
    $row2 = mysql_fetch_array($q2);
    
    $q3     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-03%'");
    $row3 = mysql_fetch_array($q3);
    
    $q4     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-04%'");
    $row4 = mysql_fetch_array($q4);
  
    $q5     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-05%'");
    $row5 = mysql_fetch_array($q5);
    
    $q6     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-06%'");
    $row6 = mysql_fetch_array($q6);
    
    $q7     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-07%'");
    $row7 = mysql_fetch_array($q7);
    
    $q8     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-08%'");
    $row8 = mysql_fetch_array($q8);
    
    $q9     = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-09%'");
    $row9 = mysql_fetch_array($q9);
    
    $q10    = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-10%'");
    $row10  = mysql_fetch_array($q10);
    
    $q11    = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-11%'");
    $row11  = mysql_fetch_array($q11);
    
    $q12    = mysql_query("select tgl_simpanan , jumlah, jenis_simpanan from tabel_simpanan WHERE jenis_simpanan = 'Simpanan Wajib' 
                AND no_anggota = '".$_SESSION["no_anggota"]."' AND tgl_simpanan LIKE '%$thn-12%'");
    $row12  = mysql_fetch_array($q12);
}
?>

    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Tunggakan simpanan</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah Tunggakan Simpanan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="tunggakan" role="form" action="" method="post">
                            <div class="form-group">
                                <div class="row text-center" >
                                    <div class="col-md-2"><label>No anggota / Nama </label></div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" readonly="" value="<?php echo $_SESSION["username"]." (".$_SESSION["no_anggota"].")"?>" />
                                        <input class="form-control" id="no" type="hidden" name="no" value="<?php echo $_SESSION["no_anggota"] ?>" />
                                    </div>
                                    <div class="col-md-1"><label>Tahun</label></div>
                                    <div class="col-md-2">
                                        <select name="tahun" id="tahun" class="form-control">
                                        <option value="">-- Tahun --</option>
                                            <?php
                                            $dT = date("Y")+1;
                                            $dM = $dT - 17;
                                            for( $i = $dM; $i<$dT; $i++ ) { ?>
                                            <option <?php if($_POST["tahun"]==$i){ ?> selected="" <?php }?> value="<?php echo $i; ?>"><?php echo $i; ?></option>      
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                    <button type="submit" name="submit" class="btn btn-large btn-success">Lihat</button>
                                </div>
                            </div>
                            </form>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Januari</label></div>
                                    <div class="col-md-4">
                                        <?php 
                                            
                                            $jan    = substr($row1["tgl_simpanan"],5,2);
                                            if($jan=="01"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row1['jumlah'], 0 , '' , '.' ); ?>"/>
                                        <?php  }else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Februari</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $feb    = substr($row2["tgl_simpanan"],5,2);
                                            if($feb=="02"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row2['jumlah'], 0 , '' , '.' ); ?>"/>
                                        <?php  } else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Maret</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $mar    = substr($row3["tgl_simpanan"],5,2);
                                            if($mar=="03"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row3['jumlah'], 0 , '' , '.' ); ?>" />
                                        <?php }  else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>April</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $apr    = substr($row4["tgl_simpanan"],5,2);
                                            if($apr=="04"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo 'Rp. ' . number_format( $row4['jumlah'], 0 , '' , '.' ); ?>" />
                                        <?php }  else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Mei</label></div>
                                    <div class="col-md-4">
                                        <?php 
                                            
                                            $mei    = substr($row5["tgl_simpanan"],5,2);
                                                if($mei=="05"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row5['jumlah'], 0 , '' , '.' ); ?>" />
                                        <?php }  else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Juni</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $jun    = substr($row6["tgl_simpanan"],5,2);
                                            if($jun=="06"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row6['jumlah'], 0 , '' , '.' ); ?>"/>
                                        <?php  }else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Juli</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $jul    = substr($row7["tgl_simpanan"],5,2);
                                            if($jul=="07"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row7['jumlah'], 0 , '' , '.' ); ?>"/>
                                        <?php } else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Agustus</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $ags    = substr($row8["tgl_simpanan"],5,2);
                                            if($ags=="08"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row8['jumlah'], 0 , '' , '.' ); ?>" />
                                        <?php } else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>September</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $sep    = substr($row9["tgl_simpanan"],5,2);
                                            if($sep=="09"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row9['jumlah'], 0 , '' , '.' ); ?>" />
                                        <?php } else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Oktober</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $okt    = substr($row10["tgl_simpanan"],5,2);
                                            if($okt=="10"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row10['jumlah'], 0 , '' , '.' ); ?>"/>
                                        <?php }  else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>November</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $nov    = substr($row11["tgl_simpanan"],5,2);
                                            if($nov=="11"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row11['jumlah'], 0 , '' , '.' ); ?>"/>
                                        <?php } else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"><label>Desember</label></div>
                                    <div class="col-md-4">
                                         <?php 
                                            $des    = substr($row12["tgl_simpanan"],5,2);
                                            if($des=="12"){
                                        ?>
                                            <input type="text" class='form-control'  readonly="" value="<?php echo   'Rp. ' . number_format( $row12['jumlah'], 0 , '' , '.' ); ?>"/>
                                        <?php } else{ ?>
                                            <input type="text" class='form-control'  readonly="" value=" - "/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>  
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
