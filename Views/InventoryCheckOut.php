<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: login.php");
}

?>
<html>

<head lang="en">
    <title>Inventory Check Out</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>

<body>
<div class="container">
    <div class="masthead">
        <h3 class="text-muted">
            Inventory Checkout
        </h3>
        <?php
        include 'php/nav_byUserPosition.php';
        ?>
    </div>
</div>
    <div class="container-fluid">
        <table class="table">
            <?php
            include 'php/dbconnect.php';

            $sql="SELECT * FROM $tbl_name";
            $query = mysqli_query($link, $sql);

            while($row = mysqli_fetch_array($query))
            {
                echo '<tr>';
                    echo "<tr><td>".($row['Username'])."</td></tr>";
                echo '</tr>';
            }
            ?>
        </table>
    </div>
<footer class="footer">
    <div class="container">
        <p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
    </div>
</footer>
</body>

</html>
