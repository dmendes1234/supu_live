<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/index.css">
    <title>SUPU</title>
</head>

<body>
    <?php
    include("includes/header.html");
    include("includes/navBar.php");
    ?>

    <div style="margin-top:50px; margin-bottom:50px; margin-left: 100px; margin-right:80px;">
        <h3>Narudžbe kupaca</h3>
        <hr>
    </div>

    <div id="orders_container" style="margin-left: 80px; margin-right: 80px; background-color:white; text-align:center">
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Identifikacijski broj</th>
                <th>Datum narudžbe</th>
                <th>Status</th>
                <th>Mogućnosti</th>
            </tr>
            <?php
            $ret = mysqli_query($con, "select * from tickets");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) {
            ?>
            <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo $row['TicketID']; ?></td>
                <td><?php echo $row['PostingDate']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td>
                    <a href="view-ticket.php?ticketid=<?php echo $row['ID']; ?>">Pregledaj</a> ||
                    <a href="check.php?ticketid=<?php echo $row['ID']; ?>">Označi kao isporučeno</a>
                </td>
            </tr>
            <?php
                $cnt = $cnt + 1;
            } ?>
        </table>
    </div>
</body>

</html>