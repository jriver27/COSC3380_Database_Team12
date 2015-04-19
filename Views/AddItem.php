<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: ../login.php");
}

?>

<?php
    include 'php/AddItem_Work.php'
?>

<html>

<head lang="en">
    <title>Add Item</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>

<body>
<div class="page-header">
    <div class="navbar-default">
        <div class="navbar-header"></div>
        <h3 class="h3">
                Add Item
            </h3>
                <?php
                include 'php/nav_byUserPosition.php';
                ?>
        </div>
</div>
<div class = "container-fluid">
    <table class = "table">
    <tr><td>PO Number</td><td>SKU</td><td>Description</td><td>Manufacturer</td><td>Date</td><td>Count</td><td>Purchaser</td></tr>
    <?php
        include 'php/dbconnect.php';
    $sql="SELECT purchase_order_log.PONumber, purchase_order_log.SKU, I.Description, item_manufacturer.Manufacturer, purchase_order_log.DATETIME, purchase_order_log.Count, purchase_order_log.Purchaser from purchase_order_log, (SELECT DISTINCT SKU, Manufacturer, Description From item)AS I, item_manufacturer where purchase_order_log.SKU=I.SKU and I.Manufacturer=item_manufacturer.ID order by purchase_order_log.PONumber ";
    $query = mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($query))
    {
        
        echo '<tr>';
        echo "<td>".($row['PONumber'])."</td>"."<td>".($row['SKU'])."</td>"."<td>".($row['Description'])."</td>"."<td>".($row['Manufacturer'])."</td>"."<td>".(date('m/d/Y',($row['DATETIME'])))."</td>"."<td>".($row['Count'])."</td>"."<td>".($row['Purchaser'])."</td>";
        echo '</tr>';
    }
    ?>
    </table>
</div>

<div class = "container">
    <form class="form-group" method="post">
        <div><label for="item"> Select Purchase Order:</label></div>
        <div class="dropdown">
            <select name="item" id="item">
                <?php
                    include "php/getAllPOsInDropDownMenu.php";
                ?>
        </select>
        </div>
        <div class="btn">
        <INPUT TYPE = "Submit" Name = "Submit" VALUE = "Submit">
        </div>
</form>

<?php
if(isset($_POST['Submit']))
{
    insert_item($PO_num);

	
    
}
?>

</div>

    <?php
    include 'php/footer.php';
    ?>
</body>
</html>
