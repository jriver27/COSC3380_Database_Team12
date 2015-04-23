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
        <td>  <br>    </td>
        <td>  <br>    </td>
    <!--        Blank Row To add spacing-->
    </tr>
    <tr>
        <td>
            <select name="item" id="item" onchange="php: populateNCitemHistory()">
                <?php
                include "php/getNONConsumablesIntoDropDown.php";
                ?>
            </select>
            <input type="submit" alt="lookup" name="submit" value="Refresh filters" id="submit_btn">
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
                    <th>Date Time</th>
                    <th>User</th>
                    <th>Room Number</th>
                </tr>
                <tr>
<!--                    --><?php
//                        populateNCitemHistory()
//                    ?>
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

    function populateNCitemHistory($tempSKU, $tempSerial) {
        global $link;
        $sql='SELECT Transaction_ID, DATETIME, user_ID, RoomNumber
              from transaction_log INNER join item
              on (transaction_log.SKU = item.SKU AND transaction_log.serial_number=item.serial_number)
              WHERE transaction_log.SKU='.$tempSKU.' AND transaction_log.serial_number='.$tempSerial;

        $query = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($query))
        {
            echo '<tr>';
            echo "<td>".($row['DATETIME'])."</td>"."<td>".($row['user_ID'])."</td>"."<td>".($row['RoomNumber'])."</td>";
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
        $sql='SELECT PONumber, DateTime, Purchaser From purchase_order_log WHERE Open_PO = 1';

        $query = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($query))
        {
            echo '<tr>';
            echo "<td>".($row['PONumber'])."</td>"."<td>".($row['Purchaser'])."</td>"."<td>".($row['DateTime'])."</td>";
            echo '</tr>';
        }
    }
    ?>
    <div id="results">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $itemKey = getInput($_POST["item"]);
            $listItem =  explode('-', $itemKey);

            populateNCitemHistory($listItem[0],$listItem[1]);



        }
        ?>
    <?php
    include 'php/footer.php';
    ?>
</body>

</html>
