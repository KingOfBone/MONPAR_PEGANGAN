<?php
$sqlKKB = mysql_query("SELECT * FROM tabel_anggota ORDER BY kode_anggota DESC") or die (mysql_error());

$sqlKB = mysql_query("SELECT
tabel_angsuran_sementara.no_anggota,
tabel_anggota.nip,
tabel_anggota.nama_anggota,
tabel_anggota.nama_bank,
tabel_anggota.no_rek
FROM
tabel_anggota
INNER JOIN tabel_angsuran_sementara ON tabel_angsuran_sementara.no_anggota = tabel_anggota.no_anggota") or die (mysql_error());

$sqlH = mysql_query("SELECT * FROM tabel_angsuran ORDER BY kode_angsuran DESC") or die (mysql_error());
?>
<script type="text/javascript">
    function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
    //     if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;
         return true;
      }
      </script>
<!-- jquery data tabel -->
<link href="assets/datatables/dataTables.bootstrap.css" rel="stylesheet" />
<!-- tabs jqueryui -->
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
<script type="text/javascript">
$(window).load(function() { $(".se-pre-con").fadeOut(3000); });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    $('#select_all2').on('click',function(){
        if(this.checked){
            $('.checkbox2').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox2').each(function(){
                this.checked = false;
            });
        }
    });
});
</script>
<!-- Pick Day (datepicker) -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />

