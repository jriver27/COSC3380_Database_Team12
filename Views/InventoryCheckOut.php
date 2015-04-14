<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && (int)$_SESSION['position'] < 3){
		echo "Welcome to the member's area, " . $_SESSION['username'] ;
		} else {
		header("Location: RestrictedIndex.php");
	}
	
?>
<html lang="en">
    <head >
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="../../favicon.ico" rel="icon">
		<title>Inventory Check Out</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sticky-footer-navbar.css">
	</head>
	
	<body>
    <div class="page-header">
        <div class="navbar-default">
            <div class="navbar-header"></div>
            <h3 class="h3">
					Inventory Checkout
            </h3>
            <?php
                include 'php/nav_byUserPosition.php';
            ?>
			</div>
    </div>
    <form action="checkoutverify.php" method="post" name="loginform">
        <div class="container-fluid">
            <table class="table">
                <label for="itemrequested">Item Requested</label>
                <select multiple class="form-control" id="itemrequested" name="itemrequested">
                    <?php
                         include 'php/dbconnect.php';
                        $sql="SELECT DISTINCT SKU, Serial_number, Description from item ORDER BY Description";
                        $query = mysqli_query($link, $sql);

                        while($row = mysqli_fetch_array($query))
                        {
                            echo "<option value=''>";
                            echo $row["Description"];
                            echo "</option>";
                        }
                    ?>
                </select>
            </table>
            <li>
                <label for="amountrequested">Quantity: </label>
                <input type="value" id="amountrequested" name="amountrequested" value="">
                <span id="passwordmessage"></span>
            </li>
        <input type="submit" alt="Check Out" name="checkOut" value="Check Out" id="submit_btn">
        </div>
    </form>
    <?php
    include 'php/footer.php';
    ?>
</body>
</html>
