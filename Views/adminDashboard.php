<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true &&  (int)$_SESSION['position'] >= 3 ) {
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
		<div class="page-header">
			<div class="navbar-default">
				<div class="navbar-header"></div>
				<h3 class="h3">
					Dashboard
				</h3>
				<?php
					include 'php/nav_byUserPosition.php';
				?>
			</div>
		</div>
		<div class="container">
			
			<div class="container" style="border:double; position: relative; text-align: center;">
				<p> Show User Report  </p>
				<div style="display: inline-block; margin-right: 50px;">
					<form  method="post" name="getUserReportForm">
						
						<label for="getUserReport">Users</label>
						<select  required class="form-control" id="getUserReport" name="getUserReport" style="width: 400px;" size="8">
							<?php
								include 'php/dbconnect.php';
								$sql="Select * FROM users LEFT JOIN user_position ON users.Position=user_position.ID WHERE users.Position<4";
								$query = mysqli_query($link, $sql);
								
								if($row = mysqli_fetch_array($query)){
									echo "<option selected value='".($row['Username'])."'>";
									echo $row["FirstName"] . ' ' . $row["LastName"];
								echo "</option>";}
								while($row = mysqli_fetch_array($query))
								{
									echo "<option value='".($row['Username'])."'>";
									echo $row["FirstName"] . ' ' . $row["LastName"];
									echo "</option>";
								}
							?>
						</select>
						<input type="submit" alt="submit" name="getUserReportBtn" value="Get Report" id="submit_btn1">
						
					</div>
					
					<div style=";">
						
						
						<?php 
							if(isset($_POST['getUserReportBtn']))
							{
								echo '<table class="table" style="text-align: center;">';
								echo '<tr><td>User</td><td>Name</td><td>Position</td><td>Last Transaction ID</td></tr>';
								include 'php/dbconnect.php';
								
								$user = $_POST['getUserReport'];
								
								$sql="SELECT u.Username, u.FirstName, u.LastName, up.Position, tl.TransactionID FROM users u LEFT JOIN user_position up ON u.position=up.ID LEFT  JOIN (SELECT User_ID, max(TransactionID) TransactionID FROM transaction_log GROUP BY User_ID) tl on u.Username=tl.User_ID WHERE u.Username='$user'";
								$query = mysqli_query($link, $sql);
								
								
								
								while($row = mysqli_fetch_array($query))
								{
									echo '<tr>';
									echo '<td>'.($row['Username']).'</td>'.'<td>'.($row['FirstName']).' '.($row['LastName']).'</td>'.'<td>'.($row['Position']).'</td>'.'<td>'.($row['TransactionID']).'</td>';
									echo '</tr>';
								}
							}
							
							echo '</table>';
						?>
						
					</div>
				</div>
				
				<div class="container" style="border: double;text-align: center;">
					<p> Get item report
					</p>
					<div style="display: inline-block; margin-right: 50px;">
						<form required method="post" name="getUserReportForm">
							
							<label for="getItemReport">Items</label>
							<select class="form-control" id="getItemReport" name="getItemReport" style="width: 400px;" size="8">
								<?php
									include 'php/dbconnect.php';
									$sql="Select * FROM item";
									$query = mysqli_query($link, $sql);
									if($row = mysqli_fetch_array($query)){									
										echo "<option selected value='".($row['SKU'])."'>";
										echo $row["Description"];
									echo "</option>";}
									while($row = mysqli_fetch_array($query))
									{
										echo "<option  value='".($row['SKU'])."'>";
										echo $row["Description"];
										echo "</option>";
									}
								?>
							</select>
							<input type="submit" alt="submit" name="getItemReportBtn" value="Get Report" id="submit_btn">
							
						</div>
						
						<div style="display: ">
							
							
							<?php 
								
								
								if(isset($_POST['getItemReportBtn']))
								{
									echo '<table class="table" style="text-align: center;">';
									echo '<tr><td>SKU</td><td>Description</td><td>Stock</td><td>Last Transaction</td><td>Total Transactions</td></tr>';
									
									include 'php/dbconnect.php';
									
									$sku = (int)$_POST['getItemReport'];
									
									$sql="SELECT i.*,tl.TransactionID, t2.SKU2 FROM item i LEFT JOIN (SELECT SKU, max(TransactionID) TransactionID FROM transaction_log GROUP BY SKU) tl ON i.SKU=tl.SKU LEFT JOIN (SELECT SKU, count(*) SKU2 FROM transaction_log WHERE SKU=$sku) t2 ON i.SKU=t2.SKU WHERE i.SKU=$sku";
									$query = mysqli_query($link, $sql);
									
									
									
									while($row = mysqli_fetch_array($query))
									{
										echo '<tr>';
										echo '<td>'.($row['SKU']).'</td>'.'<td>'.($row['Description']).'</td>'.'<td>'.($row['Stock_Count']).'</td>'.'<td>'.($row['TransactionID']).'</td>'.'<td>'.($row['SKU2']).'</td>';
										echo '</tr>';
									}
									
									echo '</table>';
								}
							?>
							
						</div>
					</div>
					
					<div class="container" style="border:double; position: relative; text-align: center;">
						<p> Show Transaction Report  </p>
						<div style="display: inline-block; margin-right: 50px;">
							<form  method="post" name="getTransactionReportForm">
								
								<label for="getTransactionReport">Users</label>
								<select  required class="form-control" id="getTransactionReport" name="getTransactionReport" style="width: 400px;" size="8">
									<?php
										include 'php/dbconnect.php';
										$sql="Select * FROM transaction_log LEFT JOIN users ON users.Username=transaction_log.User_ID ORDER BY DATETIME DESC";
										$query = mysqli_query($link, $sql);
										
										if($row = mysqli_fetch_array($query)){
											echo "<option selected value='".($row['TransactionID'])."'>";
											echo '[Transaction ID: ' . $row["TransactionID"]. '] ' .$row["FirstName"] . ' ' . $row["LastName"]. ' ' .  $row["DATETIME"];
										echo "</option>";}
										while($row = mysqli_fetch_array($query))
										{
											echo "<option value='".($row['TransactionID'])."'>";
											echo '[Transaction ID: ' . $row["TransactionID"]. '] ' .$row["FirstName"] . ' ' . $row["LastName"]. ' ' .  $row["DATETIME"];
											echo "</option>";
										}
									?>
								</select>
								<input type="submit" alt="submit" name="getTransactionReportBtn" value="Get Report" id="submit_btn1">
								
							</div>
							
							<div style=";">
								
								
								<?php 
									if(isset($_POST['getTransactionReportBtn']))
									{
										echo '<table class="table" style="text-align: center;">';
										echo '<tr><td>User</td><td>Name</td><td>Position</td><td>Description</td><td>Amount</td></tr>';
										include 'php/dbconnect.php';
										
										$tid = $_POST['getTransactionReport'];
										$sql="SELECT * from transaction_log LEFT JOIN users ON transaction_log.User_ID=users.Username LEFT JOIN item ON transaction_log.SKU=item.SKU LEFT JOIN user_position ON users.Position=user_position.ID WHERE TransactionID=$tid";
										
										$query = mysqli_query($link, $sql);
										
										
										
										while($row = mysqli_fetch_array($query))
										{
											echo '<tr>';
											echo '<td>'.($row['Username']).'</td>'.'<td>'.($row['FirstName']).' '.($row['LastName']).'</td>'.'<td>'.($row['Position']).'</td>'.'<td>'.($row['Description']).'</td>'.'<td>'.($row['Count']).'</td>';
											echo '</tr>';
										}
									}
									
									echo '</table>';
								?>
								
							</div>
						</div>				
						
					</div>
				
				<?php
					include 'php/footer.php';
				?>
			</body>
			
		</html>														