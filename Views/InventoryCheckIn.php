<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
		} else {
		header("Location: ../login.php");
	}
	
?>
<html lang="en">
	<head >
		<meta charset="utf-8">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<link href="../../favicon.ico" rel="icon">
		<title>Check In Inventory</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sticky-footer-navbar.css">
	</head>
	<body>
		<div class="page-header">
			<div class="navbar-default">
				<div class="navbar-header"></div>
				<h3 class="h3">
                    Inventory Check In
				</h3>
				<?php
					include 'php/nav_byUserPosition.php';
				?>
			</div>
		</div>
		<div class="container-fluid" style="position: relative; text-align: center;">
			<form  method="post" name="submit1">
				
				<label for="rn">Room Number</label>
				<input type="value" id="rn" name="rn" value=""><br>
				<label for="sku">SKU</label>
				<input type="value" id="sku" name="sku" value=""><br>
				<label for="sn">Serial Number</label>
				<input type="value" id="sn" name="sn" value=""><br>
				<input type="submit" alt="submit" name="submit" value="submit" id="submit_btn">
			</form>
			<div>
				<?php			
					if(isset($_POST['submit']))
					{
						include 'php/dbconnect.php';
						
						$roomnum = (int)$_POST['rn'];
						$sku = (int)$_POST['sku'];
						$sn = (int)$_POST['sn'];
						$count = 1;
						$timestamp = time();
						$user = $_SESSION['username'];
						
						echo $user . ' has succesfully checked in item with serial number ' . $var . ' on ' . date("Y-m-d",$timestamp) . ' from room ' . $roomnum;
						
						$sql="INSERT INTO transaction_log(SKU, Serial_Number, User_ID, Count, Room_Number) VALUES ($sku, $sn, '$user', $count, $roomnum);";
						$link->query($sql);
					}
				?>
			</div>
			</div>
		<?php
				include 'php/footer.php';
			?>
			
		</body>
	</html>	
