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
// Add these new functions to your existing getCount.php

function getMostBookedPackages($limit = 5) {
    global $conn;
    $query = "SELECT p.PackageName, COUNT(b.BookingsId) as booking_count 
              FROM package p 
              LEFT JOIN bookings b ON p.Package_id = b.Package_id 
              GROUP BY p.Package_id 
              ORDER BY booking_count DESC 
              LIMIT $limit";
    return mysqli_query($conn, $query);
}

function getRecentSignups($limit = 5) {
    global $conn;
    $query = "SELECT Username, Email 
              FROM user 
              WHERE Role = 'User'
              LIMIT $limit";
    return mysqli_query($conn, $query);
}
function getTopCustomers($limit = 5) {
    global $conn;
    $query = "SELECT u.Username, COUNT(b.BookingsId) AS booking_count 
              FROM user u
              LEFT JOIN bookings b ON u.User_Id = b.User_Id 
              WHERE u.Role = 'User' 
              GROUP BY u.User_Id 
              ORDER BY booking_count DESC 
              LIMIT $limit";

    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return $result;
}


function getMonthlyBookings() {
    global $conn;
    $query = "SELECT DATE_FORMAT(BookedDate, '%Y-%m') as month, 
              COUNT(*) as booking_count 
              FROM bookings 
              GROUP BY month 
              ORDER BY month DESC 
              LIMIT 6";
    return mysqli_query($conn, $query);
}
?>
