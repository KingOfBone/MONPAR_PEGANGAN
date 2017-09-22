<?php
$idA = (int)mysql_real_escape_string(trim($_GET["detail-berita"]));
$sqlA = mysql_query("SELECT * FROM tabel_berita WHERE id_berita = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?pic");
$rowA = mysql_fetch_array($sqlA); 

$sqlnews      = mysql_query("SELECT * FROM tabel_berita ORDER BY id_berita ASC") or die (mysql_error()); 
?>
<script type="text/javascript" src="assets/jqueryeasyticker/jquery.easing.min.js"></script>
<script type="text/javascript" src="assets/jqueryeasyticker/jquery.easy-ticker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var dd = $('.newsheadline').easyTicker({
		direction: 'up',
		easing: 'easeInOutBack',
		speed: 'slow',
		interval: 3000,
		height: 'auto',
		visible: 3,
		mousePause: 0,
	}).data('easyTicker');	
	
});
</script>

<style>

.newsheadline ul{
	padding: 0;
    width: 80%;
}
.newsheadline li{
	list-style: none;
	border-bottom: 1px solid green;
	
}
hr , h2{margin: 5px 0;}
.et-run{
	background: red;
}
</style>
<div id="page-wrapper" >
<div id="page-inner">
                              
                 <!-- /. ROW  -->
                
                 <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <h3><?php echo $rowA["judul"]; ?></h3>
                          <hr />
                        <span><?php echo tglindonesia($rowA["datetime"]); ?></span>
                        
                        <p>
                        <img  class="img-responsive center-block" style="width: 60%;" />
                        <img class="img-responsive pull-left" style="margin:0 10px 10px 0;" src="<?php echo $rowA["gambar"] == "" ? "images/berita/no-preview.png" : "images/berita/".$rowA["gambar"] ?>"  /><?php echo $rowA["isi"]; ?></p>
                    </div>
                    
                    <div class="col-md-3 col-sm-12 col-xs-12 " style="height: 50%;">
                    <h3 style="margin: 15px 0;">Hot News</h3>
                    <hr style="width: 80%;" />
                    <div class="newsheadline">
                        	<ul>
                            <?php
                            if(mysql_num_rows($sqlnews) > 0){
       				         
                            while($rownews=mysql_fetch_array($sqlnews))
       				         {
       				             ?>
                            
                        		<li>
                                    <p><a href="?detail-berita=<?php echo $rownews['id_berita']; ?>"><?php echo $rownews['judul'];?></a></p>
                                    <span><?php echo tglindonesia($rownews['datetime']);?></span>
                                    <p class="text-isi"><?php echo $rownews['sinopsis'];?></p>
                                </li>
                        	
                            <?php  } } else { ?>
                            <li> data berita kosong </li>
                            <?php } ?>
                            </ul>
                         
                        </div>
                    </div>
                    
                 </div>
   </div>
<!-- /. PAGE INNER  -->
</div>