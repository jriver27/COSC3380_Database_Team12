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
        <h1>Medical Inventory Login</h1>
    </div>
<?php
    echo "My first PHP script!";
?>
    <div id="leftMenuContainer" >
        <ul class="navigation">
            <li><a href="../index.php">Home Page</a>
            <li><a href= "AboutUs.php">About Us</a>
            <li><a href="ContactUs.php">Contact Us</a>

            <li><a href="viewInventory.php">View Inventory</a>
            <li><a href= "InventoryCheckIn.php">Check In Inventory</a>
            <li><a href="InventoryCheckOut.php">Check Out Inventory</a>
            <li><a href="Logout.php">Log out</a>
        </ul>
    </div>
    <div id="footer">
        <span> Please Contact Us anytime.</span>
    </div>
</body>

</html>