<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
   header("Location: ../index.php");
}

?>
<html lang="en">
    <head >
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="../../favicon.ico" rel="icon">
        <title>Medical Inventory Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
    </head>

    <body>
        <div class="container">
            <div class="masthead">
                <h3 class="text-muted">
                    Medical Inventory Main
                </h3>
                <nav>
                    <ul class="nav nav-justified">
                        <li class="active">
                            <a href="../index.php">
                                Home
                            </a>
                        </li>
                        <li class="active"><a href="createaccount.php">Create an Account</a></li>
                        <li> <a href="viewInventory.php">View Inventory</a></li>                      </li>
                        <li><a href= "InventoryCheckIn.php">Check In Inventory</a></li>
                        <li><a href="InventoryCheckOut.php">Check Out Inventory</a></li>
			<li><a href="PurchaseOrder.php">File Purchase Order</a></li>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
            </div>
        </footer>
    </body>
</html>
