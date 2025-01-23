<?php 
require_once "../connection.php";

if (isset($_POST['submit'])){
    $id=$_POST['id'];
    $package_name = $_POST['package-name'];
    $days = $_POST['total-days'];
    $link = $_POST['image-link'];
    $location = $_POST['location'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $difficulty = $_POST['difficulty'];
    $about = $_POST['about'];
    $Itinerary = $_POST['itinerary'];
    $transportation = $_POST['transportation'];
    $accomodation = $_POST['accomodation'];

    $query = "UPDATE Package SET PackageName ='$package_name', Days = $days , LocationName ='$location', ImageLink ='$link', Rating =$rating, Price =$price, Difficulty ='$difficulty', Transportation = '$transportation', Accomodation='$accomodation', About ='$about', Itinerary ='$Itinerary' WHERE Package_id=$id";
    if (mysqli_query($conn, $query)){
        session_start();
        $_SESSION['mssg'] = "Package Updated Successfully";
        echo '<script>window.location.href="../../Admin/Package.php";</script>';
    }
}
?>