<!-- jquery paging -->
<link rel="stylesheet" type="text/css" href="assets/paging/stylepaging.css" />
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data angsuran ( Bank )</h2>
                        <hr />  
                    </div>
                </div>
                <!-- /. ROW  -->
           <div class="row">
                <div class="col-md-12">
                <?php if(isset($_GET["suksestambah"])){?>
                <script>
                //window.open('page/angsuran/bank/cetaksetor.php','_blank');
                </script>
                        <div class="alert alert-success" id="suksestambah">Berhasil di simpan
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                        </div>
                <?php } ?>
                    
                </div>
           </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container1">
                    <div id="tabs">
                        <ul>
                            <li><a href="#KirimKeBank">Kirim ke bank</a></li>
                            <li><a href="#KonfirmasiBank">Konfirmasi Bank</a></li>
                            <li><a href="#History">History</a></li>
                        </ul>
            <div class="panel-container">
            <!-- view 1-->
                <div id="KirimKeBank">
                    <div class="panel-body">
                        <!-- page/setorsimpanan/bank/cetaksetor.php -->
                            <form name="bulk_action_form" id="formkirimkebank" method="post" action="" >
                            <div class="table-responsive">
                              <div class="row">
                                    <div class="col-md-8">
                                     <h3 class="text-left">Kirim ke bank</h3>   
                                    </div>
                                    <div class="col-md-4" style="position:  relative ;">
                                     <span class="input-group-btn" style="position: absolute; top: -27px; right: 70px; border: none !important;" >
                                        <button  class="btn btn-primary btn-sm" type="submit" name="simpancetak" id="simpancetak" style="background: url('images/excel.png'); padding: 20px; border: 0px;"></button>
                                     </span>
                                     <div class="scbox" style="position: absolute; top: 33px; right: 11px;"> 
                                        <label>input setoran per tanggal : </label>
                                            <div class="input-group custom-search-form" >
                                              <input onKeyPress="return isNumberKey(event)" type="text" class="form-control " id="datepicker" name="tgl" data-rule-required="true" data-msg-required="tanggal tidak boleh kosong." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="klik disini" />
                                             </div><!-- /input-group -->
                                     </div>   
                                    </div>
                                </div>
                                    <br />
                                <table class="table table-striped table-bordered table-hover " id="kirimkebank">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" name="select_all" id="select_all" value=""/></th>                                        
                                            <th width="2%">No</th>
                  						    <th width="13%">No anggota</th>
                                            <th width="15%">NIP</th>
                                            <th width="15%">Nama Anggota</th>
                                            <th width="15%">Bank</th>
                                            <th width="13%">No Rek</th>
                                            <th width="15%">Nilai Angsuran</th>
                                            <th width="15%">Angsuran Ke</th>
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                            				$no=1;
                                            while($row=mysql_fetch_array($sqlKKB))
                            				{
                            				    $sqlangsur = mysql_query("select * from tabel_angsuran where no_anggota = '".$row['no_anggota']."' ORDER BY angsuran_ke DESC");
                                                $angsur = mysql_fetch_array($sqlangsur);
                                    ?>
                            					<tr>
                                                    <td class="text-center"><input type="checkbox" id="cek" name="checked_id[]" class="checkbox" value="<?php echo $angsur['no_anggota']; ?>"/></td>                                                
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['no_anggota'];?></td>
                                                    <td><?php echo $row['nip'];?></td>
                            						<td><?php echo $row['nama_anggota'];?></td>
                                                    <td><?php echo $row['nama_bank'];?></td>
                                                    <td><?php echo $row['no_rek'];?></td>
                                                    <td><?php echo  'Rp. ' . number_format( $row['angsuran_bayar'], 0 , '' , '.');?></td>
                                                    <td><?php echo $row['angsuran_ke'];?></td>
                            					</tr>
                            				<?php $no++; } ?>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
                </div>
                <!-- view 2-->
                <div id="KonfirmasiBank">
                    <div class="panel-body">
                            <form name="bulk_action_form" id="konfirmasiangsuran" method="post" action="" >
                            <div class="table-responsive">
                              <div class="row">
                                    <div class="col-md-8">
                                     <h3 class="text-left">Konfirmasi bank</h3>   
                                    </div>
                                    <div class="col-md-4" style="position:  relative ;">
                                     <span class="input-group-btn" style="position: absolute; top: -25px; right: 70px; border: none !important;" >
                                        <button class="btn btn-primary btn-sm" type="submit" name="simpsembtn" id="simpsembtn" style="background: url('images/disket.png'); padding: 20px; border: 0px;"></button>
                                     </span>
                                     <div class="scbox" style="position: absolute; top: 33px; right: 11px;"> 
                                        <label>input setoran per tanggal : </label>
                                            <div class="input-group custom-search-form" >
                                              <input onKeyPress="return isNumberKey(event)" type="text" class="form-control " id="datepicker2" name="tgl" data-rule-required="true" data-msg-required="tanggal tidak boleh kosong." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="klik disini" />
                                             </div><!-- /input-group -->
                                     </div>   
                                    </div>
                                </div>
                                    <br />
                                <table class="table table-striped table-bordered table-hover " id="konfirmbank">
                                    <thead>
                                        <tr>
                                            <th width="2%" class="text-center"><input type="checkbox" name="select_all" id="select_all2" value=""/></th>                                        
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
                            				$no=1;
                                            while($row=mysql_fetch_array($sqlKB))
                            				{
                            				    $sqlangsur = mysql_query("select * from tabel_angsuran where no_anggota = '".$row['no_anggota']."' ORDER BY angsuran_ke DESC");
                                                $angsur = mysql_fetch_array($sqlangsur);
                                                
                            				?>
                            					<tr>
                                                    <td class="text-center"><input type="checkbox" id="cek" name="checked_id[]" class="checkbox2" value="<?php echo $row['kode_angsuran']; ?>"/></td>                                                
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['no_anggota'];?></td>
                                                    <td><?php echo $row['nip'];?></td>
                            						<td><?php echo $row['nama_anggota'];?></td>
                                                    <td><?php echo $row['nama_bank'];?></td>
                                                    <td><?php echo $row['no_rek'];?></td>
                                                    <td><?php echo  'Rp. ' . number_format( $angsur['angsuran_bayar'], 0 , '' , '.');?></td>
                                                    <td><?php echo $angsur['angsuran_ke'];?></td>
                            					</tr>
                            				<?php $no++; }  ?>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
                </div>
                <!-- view 3 -->
                <div id="History">
                    <div class="panel-body">
                            <form name="bulk_action_form" method="post" action="" >
                            <div class="table-responsive">
                              <div class="row">
                                    <div class="col-md-9">
                                     <h3 class="text-left">History</h3>   
                                    </div>
                                    <!--
                                    <div class="col-md-3">
                                        <p>Jumlah : 
                                        <?php 
                                        /*
                                        $rowjml     = mysql_fetch_array($sqlKBjml);
                                        echo 'Rp. ' . number_format( $rowjml["jmlhistory"], 0 , '' , '.' );
                                        */
                                        ?></p>
                                    </div>
                                    -->
                                </div>
                                    <br />
                                <table class="table table-striped table-bordered table-hover " id="history">
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
                            				$no=1;
                                            while($rowH=mysql_fetch_array($sqlH))
                            				{
                            				    $sqlangsur = mysql_query("select * from tabel_angsuran where no_anggota = '".$rowH['no_anggota']."' ORDER BY angsuran_ke DESC");
                                                $angsur = mysql_fetch_array($sqlangsur);
                                                
                            				    $sqlpinjam = mysql_query("select * from tabel_pinjaman where no_anggota = '".$rowH['no_anggota']."'");
                                                $pinjaman = mysql_fetch_array($sqlpinjam);
                            				?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $rowH['no_anggota'];?></td>
                                                    <td><?php echo $rowH['nip'];?></td>
                            						<td><?php echo $rowH['nama_anggota'];?></td>
                                                    <td><?php echo $rowH['nama_bank'];?></td>
                                                    <td><?php echo $rowH['no_rek'];?></td>
                                                    <td><?php echo  'Rp. ' . number_format( $angsur['angsuran_bayar'], 0 , '' , '.');?></td>
                                                    <td><?php echo $angsur['angsuran_ke'];?></td>
                            					</tr>
                				    <?php $no++; } ?>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
        </div>
                </div>
            </div>
        </div>
       </div>     
    </div>

