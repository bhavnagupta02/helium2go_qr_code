<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="html2canvas.js"></script>
<style>
    .qr-bottom {
	text-align: center;
	font-size: 15px;
}
.qr-top {
	text-align: center;
	font-size: 14px;
}
.qr-img {
	text-align: center;
}
.qr-img-download {
	text-align: center;
}
.qr-bottom {
	font-size: 11px;
}
#newimg {
	border: 1px solid #cccccc;
}
</style>
<?php
include 'db.php';
$folder = $_GET['folder'];
?>
<h2 style="text-align: center;"><?php echo $folder;?></h2>
<div class="container">
 <div class="col-md-4">
   <span class="pull-left">
      <h3>Download modified Image</h3>
    <div id="img" style="display:none; background-color: #ffffff;">
      <img src="" id="newimg" />
    </div>
  </span>
 </div>
<div class="col-md-7">
<span class="pull-right">
<div class="modified_images">
    <div class="main-block">
  <?php $sql = "SELECT * FROM qr_codes WHERE folder = '$folder'";
        $query = mysqli_query($conn, $sql);
		$i = 0;
		while($fetch = mysqli_fetch_assoc($query)){
		$img = "https://helium2go.com.au/qr-code-generator/qr_images/".$fetch['folder']."/".$fetch['cylinder_unique_id'].".jpg";
   ?>
    <div id="print<?php echo $i;?>">
        <div class="qr-top"><b>Helium2go.com.au</b></div>
	   	<div class="qr-img"><img class="qr-image" id="qr_code_image_<?php echo $i;?>" src=<?php echo $img;?> /></div>
	  	<div class="qr-bottom"><b><?php echo $fetch['cylinder_unique_id'];?></b></div>
	</div>	
	 	<!--<div class="qr-img-download"><button class="save-img" id="btnSave<?php echo $i;?>">save</button></div>-->
			<br><br>
		</div>
	<script>
$(function(){
  $("#btnSave<?php echo $i;?>").click(function(){
     html2canvas($("#print<?php echo $i;?>"), {
	    onrendered: function(canvas) {
	       var imgsrc = canvas.toDataURL("image/png");
	       console.log(imgsrc);
	       $("#newimg").attr('src',imgsrc);
	       $("#img").show();
        }
     });
  });  
  });
</script>
	<?php $i++; } ?>
	</div>
	</span>
  </div>
</div>
</div>
