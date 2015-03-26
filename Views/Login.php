<!DOCTYPE html>
<html>

<head lang="en">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../Site.css"/>
</head>

<body>
<div class="wrapper">
    <div id="header"></h1>
        <h1>Medical Inventory Login</h1>
        <img src="http://www.math.uh.edu/analysis/Pics/Graphics/UHlogo.gif" alt="University of Houston" </img>
    </div>
    <div id="leftMenuContainer" >

        <ul class="navigation">
            <li><a href= "../index.php">Home Page</a>
            <li><a href= "AboutUs.php">About Us</a>
            <li><a href= "ContactUs.php">Contact Us</a>
            <li><a href= "Login.php">Login</a>
        </ul>
    </div>
    <div id="registrationform">
        <h2>Login to your account</h2>
        <form action="loggedIn.cgi" method="POST" name="loginform">
            <input type="hidden" name="action" value="register">
            <ul class="nobullet">
                <li>
                    <label for="username">Desired user name</label>
                    <input type="text" id="username" name="username" value="" onkeyup="validateUserName()">
                    <span id="usermessage"></span>
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" onkeyup="validatePassword()">
                    <span id="passwordmessage"></span>
                </li>
            </ul>
            <input type="submit" alt="register" name="register" value="Register" id="submit_btn" onclick="submitForm()">
        </form>

        <script>
            /// For the error checking I felt like regular expressions was the best way to go.
            function validateUserName() {
                var regEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).+$/;
                var currUsername = document.getElementById("username");
                if (regEx.test(currUsername.value)) {
                    currUsername.style.background = '#ccffcc';
                    document.getElementById("usermessage").innerHTML =  "(OK)";
                    return true;
                } else {
                    currUsername.style.background = '#e35152';
                    document.getElementById("usermessage").innerHTML = "Must contain a lower and upper case letter and at least 1 number. Cannot contain special characters";
                    return false;
                }
            }

            function validatePassword() {
                var regEx = /^(?=.*[0-9].*[0-9]).{8,15}$/;
                var currPassword = document.getElementById("password");
                if (regEx.test(currPassword.value)) {
                    currPassword.style.background = '#ccffcc';
                    document.getElementById("passwordmessage").innerHTML = "(OK)";
                    return true;
                } else {
                    currPassword.style.background = '#e35152';
                    document.getElementById("passwordmessage").innerHTML = "Must contain at least 2 numbers and be 8 to 15 characters in length";
                    return false;
                }
            }

            function submitForm() {
                if (validateUserName() && validatePassword()) {
                    alert("Login Successful!");
                    return true;
                } else {
                    alert("Error. Some of the input fields are not complete. Please correct!");
                    event.preventDefault();
                    return false;
                }
            }
        </script>
    </div>
</div>
    <div id="footer">
        <span> Please Contact Us anytime </span>
    </div>

</body>

</html>