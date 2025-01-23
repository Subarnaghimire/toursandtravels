<?php
    include "connection.php";

    function addCustomPackages($fromLocation,$toLocation,$DateFrom,$DateTo,$email,$children,$adult,$phone,$id){
        GLOBAL $conn;
        $query = "INSERT INTO CustomPackage(User_Id,TripFrom, TripTo, DateFrom,DateTo, Email, Children, Adult, Phone) Values($id,'$fromLocation.','$toLocation','$DateFrom','$DateTo','$email' ,$children, $adult, $phone)";
        $insert = mysqli_query($conn,$query);
        if($insert){
            return true;
        } else {
            return false;
        }
    }

    function addRating($rate, $id){
        GLOBAL $conn;

        $checkQuery = "SELECT * FROM Rating WHERE User_Id = $id";
        $checkResult = mysqli_query($conn, $checkQuery);

        if(mysqli_num_rows($checkResult) > 0){
            return false;
        }
        
        $query = "INSERT INTO Rating(User_Id, Ratings) VALUES($id, $rate)";
        $insert = mysqli_query($conn,$query);
        if($insert){
            return true;
        } else {
            return false;
        }
    }

    function addFeedbacks($feedback, $id){
        GLOBAL $conn;
        $query = "INSERT INTO Feedback(User_Id, Feed) VALUES($id, '$feedback')";
        $insert = mysqli_query($conn,$query);
        if($insert){
            return true;
        } else {
            return false;
        }
    }

    function addBookings($id, $packId){
        GLOBAL $conn;
        $query = "INSERT INTO Bookings(User_Id, Package_id) VALUES($id, $packId)";
        $insert = mysqli_query($conn,$query);
        if($insert){
            return true;
        } else {
            return false;
        }
    }

    function cancelBook($id, $packId){
        GLOBAL $conn;
        $query = "DELETE FROM Bookings WHERE User_Id=$id AND Package_id=$packId";
        $insert = mysqli_query($conn,$query);
        if($insert){
            return true;
        } else {
            return false;
        }
    }

    function updateUsername($id, $username){
        GLOBAL $conn;
        $checkQ = "SELECT * FROM User where Username='$username'";
        if(mysqli_num_rows(mysqli_query($conn, $checkQ))){
            return false;
        } else {
        $query = "UPDATE User Set Username='$username' WHERE User_Id=$id";
        $insert = mysqli_query($conn,$query);
        if($insert){
            return true;
            }
        }
    }

    function updateEmail($id, $email){
        GLOBAL $conn;
        $checkQ = "SELECT * FROM User where Email='$email'";
        if(mysqli_num_rows(mysqli_query($conn, $checkQ))){
            return false;
        } else {
            $query = "UPDATE User Set Email='$email' WHERE User_Id=$id";
            $insert = mysqli_query($conn,$query);
            if($insert){
                return true;
        }
        }

    }

    function updatePassword($id, $old_password, $new_password){
        GLOBAL $conn;
        $query = "SELECT * From User where User_Id=$id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $h_password = password_hash($new_password, PASSWORD_DEFAULT);

        if(password_verify($old_password, $row['password'])){
            $insert = mysqli_query($conn, "UPDATE User Set password='$h_password' Where User_Id=$id");
            if($insert){
                return true;
            }
        } else {
            return false;
        }
    }

?>