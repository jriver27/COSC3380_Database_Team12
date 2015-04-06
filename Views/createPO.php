<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true  &&  (int)$_SESSION['position'] >= 2) {
     echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
     header("Location: ../index.php");
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
    include 'php/dbconnect.php';

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
    include 'php/dbconnect.php';

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


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="../../favicon.ico" rel="icon">
    <title>Medical Inventory Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>

<body>
<div class="page-header">
    <div class="navbar-default">
        <div class="navbar-header"></div>
        <h3 class="h3">
            Purchase Order
        </h3>
        <?php
        include 'php/nav_byUserPosition.php';
        ?>
    </div>
</div>

<div class = "container">
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
     <div>
        <p>Item Count:</p>
        <p><input type="number" name="ItemCount" min="1"></p>

        <p><INPUT TYPE = "Submit" Name = "Submit" VALUE = "Submit"></p>
    </div>
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
<?php
include 'php/footer.php';
?>
</body>

</html>