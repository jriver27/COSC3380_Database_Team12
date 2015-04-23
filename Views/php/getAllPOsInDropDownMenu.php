<?php
	//connect to the database
	include "dbconnect.php";
	// Check connection
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	$sql = "SELECT PONumber FROM purchase_order_log WHERE Open_PO=TRUE";
	$result = $link->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<option value=".$row["PONumber"].">". $row["PONumber"]. '</option>'."\n";
		}
		} else {
		//There are no open purchase orders
	}?>	