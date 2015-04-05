<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
   header("Location: ../index.php");
}

?>
<html lang="en">
    <head >
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="../../favicon.ico" rel="icon">
        <title>Medical Inventory Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/sticky-footer-navbar.css">
    </head>

    <body>
        <div class="container">
            <div class="masthead">
                <h3 class="text-muted">
                    Medical Inventory Main
                </h3>
                <?php
                  include 'php/nav_byUserPosition.php';
                ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
            </div>
        </footer>
    </body>
</html>
