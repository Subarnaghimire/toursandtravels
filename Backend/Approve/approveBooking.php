<?php
require_once "../connection.php";
$id = $_GET['id'];
$approve = $_GET['approve'];
session_start();
if ($approve=="yes"){
    $sql = "UPDATE  Bookings set Status='approved' where BookingsId=$id";
    mysqli_query($conn, $sql);
    $_SESSION['mssg'] = "Booking is Aproved";
} else {
    $sql = "UPDATE  Bookings set Status='rejected' where BookingsId=$id";
    mysqli_query($conn, $sql);
    $_SESSION['mssg'] = "Booking is Rejected";
}
header('location: ../../Admin/Bookings.php');
?>