<?php
include 'dbconnect.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$sql="SELECT users.Username, user_position.Position FROM users JOIN user_position ON users.position = user_position.ID WHERE users.Username='$username' and users.password='$password'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);

if($count==1){
	session_start();
    $obj = mysqli_fetch_object($result);
	$_SESSION['loggedin'] = true;
    $_SESSION['username'] = $obj->Username;
    $_SESSION['position'] = $obj->Position;

    $website = "RestrictedIndex.php";
	header("Location:$website ");
}
else {
	session_start();
	$_SESSION['error'] = 'wrong username or password';
	header("Location: ../index.php");
}
mysqli_free_result($result);
?>
