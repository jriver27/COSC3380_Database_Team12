<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: ../login.php");
}

?>
<html>

<head lang="en">
    <title>Inventory</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>

<body>
<div class="page-header">
    <div class="navbar-default">
        <div class="navbar-header"></div>
        <h3 class="h3">
                View Inventory
            </h3>
                <?php
                include 'php/nav_byUserPosition.php';
                ?>
        </div>
</div>
<div class = "container-fluid">
    <table class = "table">
    <tr><th>SKU</th><th>Description</th><th>Manufacturer</th><th>Stock</th></tr>
    <?php
        include 'php/dbconnect.php';
    $sql="SELECT SKU, Description, im.manufacturer As Manufacturer, SUM(IFNULL(Stock_Count, 1)) Stock_Count
          from item i LEFT JOIN item_manufacturer im ON i.Manufacturer=im.ID
          GROUP BY SKU, Description, i.manufacturer";
    $query = mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($query))
    {
        echo '<tr>';
        echo "<td>".($row['SKU'])."</td>"."<td>".($row['Description'])."</td>"."<td>".($row['Manufacturer'])."</td>"."<td>".($row['Stock_Count'])."</td>";
        echo '</tr>';
    }
    ?>
    </table>
</div>
    <?php
    include 'php/footer.php';
    ?>
</body>
</html>
