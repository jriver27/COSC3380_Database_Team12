<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
     echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
     header("Location: login.php");
    }

?>


<?php


// define variables and set to empty values
$username = $SKU = $description = $manufacturer = $count = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   //$username = test_input($_POST["name"]);
   $SKU = test_input($_POST["item"]);
   //$description = test_input($_POST["website"]);
   //$manufacturer = test_input($_POST["comment"]);
   $count = test_input($_POST["ItemCount"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function get_manufacturer($manufacturer_num)
{
	//connect to the database
	include "dbconnect.php";

	// Check connection
	if ($link->connect_error) {
    		die("Connection failed: " . $link->connect_error);
 	} 

	$sql = "SELECT Manufacturer FROM item_manufacturer WHERE id = '$manufacturer_num'";
	$result = $link->query($sql);

	if ($result->num_rows > 0) {
    		// use the first row
   		$row = $result->fetch_assoc();
		$manufacturer_name = $row["Manufacturer"];
		
	}
	else {
    		$manufacturer_name = "Manufacturer Not Found";
	}
	
	return $manufacturer_name;
}

function create_purchase_order($SKU, $count, $purchaser)
{
	//connect to the database
	include "dbconnect.php";

	// Check connection
	if ($link->connect_error) {
    		die("Connection failed: " . $link->connect_error);
 	} 

	$timestamp = time();

	$sql = "INSERT INTO purchase_order_log (SKU, DATETIME, COUNT, PURCHASER) VALUES ('$SKU','$timestamp','$count','$purchaser')";
	if ($link->query($sql) === TRUE) {
   		echo "New Purchase Order created successfully";
	} else {
    		echo "Error: " . $sql . "<br>" . $link->error;
	}
}

?>


<html>

<head lang="en">
    <title>Medical Inventory Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>

<body>
<div class="container">
    <div class="masthead">
        <h3 class="text-muted">
            Purchase Order
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

<div id="main">


<p>Select Item</p>


<form method="post">
<p>
<select name="item">

<?php
	//connect to the database
	include "dbconnect.php";

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
 } 

$sql = "SELECT DISTINCT SKU, Description, Manufacturer FROM item";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo "<option value=".$row["SKU"].">". $row["Description"] . '</option>'."\n";
	$manufacturer[$row["SKU"]] = $row["Manufacturer"];
	$description[$row["SKU"]] =$row["Description"];
	}
} else {
    echo "No items in the database";
}

 ?> 

</select>
</p>
 
<p>Item Count:</p>
<p><input type="number" name="ItemCount" min="1"></p>

<p><INPUT TYPE = "Submit" Name = "Submit" VALUE = "Submit"></p>

</form>

<?php
if(isset($_POST['Submit']))
{
echo "<h3>Purchase Order Submitted</h3>";
echo "<br>";
echo "Requestor: ";
echo $_SESSION['username'];
echo "<br>";
echo "SKU: ";
echo $SKU;
echo "<br>";
echo "Description: ";
echo $description[$SKU];
echo "<br>";
echo "Manufacturer: ";
echo get_manufacturer($manufacturer[$SKU]);
echo "<br>";
echo "Count: ";
echo $count;
echo "<br>";
create_purchase_order($SKU, $count, $_SESSION['username']);
}
?>

</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
    </div>
</footer>
</body>

</html>