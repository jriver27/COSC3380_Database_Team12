<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['position'] >=4 ) {
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
                Flag User For Removal
            </h3>
            <?php
            include 'php/nav_byUserPosition.php';
            ?>
        </div>
    </div>
    <div class="bg-warning"> This cannot be Undone</div>
    <div class="container">
        <form action="php/flagAccountForRemoval.php" method ="post" onsubmit="return toSubmit();">
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
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>
    <?php
    include 'php/footer.php';
    ?>
    </body>

<script type ="text/javascript">
    var isReady;

    function toSubmit(){
        checkInput();
        if(isReady) {
            return confirm("THIS CANNOT BE UNDONE!!");
        }
        else{
            alert("Please Complete Form");
            return false;
        }
    }

    function checkInput(){
        var fname=document.getElementById('inputFirstName').value.length;
        var lname=document.getElementById('inputLastName').value.length;
        var uname=document.getElementById('inputUserName').value.length;

        if(fname == 0){
            isReady = false;
        }else if(lname == 0){
            isReady = false;
        }else if(uname == 0){
            isReady = false;
        }
        else {
            isReady = true;
        }
    }
</script>
</html>