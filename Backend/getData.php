<?php
    include "connection.php";

    function fetchPackages(){
        GLOBAL $conn;
        $query = "Select * from Package";
        $result = mysqli_query($conn,$query);
        if($result){
            return $result;
        }
    }

    function fetchPackageById($id){
        GLOBAL $conn;
        $query = "Select * from Package where Package_id=$id";
        $result = mysqli_query($conn,$query);
        if($result){
            return $result;
        }
    }
    function fetchUserData($id){
        GLOBAL $conn;
        $query = "Select * from User where User_Id=$id";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function fetchCustomPacakge($id){
        GLOBAL $conn;
        $query = "Select * from CustomPackage JOIN User ON CustomPackage.User_Id = User.User_Id where CustomPackage.User_Id=$id";
        $result = mysqli_query($conn,$query);
        if($result){
            return $result;
        }
    }
    
    function fetchBookings(){
        GLOBAL $conn;
        $query = "SELECT * FROM Bookings JOIN User ON Bookings.User_Id = User.User_Id  JOIN Package ON Bookings.Package_id = Package.Package_id";
        $result = mysqli_query($conn,$query);
        if($result){
            return $result;
        }
    }

    function fetchHotels(){
        GLOBAL $conn;
        $query = "SELECT * FROM Hotel";
        $result = mysqli_query($conn,$query);
        if($result){
            return $result;
        }
    }
    
    function fetchFeedbackById($id){
        GLOBAL $conn;
        $query = "SELECT * FROM Feedback  where User_Id=$id AND status='approved'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 0){
            return "No Feedbacks";
        } else {
            $row = mysqli_fetch_assoc($result);
            return $row['Feed'];
        }
    }

    function fetchFeedbacks(){
        GLOBAL $conn;
        $query = "SELECT * FROM Feedback JOIN User ON Feedback.User_Id = User.User_Id";
        $result = mysqli_query($conn,$query);
        return $result;
    }

    function fetchRatings(){
        GLOBAL $conn;
        $query = "SELECT * FROM Rating JOIN User ON Rating.User_Id = User.User_Id";
        $result = mysqli_query($conn,$query);
        return $result;
    }

    function check_if_user_has_booked($id, $packId){
        GLOBAL $conn;
        $query = "SELECT * FROM Bookings WHERE User_Id=$id AND Package_id=$packId";
        $result = mysqli_query($conn,$query);
        if($row=mysqli_fetch_assoc($result)){
            return $row['status'];
        } 
    }


    function getPackageData($id){
        GLOBAL $conn;
        $query = "SELECT * FROM Package where Package_id=$id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

function fetchBookingsById($userId) {
    GLOBAL $conn;
    $query = "
        SELECT b.BookingsId, b.BookedDate, p.PackageName, b.status, p.Price AS Amount
        FROM bookings b
        JOIN package p ON b.Package_id = p.Package_id
        WHERE b.User_Id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}


    function fetchCustomizedPackage(){
        GLOBAL $conn;
        $query = "Select * from CustomPackage JOIN User ON CustomPackage.User_Id = User.User_Id";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function fetchHotelByid($id){
        GLOBAL $conn;
        $query = "SELECT * FROM Hotel where HotelId=$id";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function checkToken($token){
        GLOBAL $conn;
        $query = "SELECT * FROM User where token='$token'";
        $result = mysqli_query($conn, $query);
        if($result){
            return true;
        } else {
            return false;
        }
    }
?>