<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['position'] == 'admin'){
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: view inventory.php");
}

?>
<html>

<head lang="en">
    <title>Medical Inventory Login</title>
    <style type="text/css">
        body {
            background-color: lightblue;
        }

        #header {
            background-color: darkblue;
        }

        #footer {
            text-align: left;
            border-top: dashed;
        }

        h1 {
            text-align: center;
        }

        label {
            width: 150px;
            display: block;
            float: left;
            margin: auto;
        }

        input[type=button] {
            background-color: darkblue;
            font-family: serif;
            color: azure;
            width: 16%;
            float: inherit;
            margin: auto;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>Medical Inventory Login</h1>
    </div>

    <div id="put anything here">
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
    </div>
	<a href="view inventory.php">Inventory</a>
	<a href="logout.php">Logout</a>
</body>

</html>