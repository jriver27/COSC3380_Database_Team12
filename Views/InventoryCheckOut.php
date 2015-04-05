<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && ($_SESSION['position'] == 'Nurse' || $_SESSION['position'] == 'Medical Admin')){
		echo "Welcome to the member's area, " . $_SESSION['username'] . $_SESSION['position'];
		} else {
		header("Location: RestrictedIndex.php");
	}
	
?>
<html>
	
	<head lang="en">
		<title>Inventory Check Out</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sticky-footer-navbar.css">
	</head>
	
	<body>
		<div class="container">
			<div class="masthead">
				<h3 class="text-muted">
					Inventory Checkout
				</h3>
				<?php
					include 'php/nav_byUserPosition.php';
				?>
			</div>
			<form action="checkoutverify.php" method="post" name="loginform">
				<ul class="nobullet">
					<li>
						<label for="itemrequested">Item Requested</label>
						<select multiple class="form-control" id="itemrequested" name="itemrequested">
							<?php
								include 'dbconnect.php';
								$sql="SELECT DISTINCT id.Description from item i JOIN item_description id ON i.SKU=id.SKU";
								$query = mysqli_query($link, $sql);
																
								while($row = mysqli_fetch_array($query))
								{
									echo "<option value=''>";
									echo $row["Description"];
									echo "</option>";
								}
							?>
						</select>
					</li>
					<li>
						<label for="amountrequested">Amount</label>
						<input type="value" id="amountrequested" name="amountrequested" value="">
						<span id="passwordmessage"></span>
					</li>
				</ul>
				<input type="submit" alt="login" name="login" value="Login" id="submit_btn">
			</form>
		</div>
		<footer class="footer">
			<div class="container">
				<p class="text-muted">Please Contact Us anytime. <a href="logout.php">Logout</a> </p>
			</div>
		</footer>
	</body>
</html>
