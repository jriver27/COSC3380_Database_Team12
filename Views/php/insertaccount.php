<?php
include 'dbconnect.php';

$firstName = trim($_POST['inputFirstName']);
$lastName = trim($_POST['inputLastName']);
$userName = trim($_POST['inputUserName']);
$password = trim($_POST['inputPassword']);
$position = trim($_POST['inputPosition']);


$sql="SELECT username FROM users WHERE username='$username'";

$result=mysqli_query($link, $sql);

$count=mysqli_num_rows($result);


if($count==1){
	$sql="INSERT INTO dbteam12.users (Username, Password, First Name, Last Name, Position) VALUES ($username, $password, $firstName, $lastName, $position);";
	$result=mysqli_query($link, $sql);
	$count=mysqli_num_rows($result);
	
	session_start();
	$_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
	if($count==1)
	$_SESSION['position'] = 'admin';
	$website = "RestrictedIndex.php";
	header("Location:$website ");
}
else {
	session_start();
	$_SESSION['error'] = 'wrong username or password';
	header("Location: login.php");
}
?>