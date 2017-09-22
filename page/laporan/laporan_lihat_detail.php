

<!-- Pick Day -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<script type="text/javascript" src="page/gangguan/triger.js"></script>


<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Laporan</h2>
                    <hr />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Table laporan</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="validate-me-plz" name="form_akun" role="form" action="" method="post" >
                                     <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label>Pilih Periode :</label></div>
                                                <div class="col-md-3">
                                                    <input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="tglawal" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="isikan kolom tanggal" value="<?php if(isset($_POST["cari"])){ echo $_POST["tglawal"]; } ?>" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="tglakhir" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="isikan kolom tanggal" value="<?php if(isset($_POST["cari"])){ echo $_POST["tglakhir"]; } ?>" />
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-success" name="cari" type="submit"> Cari</button>
                                                </div>
												<?php 
													if($_GET['laporan_lihat'] != 'pengisian')
														$kunci = true;
													else
														$kunci = false;
													
													if($kunci) {
												?>
                                                <div class="col-md-2">
                                                    <a href="page/laporan/cetak.php?act=print&table=<?php echo $_GET['laporan_lihat']; ?>&tglawal=<?php echo $_POST["tglawal"]; ?>&tglakhir=<?php echo $_POST["tglakhir"]; ?>" target="_blank"><img src="images/print.png" title="cetak dokumen" /></a>
                                                    <a href="page/laporan/cetak.php?act=excel&table=<?php echo $_GET['laporan_lihat']; ?>&tglawal=<?php echo $_POST["tglawal"]; ?>&tglakhir=<?php echo $_POST["tglakhir"]; ?>"><img src="images/excel.png" /></a>
                                                </div>
												<?php
													}
												?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php 
									$nama_table = ucwords($_GET['laporan_lihat']);
									//echo "nama_table = $nama_table";
									//var_dump($_SESSION['tgl']);
									
									$daftar_dir['pemeliharaan'] = ['pemeliharaan'];
									//echo "laporan_".$_GET['laporan_lihat'].".php";
									
									include("laporan_lihat_detail_pengisian.php");
									
							?>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>
</div>




<!-- confirm dell -->
<script src="assets/confirmdell/js/script.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/datatables/jquery.dataTables.js"></script>
<script src="assets/datatables/dataTables.bootstrap.js"></script>
<script>
    $(document).ready( function () {
        $('#datatabel').dataTable( {
            "paging":   true,
            "ordering": false,
            "bInfo": false,
            "dom": '<"pull-left"f><"pull-right"l>tip'
        });
    });
</script>
