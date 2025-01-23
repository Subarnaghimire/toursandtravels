<?php
require_once "connection.php";

    function getUserCount(){
        GLOBAL $conn;
        $query = "SELECT COUNT(*) as count FROM User";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
        return $count;
	}

    function getPackageCount(){
        GLOBAL $conn;
        $query = "SELECT COUNT(*) as count FROM Package";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
        return $count;
	}

    function getBookingCount(){
        GLOBAL $conn;
        $query = "SELECT COUNT(*) as count FROM User";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
        return $count;
	}

    function getReviewsCount(){
        GLOBAL $conn;
        $query = "SELECT COUNT(*) as count FROM User";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
        return $count;
	}

?>