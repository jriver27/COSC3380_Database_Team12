<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
     echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
     header("Location: login.php");
    }

?>

<html>

<head lang="en">
    <title>Medical Inventory Login</title>
    <link rel="stylesheet" type="text/css" href="../Site.css"/>
</head>

<body>
    <div id="header">
        <h1>Template page</h1>
    </div>



    <div id="footer">
        <span> Please Contact Us anytime.</span>
    </div>
</body>

</html>