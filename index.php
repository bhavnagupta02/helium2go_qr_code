<?php
error_reporting(0);
include 'db.php';

    $qry = "SELECT * FROM qr_login";
    $run = mysqli_query($conn, $qry);
    $data = mysqli_fetch_assoc($run);
    $pass = $data['password'];
    $key = $_GET['key'];
if($key != $pass){
   echo "<script>"."window.location = 'login.php'"."</script>"; 
}

function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
}

if(isset($_POST['submit'])){
	$cylinder = $_POST['cylinder']; 
	$images_number = $_POST['images_required'];
	$height = $_POST['height'];
	$width = $_POST['width'];
	$save_qr_code = $_POST['save'];
	$folder_name = $_POST['folder_name'];
	$randClass = rand(1111,9999).rand_string( 5 );
	$datetime = date('Y-m-d H:i:s');
    $output_encoding = "UTF-8"; //UTF-8[Default], Shift_JIS, ISO-8859-1
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    .qr-bottom {
	text-align: center;
	font-size: 11px;
}
.qr-top {
	text-align: center;
	font-size: 14px;
}
.qr-img {
	text-align: center;
}
</style>

		<h2>QR Code Generator</h2>
		<form method="post" action="">
		<div class="qr-generator-form">
		Select Your Cylinder: 
		<select name="cylinder" required>
		<option value="">Helium2Go</option>
		<option value="25">25</option>
		<option value="50">50</option>
		<option value="75">75</option>
		<option value="100">100</option>
		<option value="150">150</option>
		<option value="200">200</option>
		<option value="250">250</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="750">750</option>
		<option value="1000">1000</option>
		<option value="1250">1250</option>
		<option value="1500">1500</option>
		</select>
		<br><br>
		How many QR Codes required: <input type="number" name="images_required" required>
		<br><br>
		QR Code height: <input type="number" name="height" placeholder="eg: 100" required>px &nbsp;|&nbsp;  QR Code width: <input type="number" name="width" placeholder="eg: 100" required>px 
		<br><br>
		Save QR Codes: <input type="radio" name="save" id="save_yes" value="yes" checked="checked">Yes &nbsp;&nbsp; 
		<input type="radio" name="save" id="save_no" value="no">No 
		<br>
		<div id="qr_folder_name">
		Folder name for QR Codes Images: <input type="text" name="folder_name" id="folder_name"> 
		</div>
		<br><br>
		<input type="submit" name="submit" value="Generate">
		</div>
		</form>


		<?php
		 if(!empty($cylinder)){
		  for($i=0; $i<$images_number; $i++){
			$randClass = rand(1111,9999).rand_string( 5 ).$i;
			$timestamp = date('Ymd');
			$qr_generated_number = "H2GOCYL".$cylinder."-".$randClass.$timestamp;
			$qr_code_image = "https://chart.googleapis.com/chart?chs=$heightx$width&cht=qr&chl=$qr_generated_number&choe=$output_encoding";	
		?>
		<div class="col-md-3">
		   <div id="print<?php echo $i;?>">
		    <div class="qr-top"><b>Helium2go.com.au</b></div>
			<div class="qr-img"><img class="qr-image" src=<?php echo $qr_code_image;?> /></div>
			<div class="qr-bottom"><b><?php echo $qr_generated_number; ?></b></div>
			</div>
		</div>

<?php
if($save_qr_code == "yes"){
$sql = "INSERT INTO qr_codes (qr_code_img, cylinder_unique_id, folder, date_time )
  VALUES ('$qr_code_image', '$qr_generated_number', '$folder_name', '$datetime')";
  mysqli_query($conn, $sql);
  $img =  file_get_contents($qr_code_image);
  if (!is_dir('qr_images/' . $folder_name)) {
  // dir doesn't exist, make it
   mkdir('qr_images/' . $folder_name);
}
  $folder = "qr_images/$folder_name/$qr_generated_number.jpg";
  file_put_contents($folder, $img);
  $action = "success";
} } } ?>
	<div class="upload-images">
	  <h3>Previous Uploaded QR Codes:</h3>
	   <div class="folder-list">
	   <?php
		$sql1 = "SELECT DISTINCT folder FROM qr_codes";
		$query = mysqli_query($conn, $sql1);
         $i = 1; ?>
        <div class="uploaded-folders">		 
		<?php while($fetch = mysqli_fetch_assoc($query)){
		   echo $i." "; ?>
		  <a href="qr_code_images.php?folder=<?php echo $fetch['folder']; ?>"><?php echo $fetch['folder']; ?> </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="delete.php?folder=<?php echo $fetch['folder'];?>">Delete</a>
           <?php echo "<br><br>";
		   $i++;
		  } 
		?>
		</div>
	   </div>
	</div>
<script>
function show()
 {	  
       var div = document.getElementById("qr_folder_name");
       div.style.display = "block";
 }
 function hide()
 {
       var div = document.getElementById("qr_folder_name");
       div.style.display = "none";
 }
</script>
