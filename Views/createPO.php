<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true  &&  (int)$_SESSION['position'] > 2) {
     echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
     header("Location: ../index.php");
    }
?>

<?php
    include 'php/createPO_Post.php'
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
    <form class="form-group" method="post">
        <div><label for="item"> Select Item:</label></div>
        <div class="dropdown">
            <select name="item" id="item">
                <?php
                    include "php/getAllItemsInDropDownMenu.php";
                ?>
        </select>
        </div>
         <div class="input-group">
             <div><label for="ItemCount"> Item Count:</label></div>
             <input class="input-group-sm" type="number" name="ItemCount" id="ItemCount" min="1">
         </div>
        <div class="btn">
        <INPUT TYPE = "Submit" Name = "Submit" VALUE = "Submit">
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