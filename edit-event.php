<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);

$event_id = $_GET['editid'];

if (isset($_POST['submit'])) {
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

  $query = mysqli_query($con, "update events set Title='$title', Category='$category', Performer='$performer', Organizer='$organizer', Location='$location', Image='$image', Date='$date', TicketPriceChild='$cprice', TicketPriceAdult='$aprice', AvailableSeats='$seats', PromoCode='$promo_code', PromoDiscount='$promo_discount', Recommended='$recommended' where ID='$event_id'");
  if ($query) {
    echo '<script>
      alert("Podaci uspješno izmijenjeni");
 </script>';
  } else {

    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
  }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <h3>Uređivanje događaja</h3>
        <hr>
    </div>

    <div id="edit_event_container" style="margin-left: 80px; margin-right: 80px; background-color:white">
        <div class="container" style="margin-top: 30px;">
            <h4 style="padding-top: 30px; padding-bottom:15px">Informacije o događaju</h4>
            <form method="post" action="" name="">

                <?php
      $event_id = $_GET['editid'];
      $ret = mysqli_query($con, "select * from events where ID='$event_id'");
      $cnt = 1;
      $row = mysqli_fetch_array($ret);

      ?>
                <div class="form-group">
                    <label for="title_edit">Naziv događaja</label>
                    <input type="text" class="form-control" id="title_edit" placeholder="Unesi naziv događaja"
                        name="title" value="<?php echo $row['Title'] ?>">
                </div>
                <div class="form-group">
                    <label for="category_edit">Kategorija</label>
                    <select id="category_edit" name="category" style="width: 100%; height: 35px">
                        <option value="Glazba">Glazba</option>
                        <option value="Film">Film</option>
                        <option value="Kazalište">Kazališze</option>
                        <option value="Sport">Sport</option>
                        <option value="Turizam">Turizam</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="performer_edit">Izvođač</label>
                    <input type="text" class="form-control" id="performer_edit" placeholder="Unesi naziv izvođača"
                        name="performer" value="<?php echo $row['Performer'] ?>">
                </div>
                <div class="form-group">
                    <label for="organizer_edit">Organizator</label>
                    <input type="text" class="form-control" id="organizer_edit" placeholder="Unesi naziv organizatora"
                        name="organizer" value="<?php echo $row['Organizer'] ?>">
                </div>
                <div class="form-group">
                    <label for="location_edit">Mjesto izvođenja događaja</label>
                    <input class="form-control" id="location_edit" placeholder="Unesi lokaciju događaja" name="location"
                        value="<?php echo $row['Location'] ?>">
                </div>
                <div class="form-group">
                    <label for="image_edit">Fotografija događaja</label>
                    <input type="text" class="form-control" id="image_edit" placeholder="Unesi url fotografije"
                        name="image" value="<?php echo $row['Image'] ?>">
                </div>
                <div class="form-group">
                    <label for="date_edit">Datum i vrijeme događanja</label>
                    <input type="datetime-local" class="form-control" id="date_edit" placeholder="Unesi datum događaja"
                        name="date" value="<?php echo $row['Date'] ?>">
                </div>
                <div class="form-group">
                    <label for="cprice_edit">Cijena ulaznice za djecu</label>
                    <input type="number" class="form-control" id="cprice_edit"
                        placeholder="Unesi cijenu ulaznice za djecu" name="cprice"
                        value="<?php echo $row['TicketPriceChild'] ?>">
                </div>
                <div class="form-group">
                    <label for="aprice_edit">Cijena ulaznice za odrasle</label>
                    <input type="number" class="form-control" id="aprice_edit"
                        placeholder="Unesi cijenu ulaznice za odrasle" name="aprice"
                        value="<?php echo $row['TicketPriceAdult'] ?>">
                </div>
                <div class="form-group">
                    <label for="seats_edit">Slobodna mjesta</label>
                    <input type="number" class="form-control" id="seats_edit" placeholder="Unesi broj slobodnih mjesta"
                        name="seats" value="<?php echo $row['AvailableSeats'] ?>">
                </div>
                <div class="form-group">
                    <label for="promo_code_edit">Promo code</label>
                    <input type="text" class="form-control" id="promo_code_edit"
                        placeholder="Unesi kod za popust ukoliko postoji" name="promo_code"
                        value="<?php echo $row['PromoCode'] ?>">
                </div>
                <div class="form-group">
                    <label for="promo_discount_edit">Promo popust</label>
                    <input type="number" class="form-control" id="promo_discount_edit"
                        placeholder="Unesi popust (%) koji se ostvaruje unosom promo koda" name="promo_discount"
                        value="<?php echo $row['PromoDiscount'] ?>">
                </div>
                <hr>
                <div class="form-group" style="margin-left: 20px;">
                    <input type="checkbox" class="form-check-input" id="recommend_event_edit" name="recommend_event"
                        <?php if ($row['Recommended'] == 1) echo 'checked' ?>>
                    <label class="form-check-label" for="recommend_event">Preporuči ovaj događaj</label>
                </div>
                <hr>

                <button type="submit" name="submit" class="btn btn-primary" style="background-color: rgb(158, 46, 93); border:none; width:100%; margin-bottom:30px">Spremi</button>
            </form>
        </div>
    </div>
</body>

</html>