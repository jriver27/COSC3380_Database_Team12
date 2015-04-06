<?php
$var = $_SESSION['position'];

if($var == 1)
{
echo '<div class="container-fluid">
    <nav>
        <ul class="nav nav-justified">
            <li class="active"> <a href="RestrictedIndex.php">Home</a>
            <li> <a href="viewInventory.php">View Inventory</a></li>
            <li><a href= "inventoryCheckIn.php">Check In Inventory</a></li>
            <li><a href="inventoryCheckOut.php">Check Out Inventory</a></li>

            <li><a href="php/logout.php">Log out</a></li>
        </ul>
    </nav>
</div>';
}
elseif($var == 2){
echo '<div class="container-fluid">
    <nav>
        <ul class="nav nav-justified">
            <li class="active"> <a href="RestrictedIndex.php">Home</a>
            <li> <a href="viewInventory.php">View Inventory</a></li>
            <li><a href= "inventoryCheckIn.php">Check In Inventory</a></li>
            <li><a href="inventoryCheckOut.php">Check Out Inventory</a></li>
            <li><a href="php/logout.php">Log out</a></li>
        </ul>
    </nav>
</div>';
}
elseif($var == 3){
echo'<div class="container-fluid">
    <nav>
        <ul class="nav nav-justified">
            <li class="active"> <a href="RestrictedIndex.php">Home</a>
            <li> <a href="viewInventory.php">View Inventory</a></li>


             <li><a href="createPO.php">Create Purchase Order</a></li>
             <li><a href="adminDashboard.php">View Dashboard</a></li>
            <li><a href="php/logout.php">Log out</a></li>
        </ul>
    </nav>
</div>';
}
elseif($var== 4){
    echo'<div class="container-fluid">
    <nav>
        <ul class="nav nav-justified">
            <li class="active"> <a href="RestrictedIndex.php">Home</a>
            <li class="active"><a href="createAccount.php">Create an Account</a></li>
            <li> <a href="viewInventory.php">View Inventory</a></li>


             <li><a href="createPO.php">Create Purchase Order</a></li>
             <li><a href="adminDashboard.php">View Dashboard</a></li>
            <li><a href="php/logout.php">Log out</a></li>
        </ul>
    </nav>
</div>';
}