<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$event_id = $_GET['eventid'];
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
    <link rel="stylesheet" href="css/event_details.css">

    <title>SUPU</title>
</head>

<body>
    <?php
    include("includes/header.html");
    include("includes/navBar.php");

    $ret = mysqli_query($con, "SELECT * FROM events WHERE ID = '$event_id'");
    $row = mysqli_fetch_array($ret);
    $availableSeats = $row['AvailableSeats']; 
    ?>

    <div style="margin-top:50px; margin-bottom:50px; margin-left: 100px; margin-right:80px;">
        <h3>Detalji događaja</h3>
        <hr>
    </div>

    <div id="event_details_container" style="margin-left: 80px; margin-right: 80px; background-color:white; padding:50px">
        <img id="event_details_image" src="<?php echo $row['Image']; ?>" alt="" style="float:right; border-radius:10px; box-shadow: 0 4px 8px 0 rgba(158, 46, 93, 0.2);">
        <h1 style="margin-bottom: 25px;"><?php echo $row['Title'] ?></h1>
        <div id="ed_info">
            <p>IZVOĐAČ: <span><?php echo $row['Performer'] ?></span></p>
            <p>ORGANIZATOR: <span><?php echo $row['Organizer'] ?></span></p>
            <p>DATUM: <span><?php echo $row['Date'] ?></span></p>
            <p>LOKACIJA: <span><?php echo $row['Location'] ?></span></p>
            <p>CIJENA ULAZNICE ZA DJECU: <span><?php echo $row['TicketPriceChild'] ?></span></p>
            <p>CIJENA ULAZNICE ZA ODRASLE: <span><?php echo $row['TicketPriceAdult'] ?></span></p>
            <p>SLOBODNA MJESTA: <span><?php echo $row['AvailableSeats'] ?></span></p>
        </div>

        <?php if (strlen($_SESSION['user_id']) == 0) {?>
        <p><a href="login.php">Prijavi se</a> kako bi mogao kupiti ulaznice</p>
        <?php } else if ($availableSeats > 0 && $_SESSION['user_type'] != 'admin') {?>
        <a href="buy_tickets.php?eventid=<?php echo $row['ID']; ?>" class="buy-ticket_link">KUPI ULAZNICE</a>
        <?php } else if ($_SESSION['user_type'] == 'admin') { ?>
        <a href="edit-event.php?editid=<?php echo $row['ID']; ?>" class="edit-ticket_link">UREDI</a>
        <a href="delete-event.php?editid=<?php echo $row['ID']; ?>" class="delete-ticket_link">OBRIŠI</a>
        <?php } else {?>
        <p>Ulaznice su rasprodane</p>
        <?php }?>
    </div>
</body>

</html>