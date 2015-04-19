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
}?>