<!-- DATA TABLE SCRIPTS -->
    <script src="assets/dataTables/jquery.dataTables.js"></script>
    <script src="assets/dataTables/dataTables.bootstrap.js"></script>
    <script>
    $(document).ready( function () {
      $('#kirimkebank').dataTable( {
        "bLengthChange": false,
        "iDisplayLength": 50,
        "paging":   true,
        "ordering": true,
        "bInfo": true,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
    } );
    $(document).ready( function () {
      $('#konfirmbank').dataTable( {
        "bLengthChange": false,
        "iDisplayLength": 50,
        "paging":   true,
        "ordering": false,
        "bInfo": false,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
    } );
    </script>
<!--datepicker pikaday-->
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
    var picker = new Pikaday({
        field: document.getElementById('datepicker2'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
</script>
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>

<script>
$('#formkirimkebank').validate({
      rules: {
        field: {
          required: true,
          date: false
        }
      },
      submitHandler: function(form) {
       $.confirm({
			'title'		: 'Konfirmasi Cetak data',
			'message'	: 'Anda ingin menyimpan dan mencetak data ini ? <br /><h5 style="margin:0 20px; font-size:12px">klik yes untuk melanjutkan atau klik no untuk membatalkan<h5>',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(e){
                         $.ajax({
                                type: "POST",
                                url: "page/angsuran/bank/cetaksetor.php",
                                data: jQuery("#formkirimkebank").serialize(),
                                cache: false,
                                success:  function(data){
                                    window.open('page/angsuran/bank/cetaksetor.php','_blank');
                                    window.location.href = "?AngsuranBank&suksestambah";
                                }
                              });
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
    }
    });

$('#formkonfirm').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      },
      submitHandler: function(form) {
       $.confirm({
			'title'		: 'Konfirmasi Simpan',
			'message'	: 'Anda ingin menyimpan data ini ? <br /><h5 style="margin:0 20px; font-size:12px; ">klik yes untuk melanjutkan atau klik no untuk membatalkan<h5>',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(e){
                         $.ajax({
                                type: "POST",
                                url: "page/angsuran/bank/konfirmasiangsuran.php",
                                data: jQuery("#formkonfirm").serialize(),
                                cache: false,
                                success:  function(data){
                                    window.location.href = "?AngsuranBank&suksestambah";
                                }
                              });
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
    }
    });
jQuery.validator.methods["date"] = function (value, element) { return true; }
</script>
<?php /* paging */ ?>    
<script type="text/javascript" src="assets/paging/scriptpaging.js"></script>