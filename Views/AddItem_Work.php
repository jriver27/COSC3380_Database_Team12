<?php
$username = $SKU = $description = $manufacturer = $count = $PO_num = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $PO_num = getInput($_POST["item"]);
}

function getInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function insert_item($PO_num)
{
    if($PO_num<=0)
	{
		return($PO_num);
	}
	
	include 'php/dbconnect.php';
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }
	
	
	
	$Insert_OK=TRUE;
    $sql = "SELECT SKU, Count FROM purchase_order_log WHERE PONumber = '$PO_num'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        // use the first row
        $row = $result->fetch_assoc();
        $SKU = $row["SKU"];
		$Count = get_stock_count($SKU);
		$PO_Count= $row["Count"];

		
	
		if (is_consumable($SKU))
		{
			//Is consumable
			$sql = "UPDATE item SET Stock_Count=Stock_Count+$PO_Count WHERE item.SKU=$SKU";
			$result = $link->query($sql);
			
			$sql = "SELECT Description, Manufacturer FROM item WHERE SKU = $SKU";
				$result = $link->query($sql);
				
				if ($result->num_rows > 0) {
					// use the first row
					$row = $result->fetch_assoc();
					$Description = $row["Description"];
					$Manufacturer = $row["Manufacturer"];
			
						echo "<h3>Consumable Item Updated</h3>";
						echo "<br>";
						echo "Description: ";
						echo $Description;
						echo "<br>";
						echo "Manufacturer: ";
						echo get_manufacturer($Manufacturer);
						echo "<br>";
						echo "SKU: ";
						echo $SKU;
						echo "<br>";
						echo "Stock Count: ";
						echo $Count;
						echo "<br>";
				}
				else {
					//Database error
					$Insert_OK=FALSE;
				}
		}
		else
		{
			//Not consumable

			
			for($i=1; $i<=$PO_Count; $i++)
			{
				$Serial_Number=get_serial_number();
				

				
				$sql = "SELECT Description, Manufacturer FROM item WHERE SKU = $SKU";
				$result = $link->query($sql);
				
				if ($result->num_rows > 0) {
					// use the first row
					$row = $result->fetch_assoc();
					$Description = $row["Description"];
					$Manufacturer = $row["Manufacturer"];
					

					
					$sql = "INSERT INTO item (Description, Manufacturer, Serial_Number, SKU, Stock_Count) VALUES ('$Description', '$Manufacturer', '$Serial_Number', '$SKU', 1)";
					if ($link->query($sql) === TRUE) 
					{
						echo "<h3>Equipment Entered</h3>";
						echo "<br>";
						echo "Description: ";
						echo $Description;
						echo "<br>";
						echo "Manufacturer: ";
						echo get_manufacturer($Manufacturer);
						echo "<br>";
						echo "Serial Number: ";
						echo $Serial_Number;
						echo "<br>";
						echo "SKU: ";
						echo $SKU;
						echo "<br>";
						echo "Stock Count: ";
						echo $Count;
						echo "<br>";
					} 
					else 
					{
						$Insert_OK=FALSE;
						echo "Error: " . $sql . "<br>" . $link->error;
					}
				}
				else {
					//Database error
					$Insert_OK=FALSE;
				}
			}
		}

    }
    else {
        //error PO number not found
		$Insert_OK=FALSE;
    }
	
	if($Insert_OK==TRUE)
	{
		close_PO($PO_num);
	}
	
    return $PO_num;
}

function is_consumable($SKU)
{
	include 'php/dbconnect.php';
	$sql = "SELECT Serial_Number FROM item WHERE SKU = '$SKU'";
	$result = $link->query($sql);

	if ($result->num_rows > 0) 
	{
        	// use the first row
        	$row = $result->fetch_assoc();
        	$Num = $row["Serial_Number"];
			
			if($Num > 0)
			{
				return(0);
			}
			
			else
			{
				return(1);
			}
	}

    else {
        //error SKU not found
    }
}

function get_stock_count($SKU)
{
	include 'php/dbconnect.php';
	$sql = "SELECT Stock_Count FROM item WHERE SKU = '$SKU'";
	$result = $link->query($sql);

	if ($result->num_rows > 0) 
	{
        	// use the first row
        	$row = $result->fetch_assoc();
        	$Count = $row["Stock_Count"];
			return $Count;
	}

    else {
        //error SKU not found
    }
}

function get_serial_number()
{
	$Number=0;
	
	include 'php/dbconnect.php';
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    $sql = "SELECT MAX(Serial_Number) FROM item";
    $result = $link->query($sql);
	
	if ($result->num_rows > 0) 
	{
        	// use the first row
        	$row = $result->fetch_assoc();
        	$Number = $row["MAX(Serial_Number)"];
			$Number++;
	}

    else {
        //error SKU not found
    }
	
	return $Number;
}

function get_manufacturer($manufacturer_num)
{
    include 'php/dbconnect.php';
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

function close_PO($PO)
{
	include 'php/dbconnect.php';
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }
	
	$sql = "UPDATE purchase_order_log SET Open_PO=FALSE WHERE PONumber=$PO";
			$result = $link->query($sql);
}

?>
