<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['add_event'])) {
  $title = $_POST['title'];
  $category = $_POST['category'];
  $performer = $_POST['performer'];
  $organizer = $_POST['organizer'];
  $location = $_POST['location'];
  $image = $_POST['image'];
  $date = $_POST['date'];
  $cprice = $_POST['cprice'];
  $aprice = $_POST['aprice'];
  $seats = $_POST['seats'];
  $promo_code = $_POST['promo_code'];
  $promo_discount = $_POST['promo_discount'];

  if (isset($_POST['recommend_event'])) {
    $recommended = 1;
  } else {
    $recommended = 0;
  }

  $query = mysqli_query($con, 'insert into events (Title, Category, Performer, Organizer, Location, Image, Date, TicketPriceChild, TicketPriceAdult, AvailableSeats, PromoCode, PromoDiscount, Recommended) values ("' . $title . '", "' . $category . '", "' . $performer . '", "' . $organizer . '", "' . $location . '", "' . $image . '", "' . $date . '", "' . $cprice . '", "' . $aprice . '", "' . $seats . '", "' . $promo_code . '", "' . $promo_discount . '", "' . $recommended . '")');
  $_SESSION['msg'] = "Događaj uspješno kreiran.";
  header('location:all-events.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUPU</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <?php include('includes/header.html'); ?>
    <?php include('includes/navBar.php'); ?>

    <div style="margin-top:50px; margin-bottom:50px; margin-left: 100px; margin-right:80px;">
        <h3>Dodavanje događaja</h3>
        <hr>
    </div>

    <div id="add_event_container" style="margin-left: 80px; margin-right: 80px; background-color:white">
        <div class="container" style="margin-top: 30px;">
            <h4 style="padding-top: 30px; padding-bottom:15px">Informacije o događaju</h4>
            <form method="post" action="" name="">
                <div class="form-group">
                    <label for="title">Naziv događaja</label>
                    <input type="text" class="form-control" id="title" placeholder="Unesi naziv događaja" name="title"
                        required>
                </div>
                <div class="form-group">
                    <label for="category">Kategorija</label>
                    <select id="category" name="category" style="width: 100%; height: 35px">
                        <option value="Glazba">Glazba</option>
                        <option value="Film">Film</option>
                        <option value="Kazalište">Kazalište</option>
                        <option value="Sport">Sport</option>
                        <option value="Turizam">Turizam</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="performer">Izvođač</label>
                    <input type="text" class="form-control" id="performer" placeholder="Unesi naziv izvođača"
                        name="performer">
                </div>
                <div class="form-group">
                    <label for="organizer">Organizator</label>
                    <input type="text" class="form-control" id="organizer" placeholder="Unesi naziv organizatora"
                        name="organizer">
                </div>
                <div class="form-group">
                    <label for="location">Mjesto izvođenja događaja</label>
                    <input class="form-control" id="location" placeholder="Unesi lokaciju događaja" name="location"
                        required>
                </div>
                <div class="form-group">
                    <label for="image">Fotografija događaja</label>
                    <input type="text" class="form-control" id="image" placeholder="Unesi url fotografije" name="image"
                        required>
                </div>
                <div class="form-group">
                    <label for="date">Datum i vrijeme događanja</label>
                    <input type="datetime-local" class="form-control" id="date" placeholder="Unesi datum događaja"
                        name="date" required>
                </div>
                <div class="form-group">
                    <label for="cprice">Cijena ulaznice za djecu</label>
                    <input type="number" class="form-control" id="cprice" placeholder="Unesi cijenu ulaznice za djecu"
                        name="cprice" required>
                </div>
                <div class="form-group">
                    <label for="aprice">Cijena ulaznice za odrasle</label>
                    <input type="number" class="form-control" id="aprice" placeholder="Unesi cijenu ulaznice za odrasle"
                        name="aprice" required>
                </div>
                <div class="form-group">
                    <label for="seats">Slobodna mjesta</label>
                    <input type="number" class="form-control" id="seats" placeholder="Unesi broj slobodnih mjesta"
                        name="seats" required>
                </div>
                <div class="form-group">
                    <label for="promo_code">Promo code</label>
                    <input type="text" class="form-control" id="promo_code"
                        placeholder="Unesi kod za popust ukoliko postoji" name="promo_code">
                </div>
                <div class="form-group">
                    <label for="promo_discount">Promo popust</label>
                    <input type="number" class="form-control" id="promo_discount" value="0"
                        placeholder="Unesi popust (%) koji se ostvaruje unosom promo koda" name="promo_discount">
                </div>
                <hr>
                <div class="form-group" style="margin-left: 20px;">
                    <input type="checkbox" class="form-check-input" id="recommend_event" name="recommend_event">
                    <label class="form-check-label" for="recommend_event">Preporuči ovaj događaj</label>
                </div>
                <hr>

                <button type="submit" name="add_event" class="btn btn-primary"
                    style="background-color: rgb(158, 46, 93); border:none; width:100%; margin-bottom:30px">Dodaj</button>
            </form>
        </div>
    </div>

</body>

</html>