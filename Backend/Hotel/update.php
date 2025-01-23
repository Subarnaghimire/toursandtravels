<?php 
require_once "../../Backend/connection.php";

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['hotel-name'];
    $location  = $_POST['location'];
    $imagelink = $_POST['image-link'];
    $description = $_POST['about'];
    $price = $_POST['hotel-price'];
    $contact = $_POST['contact'];

    $query = "UPDATE Hotel Set HotelName='$name', HotelLocation='$location', HotelImage='$imagelink', HotelDescription='$description', HotelPrice=$price, Contact = $contact where HotelId=$id";
    $result = mysqli_query($conn, $query);
    if ($result){
        session_start();
        $_SESSION['mssg'] = "Hotel Updated Successfully";
        echo '<script>window.location.href="../../Admin/hotel.php"</script>';
    }
} else {
    echo "Not submitted";
}
?>