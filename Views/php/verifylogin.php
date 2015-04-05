<?php
include 'dbconnect.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$sql="SELECT Username, Position  FROM users WHERE username='$username' and password='$password'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);

if($count==1){
	session_start();
    $obj = mysqli_fetch_object($result);
	$_SESSION['loggedin'] = true;
    $_SESSION['username'] = $obj->Username;
    $_SESSION['position'] = $obj->Position;

    $website = "../RestrictedIndex.php";
	header("Location:$website ");
}
else {
	session_start();
	$_SESSION['error'] = 'wrong username or password';
	header("Location: ../../index.php");
}
mysqli_free_result($result);
?>