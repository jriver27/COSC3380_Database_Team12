<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && (int)$_SESSION['position'] < 3){
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
							$sql="SELECT i.Serial_number, id.Description, im.Manufacturer from item i LEFT JOIN item_description id ON i.SKU=id.SKU LEFT JOIN item_manufacturer im ON i.SKU=im.ID WHERE Stock_Count IS NULL";
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
					<input type="submit" alt="submit" name="submit1" value="submit1" id="submit_btn">
				</form>
			</div>
			<div style="display: inline-block;">
				<form  method="post" name="checkoutform[]">
					
					<label for="Consumables">Item Requested</label>
					<select class="form-control" id="Consumables" name="Consumables" style="width: 400px;" size="8">
						<?php
							include 'php/dbconnect.php';
							$sql="SELECT i.Serial_number, id.Description, im.Manufacturer from item i LEFT JOIN item_description id ON i.SKU=id.SKU LEFT JOIN item_manufacturer im ON i.SKU=im.ID WHERE Stock_Count >= 1";
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
					<label for="amountrequested">Amount</label>
					<input type="value" id="amountrequested" name="amountrequested" value=""><br>
					
					
					<input type="submit" alt="submit" name="submit2" value="submit" id="submit_btn">
				</form>
			</div>
			
			<div>
				<?php
					if(isset($_POST['submit1']))
					{
						include 'php/dbconnect.php';
						
						
						
						$roomnum = (int)$_POST['roomnum'];
						$sku = 3;
						$count = 1;
						$timestamp = time();
						$var = (int)$_POST['equipment'];
						$user = $_SESSION['username'];
						
						echo $user . ' has succesfully checked out item with serial number ' . $var . ' on ' . date("Y-m-d",$timestamp) . ' to room ' . $roomnum;
						
						$sql="INSERT INTO transaction_log(SKU, User_ID, Count, Room_Number) VALUES ($sku, '$user', $count, $roomnum);";
						$link->query($sql);
					}
					
					if(isset($_POST['submit2']))
					{
						
					}	
				?>
			</div>
		</div>
		
		
		<?php
			include 'php/footer.php';
		?>
	</body>
</html>

