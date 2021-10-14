<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);

$event_id = $_GET['editid'];

$query = mysqli_query($con, "DELETE FROM `events` WHERE `events`.`ID` = '$event_id'");
if ($query) {
    echo '<script>
      alert("Događaj uspješno izbrisan");
 </script>';
    header('location:all-events.php');
} else {
    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
}
