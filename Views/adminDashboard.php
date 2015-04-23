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
    <link rel="stylesheet" href="../css/bootstrap.css">
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
    <?php
    include 'php/dbconnect.php';
    function populateUserListTable() {
        $sql="SELECT FirstName, LastName, up.Position
              from users RIGHT JOIN user_position up
              ON users.position = up.ID";
        $query = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($query))
        {
            echo '<tr>';
            echo "<td>".($row['FirstName'])."</td>"."<td>".($row['LastName'])."</td>"."<td>".($row['Position'])."</td>";
            echo '</tr>';
        }
    }

    function populatePOTable() {
        echo "<tr><td>jjf</td><td>jdjfdj</td></tr>";
        echo "<tr><td>PO Transactions between select time</td><td>view pos from date time 1/1/2015 to 3/15/2015</td></tr>";
        echo "<tr><td>Who Opened them</td><td>when were they open/</td></tr>";
        echo "<tr><td>Who Closed them</td><td>when where they closed</td></tr>";
    }
    ?>

<table style="width: 80%; margin-left: 10%;">
    <tr>
        <td>
            <table class="dashboard">
                <tr>
                    <th>First Name</th><th>Last Name</th><th>Role</th>
                </tr>
                <?php
                    populateUserListTable();
                ?>
            </table>
        </td>
        <td>
            <table class="dashboard">
                <tr>
                    <th>Table</th><th>#2</th>
                </tr>
                <?php
                populatePOTable();
                ?>
            </table>
        </td>
        </tr>
    <tr>
        <td>
            <table class="dashboard">
                <tr>
                    <td>All by time History of a selected NON Consumable Item </td>
                    <td>Between this and that time:Item sku " cccxxxccc333" </td>
                </tr>
                <tr>
                    <td>Checked out by X at dd/mm/yyyy time:00:00 </td>
                    <td>Returned by X at dd/mm/yyyy time:00:00 </td>
                </tr>
            </table>
        </td>
        <td>
            <table class="dashboard">
                <tr>
                    <td> All open PO's</td>
                    <td>example:</td>
                </tr>
                <tr>
                    <td>PO ID: Open by XXX</td>
                    <td>Open Date:</td>
                </tr>
            </table>
        </td>
    </tr>
    </table>

    <div class="container" style="border: double">
        <p> Other Possible metrics here.</p>
    </div>
    <div>
        <p> Download as cvs</p>
    </div>

    <?php
    include 'php/footer.php';
    ?>
</body>

</html>
