<?php
include 'db.php';

$folder = $_GET['folder'];

$sql = "DELETE FROM qr_codes
WHERE folder = '$folder'";
  mysqli_query($conn, $sql);
echo "<script> window.location = 'index.php'; </script>";
?>

