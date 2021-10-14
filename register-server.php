<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect("sql211.epizy.com", "epiz_30040196", "vpx3dk2r", "epiz_30040196_supu");

// REGISTER USER
if (isset($_POST['reg_user'])) {

  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Niste unijeli korisničko ime!"); }
  if (empty($email)) { array_push($errors, "Niste unijeli e-mail!"); }
  if (empty($password_1)) { array_push($errors, "Niste unijeli lozinku!"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Lozinke nisu identične!");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE UserName='$username' OR Email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['UserName'] === $username) {
      array_push($errors, "Korisničko ime već postoji!");
    }

    if ($user['Email'] === $email) {
      array_push($errors, "E-mail već postoji!");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (UserName, Email, Password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['msg'] = "Uspješno ste registrirani";
  	header('location: login.php');
  }
}