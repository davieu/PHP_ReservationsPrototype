<?php
include "account.php";
date_default_timezone_set("America/New_York");

$dinner_id = $_GET['dinner_id'];
$price = $_GET['price'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone_number = $_POST['phone_number'];
//$reservation_total = $_POST['reservation_total'];
$seats_reserved = $_POST['seats_reserved'];
$reservation_total = $price * $seats_reserved;
$timestamp = date('Y-m-d H:i:s');

echo "
$dinner_id <br /> $price<br /> $first_name <br />$last_name <br />$seats_reserved <br />$reservation_total<br />
";



/* //CUSTOMERS session_id	 first_name	 last_name	 phone_number	 reservation_total	 confirmation_code	 timestamp	 seats_reserved	
 //RESERVATIONS confirmation_code	 session_id	 seats_reserved	 timestamp */

// include "formatToSQLhelper.php";
$sql = "INSERT INTO `reservations` 
(`dinner_id`, `confirmation_code`, `session_id`, `seats_reserved`, `timestamp`) 
VALUES 
('$dinner_id', NULL, '1', '$seats_reserved', '$timestamp')";
echo "$sql</br>";
include "connectToDBID.php";

$sql = "INSERT INTO `customers` 
(`session_id`, `first_name`, `last_name`, `phone_number`, `reservation_total`, `confirmation_code`, `timestamp`, `seats_reserved`) 
VALUES 
('1', '$first_name', '$last_name', '$phone_number', '$reservation_total',  '$last_id', '$timestamp', '$seats_reserved')";
echo "$sql</br>";
include "connectToDB.php";

$sql = "UPDATE  `dinners` 
SET  
`total_seats_reserved` =  `total_seats_reserved` + '$seats_reserved'
WHERE  `dinner_id` ='$dinner_id'";
include "connectToDB.php";


//yyyy-mm-dd hh:mm:ss
header('Location: admin-dashboard.php');
/* $timestamp = date('Y-m-d H:i:s'); echo $timestamp; //testing $sql = "INSERT INTO `time`  (`currTime`)  VALUES  ('$timestamp')"; include "../connectToDB.php"; */
?>