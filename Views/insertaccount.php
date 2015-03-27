<?php
include 'dbconnect.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);


$sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";

$result=mysqli_query($link, $sql);

$count=mysqli_num_rows($result);


if($count==1){
	$sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
	$result=mysqli_query($link, $sql);
	$count=mysqli_num_rows($result);
	
	session_start();
	$_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
	if($count==1)
	$_SESSION['position'] = 'admin';
	$website = "view inventory.php";
	header("Location:$website ");
}
else {
	session_start();
	$_SESSION['error'] = 'wrong username or password';
	header("Location: login.php");
}

?>