<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_host = "localhost";
$db_name = "toursandtravels";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$conn) {
	die("Database connection failed: " . mysqli_connect_error());
}
?>