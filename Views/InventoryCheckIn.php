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
						
						$sql="Select * FROM item WHERE SKU=$sku AND Serial_Number=$sn";
						$query = mysqli_query($link, $sql);
						$row = mysqli_fetch_array($query);
						
						
						if (count($row)<1)
							echo "Item does not exist.";
						
						else
							if ($row['Stock_Count'] == 1)
								echo "Item already checked in.";
						
						else
							if ($row['Stock_Count'] == 0)
							{						
								$sql="INSERT INTO transaction_log(SKU, SerialNumber, User_ID, Count, RoomNumber) VALUES ($sku, $sn, '$user', $count, $roomnum);";
								
								if ($link->query($sql) === TRUE) 
								{
									$sql ="UPDATE `item` SET `Stock_Count`=1 WHERE `SKU`=$sku AND `Serial_number`=$sn";
									$link->query($sql);
									echo $user . ' has succesfully checked in item with SKU ' . $sku . ' and serial number ' . $sn . ' on ' . date("Y-m-d",$timestamp) . ' from room ' . $roomnum;
								}
								else	echo "Error: " . $sql . "<br>" . $link->error;
							}
						
					}
				?>
			</div>
		</div>
		<?php
			include 'php/footer.php';
		?>
		
	</body>
</html>	
