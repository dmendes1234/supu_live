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
    <link rel="stylesheet" href="css/card.css">
    <title>SUPU</title>
</head>

<body>
    <?php
    include("includes/header.html");
    include("includes/navBar.php");
    ?>

    <div style="margin-top:30px; margin-left: 60px; margin-right:80px;">
        <h4>Preporučeni događaji:</h4>
        <hr>
    </div>

    <!-- Kartica događaja 
    <div class="card">
        <img src="http://www.aal-europe.eu/wp-content/uploads/2013/04/events_medium.jpg" alt="Error" style="width:100%">
        <h1>Naziv događaja</h1>
        <p class="event_title">Datum i vrijeme</p>
        <p>Lokacija/mjesto događanja</p>
        <div style="margin: 24px 0;">
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
        <p><button>Rezerviraj ulaznicu</button></p>
    </div>
    -->

    <?php
    $ret2 = mysqli_query($con, "select * from users where ID='$user_id'");
    $row2 = mysqli_fetch_array($ret2);
    $ret = mysqli_query($con, "select * from events where Recommended='1'");
    while ($row = mysqli_fetch_array($ret)) {
    ?>
        <a href="event_details.php?eventid=<?php echo $row['ID']; ?>">
            <div class="card">
                <img src="<?php echo $row['Image']; ?>" alt="Error" style="width:100%">
                <h1><?php echo $row['Title']; ?></h1>
                <p class="event_title"><?php echo $row['Date']; ?></p>
                <p><?php echo $row['Location']; ?></p>
                <?php if ($row2['UserType'] == 'admin') { ?>
                    <hr>
                    <p><a href="edit-event.php?editid=<?php echo $row['ID']; ?>">Uredi</a></p>
                    <hr>
                    <p><a href="delete-event.php?editid=<?php echo $row['ID']; ?>">Obriši</a></p>
                <?php } ?>
            </div>
        </a>
    <?php
    }
    ?>

</body>

</html>