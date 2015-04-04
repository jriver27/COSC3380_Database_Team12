<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['position'] == 'admin'){
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
    <div id="main">
	<form action="insertaccount.php" method="post" name="loginform">
            <input type="hidden" name="action" value="register">
            <ul class="nobullet">
                <li>
                    <label for="username"> user name</label>
                    <input type="text" id="username" name="username" value="">
                    <span id="usermessage"></span>
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="">
                    <span id="passwordmessage"></span>
                </li>
            </ul>
            <input type="submit" alt="login" name="login" value="Login" id="submit_btn">
    </form>
    </div>

    <div id="footer">
        <span> Please Contact Us anytime.</span>
        <a href="RestrictedIndex.php">Members Area</a>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>
