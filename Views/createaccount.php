<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true &&  (int)$_SESSION['position'] >= 4 ){
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("../index.php");
}

?>
<html lang="en">
<head>
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
            Create An Account
        </h3>
        <?php
        include 'php/nav_byUserPosition.php';
        ?>
    </div>
</div>
    <div class="container">
        <form action="php/insertAccount.php" method ="post" class="dropdown" onsubmit="return toSubmit();">
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
        <div class="pull-right">
            <div class="btn-group">
                <div class="btn" style="border: groove">
                    <a href="removeAccount.php">Flag Account for removal</a>
                </div>
            </div>
        </div>

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
            return confirm("Please Confirm Your Input!!");
        }
        else{
            alert("Please Complete Form");
            return false;
        }
    }

    function checkInput(){
        var fname =document.getElementById('inputFirstName').value.length;
        var lname =document.getElementById('inputLastName').value.length;
        var uname =document.getElementById('inputUserName').value.length;
        var pass =document.getElementById('inputPassword').value.length;

        if(fname == 0){
            isReady = false;
        }else if(lname == 0){
            isReady = false;
        }else if(uname == 0){
            isReady = false;
        }else if(pass == 0){
            isReady = false;
        }
        else {
            isReady = true;
        }
    }
</script>
</html>
