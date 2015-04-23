<?php
//connect to the database
include "dbconnect.php";

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$sql = "SELECT SKU, Description, Serial_Number FROM item WHERE stock_count IS NULL";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $stringToDisplay = $row["Description"]." - ".$row["Serial_Number"];
        echo "<option value=".$row['SKU']."-".$row['Serial_Number'].">".$stringToDisplay.'</option>'."\n";
    }
} else {
    echo "No item records";
}?>
