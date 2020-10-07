<?php
$hostname = "localhost";
$database = "lifestyl_vendor";

if($_SERVER['HTTP_HOST']=="localhost"){
	$username = "root";
	$password = "";
} else {
	$username = "lifestyl_vendor";
	$password = "lifestyl_vendor@321";
}
$conn = mysqli_connect("localhost",$username,$password,$database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = 'UPDATE connect set userpass="'.md5($_POST["password"]).'" where id="'.$_COOKIE["dbid"].'"';
    //echo $sql; die;
	
if ($conn->query($sql) === TRUE) {
    echo "Password Changed successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
  
  mysqli_close($conn);
}
?>