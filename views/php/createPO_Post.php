<?php
$username = $SKU = $description = $manufacturer = $count = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SKU = getInput($_POST["item"]);
    $count = getInput($_POST["ItemCount"]);
}

function getInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

function create_purchase_order($SKU, $count, $purchaser)
{
    include 'php/dbconnect.php';

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
