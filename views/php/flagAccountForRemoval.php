<?php
include 'dbconnect.php';

$firstName = trim($_POST['inputFirstName']);
$lastName = trim($_POST['inputLastName']);
$userName = trim($_POST['inputUserName']);

$sql="SELECT username FROM users WHERE username='$userName'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);

if($count==1){
    $sql="UPDATE users SET HasAccess= 0 WHERE username= '$userName';";
    if ($link->query($sql) === TRUE) {
        echo "<script>
        alert('The User is now flagged for removal!!!!!!')
        window.location.href='../removeAccount.php'
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
        echo "<script>
        alert('Error User not Flagged!!!!!!')
        window.location.href='../removeAccount.php'
        </script>";
    }
}
else if($count ==0) {
    echo "<script>
    alert('Error User was not found!!!')
    window.location.href='../removeAccount.php'
    </script>";
}
?>