<?php 
require_once "../connection.php";

if (isset($_POST['submit'])){
    $package_name = $_POST['package-name'];
    $transportation = $_POST['transportation'];
    $accomodation = $_POST['accomodation'];
    $days = $_POST['total-days'];
    $link = $_POST['image-link'];
    $location = $_POST['location'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $difficulty = $_POST['difficulty'];
    $about = $_POST['about'];
    $Itinerary = $_POST['itinerary'];

    $query = "INSERT INTO Package(PackageName , Days , LocationName , ImageLink , Rating , Price , Difficulty , Transportation, Accomodation, About , Itinerary) VALUES('$package_name', $days, '$location','$link', $rating, $price, '$difficulty','$transportation', '$accomodation', '$about', '$Itinerary')";

    if (mysqli_query($conn, $query)){
        session_start();
        $_SESSION['mssg'] = "Package Added Successfully";
        header("location: ../../Admin/Package/addPackage.php");
    }
}

?>