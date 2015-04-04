
<?php
$var = $_SESSION['position'];
echo $var;
echo '<div class="container-fluid">
        <nav>
            <ul class="nav nav-justified">
                <li class="active"> <a href="RestrictedIndex.php">Home</a>
                <li class="active"><a href="createaccount.php">Create an Account</a></li>
                <li> <a href="viewInventory.php">View Inventory</a></li>
                <li><a href= "InventoryCheckIn.php">Check In Inventory</a></li>
                <li><a href="InventoryCheckOut.php">Check Out Inventory</a></li>
		        <li><a href="PurchaseOrder.php">Create Purchase Order</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </nav>
    </div>';