<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && ((int)$_SESSION['position'] < 3 || (int)$_SESSION['position'] == 5)){
		echo "Welcome to the member's area, " . $_SESSION['username'] ;
		} else {
		header("Location: RestrictedIndex.php");
	}
	
?>
<?php
    //include 'php/checkoutverify.php'
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
        <div class="container-fluid" style="position: relative; text-align: center;">
			<div style="display: inline-block; margin-right: 50px;">
				<form  method="post" name="submit1">
					
					<label for="equipment">Equipment Requested</label>
					<select class="form-control" id="equipment" name="equipment" style="width: 400px;" size="8">
						<?php
							include 'php/dbconnect.php';
							$sql="SELECT i.Serial_number, i.Description, im.Manufacturer from item i LEFT JOIN item_manufacturer im ON i.SKU=im.ID WHERE i.Stock_Count = 1 AND i.Serial_number > 0 ";
							$query = mysqli_query($link, $sql);
							
							while($row = mysqli_fetch_array($query))
							{
								echo "<option value='".($row['Serial_number'])."'>";
								echo $row["Description"] . ' ' . $row["Manufacturer"];
								echo "</option>";
							}
						?>
					</select>
					<label for="roomnum">Room number</label>
					<input type="value" id="roomnum" name="roomnum" value=""><br>
					<input type="submit" alt="submit" name="submit1" value="submit" id="submit_btn">
				</form>
			</div>
			<div style="display: inline-block;">
				<form  method="post" name="submit2">
					
					<label for="Consumables">Item Requested</label>
					<select class="form-control" id="Consumables" name="Consumables" style="width: 400px;" size="8">
						<?php
							include 'php/dbconnect.php';
							$sql="SELECT i.SKU, i.Description, im.Manufacturer, i.Stock_Count from item i LEFT JOIN item_manufacturer im ON i.SKU=im.ID WHERE Stock_Count >= 1 AND Serial_number=0";
							$query = mysqli_query($link, $sql);
							
							while($row = mysqli_fetch_array($query))
							{
								echo "<option value='".($row['SKU'])."'>";
								echo $row["Description"] . ' ' . $row["Manufacturer"]. '        Stock: ' . $row["Stock_Count"];
								echo "</option>";
							}
						?>
					</select>
					<label for="roomnum">Room number</label>
					<input type="value" id="roomnum" name="roomnum" value=""><br>
					<label for="amountrequested">Amount</label>
					<input type="value" id="amountrequested" name="amountrequested" value=""><br>
					
					
					<input type="submit" alt="submit" name="submit2" value="submit" id="submit_btn">
				</form>
			</div>
			
			<div>
				<?php
					echo $_SESSION['checkout'];
					$_SESSION['checkout'] = '';
				?>
				<?php
					if(isset($_POST['submit1']))
					{
						include 'php/dbconnect.php';
						
						
						
						$roomnum = (int)$_POST['roomnum'];
						$count = 1;
						$timestamp = time();
						$sn = (int)$_POST['equipment'];
						$user = $_SESSION['username'];
						
						$sql="Select * FROM rooms WHERE Room_Number = $roomnum";
						$query = mysqli_query($link, $sql);
						$row = mysqli_fetch_array($query);
						
						if (count($row)<1)
							echo "room does not exist.";
							
						else{
							$sql="Select * FROM item WHERE Serial_number = $sn";
							$query = mysqli_query($link, $sql);
							$row = mysqli_fetch_array($query);
							$sku = $row['SKU'];
							
							$sql="INSERT INTO transaction_log(SKU, SerialNumber, User_ID, Count, RoomNumber) VALUES ($sku, $sn, '$user', $count, $roomnum);";
							
							
							if ($link->query($sql) === TRUE)
							{
								$sql ="UPDATE `item` SET `Stock_Count`=0 WHERE `SKU`=$sku AND `Serial_number`=$sn";
								
								if ($link->query($sql) === TRUE) 
								{
									$_SESSION['checkout'] = $user . ' has succesfully checked out item with serial number ' . $sn . ' on ' . date("Y-m-d",$timestamp) . ' to room ' . $roomnum;
									header("Location: InventoryCheckOut.php");
								}
							}
						}
					}	
						
						if(isset($_POST['submit2']))
						{
							include 'php/dbconnect.php';
							
							
							$roomnum = (int)$_POST['roomnum'];
							$sku = (int)$_POST['Consumables'];
							$count = (int)$_POST['amountrequested'];
							$timestamp = time();
							$user = $_SESSION['username'];
							
							$sql="Select * FROM rooms WHERE Room_Number = $roomnum";
							$query = mysqli_query($link, $sql);
							$row = mysqli_fetch_array($query);
							
							if (count($row)<1)
							{
								$_SESSION['checkout'] = "room does not exist.";
								header("Location: InventoryCheckOut.php");
							}
							else{
								$sql="Select Stock_Count FROM item WHERE SKU = $sku";
								
								$query = mysqli_query($link, $sql);
								$stock = 0;
								while($row = mysqli_fetch_array($query))
								{
									$stock = $row['Stock_Count'];
								}
								
								if ($count > $stock)
								{
									$_SESSION['checkout'] = 'Please enter an amount less than or equal to ' . $stock;
									header("Location: InventoryCheckOut.php");
								}
								else{
									
									$sql="INSERT INTO transaction_log(SKU, User_ID, Count, RoomNumber) VALUES ($sku, '$user', $count, $roomnum);";
									
									
									if ($link->query($sql) === TRUE)
									{
										$sql ="UPDATE `item` SET `Stock_Count`=($stock-$count) WHERE `SKU`=$sku";
										
										if ($link->query($sql) === TRUE) 
										{
											$_SESSION['checkout'] = $user . ' has succesfully checked out item with SKU ' . $sku . ' of stock ' . $count . ' on ' . date("Y-m-d",$timestamp) . ' to room ' . $roomnum;
											header("Location: InventoryCheckOut.php");
										}
									}	
								}
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

