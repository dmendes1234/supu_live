<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$ticketid = $_GET['ticketid'];

$query = mysqli_query($con, "update tickets set Status='Isporučeno' where ID='$ticketid'");
header('location:orders.php');
?>