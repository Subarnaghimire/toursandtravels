<?php
require_once "../connection.php";
$id = $_GET['id'];
$approve = $_GET['approve'];
session_start();
if ($approve=="yes"){
    $sql = "UPDATE  Feedback set Status='approved' where FeedbackId=$id";
    mysqli_query($conn, $sql);
    $_SESSION['mssg'] = "Feedback is Aproved";
} else {
    $sql = "UPDATE  Feedback set Status='rejected' where FeedbackId=$id";
    mysqli_query($conn, $sql);
    $_SESSION['mssg'] = "Feedback is Rejected";
}
header('location: ../../Admin/feedback.php');
?>