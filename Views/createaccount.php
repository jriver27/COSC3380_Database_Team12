<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("../index.php");
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
            Create An Account
        </h3>
        <?php
        include 'php/nav_byUserPosition.php';
        ?>
    </div>
</div>
    <div class="container">
        <form action="php/insertAccount.php" >
            <div class="form-group">
                <label for="inputFirstName">First Name</label>
                <input type="firstName" class="form-control" id="inputFirstName" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="inputLastName">Last Name</label>
                <input type="lastName" class="form-control" id="inputLastName" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="inputUserName">User Name</label>
                <input type="userame" class="form-control" id="inputUserName" placeholder="User Name">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Position <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <?php
                    include 'php/dbconnect.php';

                    $sql="SELECT ID FROM user_position";
                    $query = mysqli_query($link, $sql);
                    while($obj = mysqli_fetch_array($query))
                    {
                        echo '<li>';
                        echo $obj['ID'];
                        echo '</li>';
                    }
                    ?>
                </ul>;
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
        </div>
    </footer>
</body>

</html>
