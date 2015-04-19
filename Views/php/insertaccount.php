<?php
include 'dbconnect.php';

$firstName = trim($_POST['inputFirstName']);
$lastName = trim($_POST['inputLastName']);
$userName = trim($_POST['inputUserName']);
$password = trim($_POST['inputPassword']);
$position = (int)trim($_POST['inputPosition']);

$sql="SELECT username FROM users WHERE username='$userName'";
$result=mysqli_query($link, $sql);
$count=mysqli_num_rows($result);

if($count==0){
    $sql="INSERT INTO users (Username, Password, FirstName, LastName, Position) VALUES ('$userName', '$password', '$firstName', '$lastName','$position');";
    if ($link->query($sql) === TRUE) {
        echo '<script>
        alert("New User Created!!")
        window.location.href="../createAccount.php"
        </script>
       <div class="media-middle">Error: " . $sql . "<br>" . $link->error </div>';
    } else {
        echo "<script>
        alert('Error User not Created !!')
        window.location.href='../createAccount.php'
        </script>
       <div class='media-middle'>Error: ' . $sql . '<br>' . $link->error </div>
        ";
    }
}
else if($count>=1){
    echo '<script>
        alert("Error Username is in use!!")
        window.location.href="../createAccount.php"
        </script>
       <div class="media-middle">Error: " . $sql . "<br>" . $link->error </div>';
}
?>