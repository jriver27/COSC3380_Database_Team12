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
    <title>Inventory Check Out</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>

<body>
<div class="container">
    <div class="masthead">
        <h3 class="text-muted">
            Inventory Checkout
        </h3>
        <nav>
            <ul class="nav nav-justified">
                <li class="active"> <a href="RestrictedIndex.php">Home</a>
                <li class="active"><a href="createaccount.php">Create an Account</a></li>
                <li> <a href="viewInventory.php">View Inventory</a></li>                      </li>
                <li><a href= "InventoryCheckIn.php">Check In Inventory</a></li>
                <li><a href="InventoryCheckOut.php">Check Out Inventory</a></li>
		        <li><a href="PurchaseOrder.php">Create Purchase Order</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </nav>
    </div>
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
    </div>
<footer class="footer">
    <div class="container">
        <p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
    </div>
</footer>
</body>

</html>
