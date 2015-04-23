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
<!--    <link rel="stylesheet" href="../css/bootstrap.css">-->
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
            include 'php/dbconnect.php';
            ?>
        </div>
    </div>

<table style="width: 80%; margin-left: 5%;">
    <tr>
        <td>
            <table class="dashboard">
                <caption>Users List</caption>
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
                <caption>Second Table</caption>
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
        <td>  <br>    </td><td>    <br>  </td>
    <!--        Blank Row To add spacing-->
    </tr>
    <tr>
        <td>
            <select name="item" id="item">
                <?php
                include "php/getNONConsumablesIntoDropDown.php";
                ?>
            </select>
        </td>
        <td>
            Add filters for other tables here!
        </td>
    </tr>
    <tr>
        <td>
            <table class="dashboard">
                <caption>Select Non Consumable Item for History</caption>
                <tr>
                    <th>History of a selected NON Consumable Item</th>
                    <th>Between this and that time:Item sku " cccxxxccc333" </th>
                </tr>
                <tr>
                    <td>Checked out by X at dd/mm/yyyy time:00:00 </td>
                    <td>Returned by X at dd/mm/yyyy time:00:00 </td>
                </tr>
            </table>
        </td>
        <td>
            <table class="dashboard">
                <caption>All Open Purchase Orders</caption>
                <tr>
                    <th>PO ID#</th>
                    <th>Open By</th>
                    <th>Date</th>
                </tr>
                <tr>
                    <?php
                    populateOpenPOTable();
                    ?>
                </tr>
            </table>
        </td>
    </tr>
    </table>
    <?php
    function populateUserListTable() {
        global $link;
        $sql='SELECT FirstName, LastName, user_position.Position
              FROM users INNER JOIN user_position
              ON users.position = user_position.ID';

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

    function populateOpenPOTable() {
        global $link;
        $sql='SELECT FirstName, LastName, user_position.Position
              FROM users INNER JOIN user_position
              ON users.position = user_position.ID';

        $query = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($query))
        {
            echo '<tr>';
            echo "<td>".($row['FirstName'])."</td>"."<td>".($row['LastName'])."</td>"."<td>".($row['Position'])."</td>";
            echo '</tr>';
        }
    }
    ?>

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
