<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true &&  (int)$_SESSION['position'] >= 4 ){
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
        <form action="php/insertAccount.php" method ="post" class="dropdown">
            <div class="form-group">
            <label for="inputFirstName">First Name</label>
            <input class="form-control" type="text"  placeholder="First Name" name="inputFirstName" id="inputFirstName">
            </div>
            <div class="form-group">
                <label for="inputLastName">Last Name</label>
                <input  class="form-control" placeholder="Last Name" name="inputLastName" id="inputLastName" >
            </div>
            <div class="form-group">
                <label for="inputUserName">User Name</label>
                <input  class="form-control" placeholder="User Name" name="inputUserName" id="inputUserName" >
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="inputPassword" id="inputPassword" >
            </div>
            <div class="form-group">
                <label for="inputPosition">Position</label>
                <select class="form-control" name="inputPosition" id="inputPosition" >
                <?php
                include 'php/dbconnect.php';

                $sql="SELECT ID,Position  FROM user_position";
                $result = mysqli_query($link, $sql);
                while($obj = mysqli_fetch_array($result))
                {
                    echo '<option value = "';
                    echo $obj['ID'];
                    echo '">';
                    echo print_r($obj['Position'],true);
                    echo '</option>';
                }
                ?>
                </select>
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
