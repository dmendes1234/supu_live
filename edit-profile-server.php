<?php
session_start();

// initializing variables
$name = "";
$surname = "";
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect("sql211.epizy.com", "epiz_30040196", "vpx3dk2r", "epiz_30040196_supu");

// REGISTER USER
if (isset($_POST['edit-profile'])) {

  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $surname = mysqli_real_escape_string($db, $_POST['surname']);
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

  $user_id = $_SESSION['user_id'];
  $ret = mysqli_query($con, "select * from users where ID='$user_id'");
  $row = mysqli_fetch_array($ret);
  $current_username = $row['UserName'];
  $current_email = $row['Email'];

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE UserName='$username' OR Email='$email' EXCEPT SELECT * FROM users WHERE UserName='$current_username' AND Email='$current_email'";
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

  // Finally, edit user data if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
    $user_id = $_SESSION['user_id'];  

    $query = "update users set Name='$name', Surname='$surname', UserName='$username', Email='$email', Password='$password' where ID='$user_id'";  
  	mysqli_query($db, $query);
    if($query){
  	$_SESSION['username'] = $username;
  	$_SESSION['msg'] = "Podaci uspješno promijenjeni";
  	header('location: edit-profile.php');
    }
  }
}