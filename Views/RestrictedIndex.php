<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
   header("Location: ../index.php");
}

?>
<html>

<head lang="en">
    <title>Medical Inventory Login</title>
    <link rel="stylesheet" type="text/css" href="../Site.css"/>
</head>

<body>
    <div id="header">
        <h1>Medical Inventory Login</h1>
    </div>

    <div id="leftMenuContainer" >
        <ul class="navigation">
            <li><a href="createaccount.php">Create an Account</a>
            <li><a href="viewInventory.php">View Inventory</a>
            <li><a href= "InventoryCheckIn.php">Check In Inventory</a>
            <li><a href="InventoryCheckOut.php">Check Out Inventory</a>
            <li><a href="Logout.php">Log out</a>
        </ul>
    </div>
    <div id="footer">
        <span> Please Contact Us anytime.</span>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>