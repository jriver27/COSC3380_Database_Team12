<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && (int)$_SESSION['position'] < 3) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: login.php");
}

?>
<html lang="en">
<head >
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="../../favicon.ico" rel="icon">
    <title>Check In Inventory</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>
<body>
    <div class="page-header">
        <div class="navbar-default">
            <div class="navbar-header"></div>
            <h3 class="h3">
                    Inventory Check In
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
                    echo "<td>".($row['Username'])."</td>";
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