<?php 
require_once "../connection.php";

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query = "DELETE FROM Package where Package_id=$id";
    $result = mysqli_query($conn, $query);
    if ($result){
        session_start();
        $_SESSION['mssg'] = "Package Deleted Successfully";
        echo '<script>window.location.href="../../Admin/Package.php"</script>';
    }
}
?>