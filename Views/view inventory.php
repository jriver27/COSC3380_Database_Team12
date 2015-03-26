<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: login.php");
}

?>
<html>

<head lang="en">
    <title>Medical Inventory Login</title>
    <style type="text/css">
        body {
            background-color: lightblue;
        }

        #header {
            background-color: darkblue;
        }

        #footer {
            text-align: left;
            border-top: dashed;
        }

        h1 {
            text-align: center;
        }

        label {
            width: 150px;
            display: block;
            float: left;
            margin: auto;
        }

        input[type=button] {
            background-color: darkblue;
            font-family: serif;
            color: azure;
            width: 16%;
            float: inherit;
            margin: auto;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>Medical Inventory Login</h1>
    </div>

    <div id="put anything here">
	<table>
		<?php
		include 'dbconnect.php';

		$sql="SELECT * FROM $tbl_name";
		$query = mysqli_query($link, $sql);
		
		while($row = mysqli_fetch_array($query)) 
		{
			echo '<tr>';
				echo "<tr><td>".($row['Username'])."</td></tr>";
			echo '</tr>';
		}

		?>
	</table>
    </div>

    <div id="footer">
        <span> Please Contact Us anytime.</span>
    </div>
	<a href="view inventory.php">Inventory</a>
	<a href="logout.php">Logout</a>
</body>

</html>