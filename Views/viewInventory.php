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
    <title>Inventory</title>
    <link rel="stylesheet" type="text/css" href="../Site.css"/>
</head>

<body>
<div id="header">
    <h1>View Medical Inventory</h1>
</div>
<div id="leftMenuContainer" >
    <ul class="navigation">
        <li><a href="viewInventory.php">View Inventory</a>
        <li><a href= "InventoryCheckIn.php">Check In Inventory</a>
        <li><a href="InventoryCheckOut.php">Check Out Inventory</a>
        <li><a href="Logout.php">Log out</a>
    </ul>
</div>
<div id="tableContainer">
    <table>
        <?php
        include 'dbconnect.php';

        $sql="SELECT * FROM $tbl_name";
        $query = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($query))
        {
            echo '<tr>';
            echo "<tr><td>".($row['Username'])."</td></tr>";
            echo '</tr>';
        }
        ?>
    </table>

    <table><span > THIS IS WHERE WE WILL HAVE OUR INVENTORY</span> </table>

</div>

<div id="footer">
    <span> Please Contact Us anytime.</span>
    <a href="RestrictedIndex.php">Members Only Area</a>
    <a href="logout.php">Logout</a>
</div>

</body>

</html>