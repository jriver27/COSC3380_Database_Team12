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
    <div class="page-header">
        <div class="navbar-default">
            <div class="navbar-header"></div>
            <h3 class="h3">
                Medical Inventory Main
            </h3>
            <?php
              include 'php/nav_byUserPosition.php';
            ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="pull-left">
            <div class="well" style="border: solid;">
                <div class="alert-info">
                    <p class="panel" style="text-align: center;">** Notification area **</p>
                </div>
                <div class="well-sm" style="text-align: center">
                    <div class="close">
                        <?php
                        echo $_SESSION['username'];
                        ?>
                    </div>
                </div>
                <div class="blockquote-reverse">
<!--
            pseudo code
            ---------------------
            if( user is nurse or doctor)
            {
                if( they have any checked out item)
                    output all there current checked out items
                else
                    output "echo $_SESSION['username']. has no checked out items"
            }
            else if( user is medical admin)
            {
                if( medical admin has any OPEN po)
                {
                    output the open po;
                }else
                {
                    output nothing.

                }
                &&&
                // If we have time we can do this as well.
                if (any consumible is below a certain threshold )
                {
                    output an alert that a certain item is running low
                }
                else{
                    output that everything looks good
                    }
            }

-->
                    <p>something goes here  remove these as soon as we fill this</p>
                    <p>something goes here  remove these as soon as we fill this</p>
                    <p>something goes here  remove these as soon as we fill this</p>
                    <p>something goes here  remove these as soon as we fill this</p>
                    <p>something goes here  remove these as soon as we fill this</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'php/footer.php';
    ?>
</body>
</html>
