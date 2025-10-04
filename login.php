<?php
error_reporting(0);
include 'db.php';

if(isset($_POST['submit'])){
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    
    $qry1 = "SELECT * FROM qr_login WHERE username = '$user' AND password = '$pass'";
    $run1 = mysqli_query($conn, $qry1);
    $data1 = mysqli_fetch_assoc($run1);
    if(mysqli_num_rows($run1) > 0){
       echo "<script>"."window.location = 'index.php?key=".$pass."'"."</script>";
    }
    else{
        $action = "failed";
    }
}
?>

<h2>Login Page</h2>
<?php
 if($action == "failed"){
?>
<b style="color: red;">Incorrect username/password</b>
<?php } ?>
<form method="post" action="">
<table>
    <tr><td>Username: </td><td><input type="text" name="user"></td></tr>
    <tr><td>Password: </td><td><input type="password" name="pass"></td></tr>
    <tr><td></td><td><input type="submit" name="submit" value="Login"></td></tr>
</table>
</form>