<?php
/**
 * User: Gagan
 * Date: 4/13/15
 * Time: 12:29 AM
 */
	session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && ((int)$_SESSION['position'] < 3 || (int)$_SESSION['position'] == 5)){
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
            Allergy Lookup
        </h3>
        <?php
        include 'php/nav_byUserPosition.php';
        ?>
    </div>
</div>
<form action="" method="post" name="loginform">
    <div class="container-fluid">
        <label for="itemrequested">Lookup By Item Name</label><br>
        <?php
        include 'php/dbconnect.php';
        $sql="SELECT DISTINCT SKU, Description FROM item ORDER BY Description";
        $query = mysqli_query($link, $sql);

        echo "<select name=item value=''>Item Name</option>"; // list box select command
        while($row = mysqli_fetch_array($query))
        {
            echo "<option value=''>";
            echo $row["Description"];
            echo "</option>";
        }
            echo "</select>";// Closing of list box
        ?>

        <input type="submit" alt="lookup" name="lookup" value="Look Up" id="submit_btn">
        <p><label for="allergyList">Search by Allergies:</label><br>
        <?php
        //$sql = "SHOW COLUMNS FROM allergy_lookup WHERE Field NOT LIKE 'SKU'";
        $sql = "SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE table_name = 'allergy_lookup'
                  AND column_name NOT LIKE 'SKU'
                ORDER BY column_name";
        $query = mysqli_query($link, $sql);

        while( $row = mysqli_fetch_array($query) ) {
            $output = "<input type='checkbox' name='allergies[]' value='" . $row['COLUMN_NAME'] . "'> " . $row['COLUMN_NAME'] . "<br />";
            echo $output;
        }
        ?>
            <br><input type="submit" alt="lookup" name="lookup" value="Match Allergies" id="submit_btn">
        </p>
    </div>
</form>
<?php
include 'php/footer.php';
?>
</body>
</html>
