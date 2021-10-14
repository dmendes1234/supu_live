<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_SESSION['msg'])) {
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['msg'] . "');
          </script>";
    unset($_SESSION['msg']);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "select ID from users where UserName='$username' && Password='$password'");
    $ret = mysqli_fetch_array($query);
    $user_id = $ret['ID'];
    $query2 = mysqli_query($con, "select * from users where ID='$user_id'");
    $ret2 = mysqli_fetch_array($query2);
    if ($ret > 0) {
        $_SESSION['user_id'] = $ret['ID'];
        $_SESSION['user_type'] = $ret2['UserType'];
        $_SESSION['username'] = $username;

        if ($ret2['UserType'] == 'admin') {
            header('location:all-events.php');
        } else {
            header('location:index.php');
        }
    } else {
        echo '<script>alert("Pogrešno korisničko ime ili lozinka!")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login&register.css">
    <title>Prijava</title>
</head>

<body>
    <?php
    include("includes/header.html");
    include("includes/navBar.php");
    ?>

    <div class="header">
        <h2>Prijava</h2>
    </div>

    <form id="login_form" method="post" action="" name="login">
        <div class="input-group_custom">
            <label>Korisničko ime</label>
            <input type="text" name="username" required>
        </div>
        <div class="input-group_custom">
            <label>Lozinka</label>
            <input type="password" name="password" required>
        </div>
        <div class="input-group_custom">
            <button type="submit" class="btn" name="login">Prijavi se</button>
        </div>
        <p>
            Nemaš korisnički račun? <a href="register.php">Registriraj se</a>
        </p>
    </form>
</body>

</html>