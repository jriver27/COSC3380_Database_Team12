<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true &&  (int)$_SESSION['position'] >= 3 ) {
     echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
     header("Location: login.php");
    }

?>

<html>

<head lang="en">
    <title>Medical Inventory Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
</head>

<body>
    <div class="container">
        <div class="masthead">
            <h3 class="text-muted">
                Template
            </h3>
            <?php
            include 'php/nav_byUserPosition.php';
            ?>
        </div>
    </div>

    <div class="container">

        <div class="container" style="border: double">
            <p> All Users  </p>
        </div>

        <div class="container" style="border: double">
            <p> All PO Transactions with a time selection
                example.
                view pos from date time 1/1/2015 to 3/15/2015
                Who Opened them/
                when where they open/
                Who Closed them/
                when where they closed/
            </p>
        </div>

        <div class="container" style="border: double">
            <p> All / by time / History of a selected NON Consumable Item
                example
                Between this and that time:
                Item sku " cccxxxccc333"
                Checked out by X at dd/mm/yyyy time:00:00
                Returned by X at dd/mm/yyyy time:00:00

            </p>
        </div>

        <div class="container"style="border: double">
            <p> All open PO's
                example:
                PO ID:
                Open by XXX
                Open Date:

            </p>
        </div>

        <div class="container" style="border: double">
            <p> Other Possible metrics here.</p>
        </div>

        <div>
            <p> Download as cvs</p>
        </div>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
        </div>
    </footer>
</body>

</html>