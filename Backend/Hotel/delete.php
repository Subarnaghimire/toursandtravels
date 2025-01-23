<?php 
require_once "../connection.php";

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query = "DELETE FROM Hotel where HotelId=$id";
    $result = mysqli_query($conn, $query);
    if ($result){
        session_start();
        $_SESSION['mssg'] = "Hotel Deleted Successfully";
        echo '<script>window.location.href="../../Admin/Hotel.php"</script>';
    }
}
?>