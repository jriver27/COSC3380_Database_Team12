<?php
// positions
//1=Nurse
//2=Doctor
//3=Medical_Admin
//4=Admin
//5=SuperAdmin
$var = $_SESSION['position'];

$openDiv = '<div class="container-fluid"><nav><ul class="nav nav-justified">';
$closeDiv = '<li><a href="php/logout.php">Log out</a></li></ul></nav></div>';

$lowCredentials = '<li class="active"> <a href="restrictedIndex.php">Home</a>
            <li><a href="viewInventory.php">View Inventory</a></li>
            <li><a href= "inventoryCheckIn.php">Check In Inventory</a></li>
            <li><a href="inventoryCheckOut.php">Check Out Inventory</a></li>
            <li><a href="allergyCheck.php">Allergy Lookup</a></li>';

$highCredentials = '<li><a href="createPO.php">Create Purchase Order</a></li>
            <li><a href="adminDashboard.php">View Dashboard</a></li>';
			<li><a href= "AddItem.php">Add Inventory</a></li>

$adminCredentials = '<li class="active"><a href="createAccount.php">Account Options</a></li>';

if($var == 1 || $var == 2)//
{
echo $openDiv.$lowCredentials.$closeDiv;
}
elseif($var == 3){
echo $openDiv.$lowCredentials.$highCredentials.$closeDiv;
}
elseif($var>= 4){
    echo $openDiv.$lowCredentials.$highCredentials.$adminCredentials.$closeDiv;
}