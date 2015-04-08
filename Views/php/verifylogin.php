<?php
include 'dbconnect.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$sql="SELECT Username, Position, HasAccess  FROM users WHERE username='$username' and password='$password'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);

if($count==1){
    $obj = mysqli_fetch_object($result);
    if($obj->HasAccess != 0) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $obj->Username;
        $_SESSION['position'] = $obj->Position;
        $website = "../restrictedIndex.php";
        header("Location:$website ");
    }
    else{
        session_start();
        $_SESSION['error'] = 'wrong username or password';
        header("Location: ../../index.php");
    }
}
else {
	session_start();
	$_SESSION['error'] = 'wrong username or password';
	header("Location: ../../index.php");
}
mysqli_free_result($result);
?>
