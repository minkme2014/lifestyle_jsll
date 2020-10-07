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

$conn = mysqli_connect($hostname,$username,$password,$database);
if(!$conn){
	die("Server not connected");
	
} else {

	$sql = 'SELECT * FROM connect where email="'.$_POST["email"].'" and userpass="'.md5($_POST["password"]).'"';
	$res = mysqli_query($conn, $sql);
	if (mysqli_num_rows($res) > 0) {
		$row = mysqli_fetch_assoc($res);
		$id = $row['id'];
		$email = $row['email'];
		$user= $row['dbuser'];
		$pass= $row['dbpass'];
		$db = $row['dbname'];
		$userpass = $_POST["password"];
		$result='success';
	}else{
		$id = '';
		$email = '';
		$user='';
		$pass='';
		$db='';
		$userpass='';
		$result='failure';	
	}
	setcookie("dbid", $id, 0, '/');
	setcookie("dbuser", $user, 0, '/');
	setcookie("dbpass", $pass, 0, '/');
	setcookie("dbname", $db, 0, '/');
	setcookie("dbmail", $email, 0, '/');	
	setcookie("userpass", $userpass, 0, '/');	
			
}
  echo json_encode($result);    
  mysqli_close($conn);
?>