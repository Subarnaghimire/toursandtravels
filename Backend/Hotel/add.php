<?php 
require_once "../../Backend/connection.php";

if(isset($_POST['submit'])){
    $name = $_POST['hotel-name'];
    $location  = $_POST['location'];
    $imagelink = $_POST['image-link'];
    $price = $_POST['hotel-price'];
    $description = $_POST['about'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO Hotel(HotelName, HotelLocation, HotelImage, HotelPrice,HotelDescription,Contact) VALUES('$name', '$location', '$imagelink',$price, '$description',$contact)";
    $result = mysqli_query($conn, $query);
    if ($result){
        session_start();
        $_SESSION['mssg'] = "Hotel Added Successfully";
        echo '<script>window.location.href="../../Admin/hotel.php"</script>';
    }
} else {
    echo "Not submitted";
}
?>