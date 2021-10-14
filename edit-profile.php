<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_SESSION['msg'])){
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['msg'] . "');
          </script>";
    unset($_SESSION['msg']);
} 
include('edit-profile-server.php');
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login&register.css">
    <title>SUPU</title>
</head>

<body>

    <?php
    include("includes/header.html");
    include("includes/navBar.php");
    ?>

    <div class="header">
        <h2>Uredi profil</h2>
    </div>

    <form id="edit-profile-form" method="post" action="edit-profile.php">
        <?php include('errors.php'); 
        $ret = mysqli_query($con, "select * from users where ID='$user_id'");
        $row = mysqli_fetch_array($ret);
        ?>
        <div class="input-group_custom">
            <label>Ime</label>
            <input type="text" name="name" value="<?php echo $row['Name'] ?>">
        </div>
        <div class="input-group_custom">
            <label>Prezime</label>
            <input type="text" name="surname" value="<?php echo $row['Surname'] ?>">
        </div>
        <div class="input-group_custom">
            <label>Korisničko ime</label>
            <input type="text" name="username" value="<?php echo $row['UserName'] ?>">
        </div>
        <div class="input-group_custom">
            <label>E-mail</label>
            <input type="email" name="email" value="<?php echo $row['Email'] ?>">
        </div>
        <div class="input-group_custom">
            <label>Lozinka</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group_custom">
            <label>Potvrdi lozinku</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group_custom">
            <button type="submit" class="btn" name="edit-profile">Spremi</button>
        </div>
    </form>

</body>

</html>