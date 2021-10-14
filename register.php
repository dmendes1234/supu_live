
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php'); 
include('register-server.php') 
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
    <link rel="stylesheet" href="css/login&register.css">
    <title>SUPU</title>
</head>

<body>

    <?php
    include("includes/header.html");
    include("includes/navBar.php");
    ?>

    <div class="header">
        <h2>Registracija</h2>
    </div>

    <form id="register_form" method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div class="input-group_custom">
            <label>Korisničko ime</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group_custom">
            <label>E-mail</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
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
            <button type="submit" class="btn" name="reg_user">Registriraj se</button>
        </div>
        <p>
            Već imaš kreiran račun? <a href="login.php">Prijavi se</a>
        </p>
    </form>

</body>

</html>