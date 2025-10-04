<?php
// $database = "heliumgo_wp1";
// $servername = "localhost";
// $username = "heliumgo_wp1";
// $password = "R[a(wl30^KJ~70@jbG^83[^7";
// Localhost DB Connection
$database = "heliumgo_qr_code";
$servername = "localhost";
$username = "root";
$password = "";


// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($conn, $database);
?>