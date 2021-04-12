<?php
// Purpose: This page processes the data from the admin-addResrvationUserInfo and puts in the DB to create a reservation

include "account.php";

date_default_timezone_set("America/New_York");

// has the | pipe delimited data about the specific dinner
//$entree_name|$event_dateFormatted|$startTime|$endTime|$price;
$dinner_info = $_POST['dinner_info'];
$dinnerInfoArray = explode("|", $dinner_info);

$dinner_id = $_GET['dinner_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
//$reservation_total = $_POST['reservation_total'];
$seats_reserved = $_POST['seats_reserved'];
$price = $dinnerInfoArray[4];

$reservation_total = $price * $seats_reserved;
$timestamp = date('Y-m-d H:i:s');

//to make custom confirmation code 
$random_hash = substr(md5(uniqid(rand(), true)), 16, 16);

echo "
$dinner_id <br /> $price<br /> $first_name <br />$last_name <br />$seats_reserved <br />$reservation_total<br />
";

/* // TESTING echo " $dinner_id <br /> $price<br /> $first_name <br />$last_name <br />$seats_reserved <br />$reservation_total<br />$dinner_info "; /*
 /* //CUSTOMERS session_id	 first_name	 last_name	 phone_number	 reservation_total	 confirmation_code	 timestamp	 seats_reserved	
 //RESERVATIONS confirmation_code	 session_id	 seats_reserved	 timestamp */

// include "formatToSQLhelper.php";
$sql = "INSERT INTO `reservations` 
      (`dinner_id`, `reservation_index`, `session_id`, `seats_reserved`, `timestamp`) 
      VALUES 
      ('$dinner_id', NULL, '1', '$seats_reserved', '$timestamp')";
echo "$sql</br>";
include "connectToDBID.php";


$confirmation_code = "$last_id:$random_hash";
//echo "<br/>ssssss---$confirmation_code <br/>";
$sql = "INSERT INTO `customers` 
      (`session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`, `reservation_index`, `confirmation_code`, `timestamp`, `seats_reserved`) 
      VALUES 
      ('1', '$first_name', '$last_name', '$phone_number', '$email', '$reservation_total',  '$last_id', '$confirmation_code', '$timestamp', '$seats_reserved')";
echo "$sql</br>$last_id:$random_hash";
include "connectToDB.php";

// sets the confirmation for the reservation
$sql = "UPDATE `reservations` 
        SET `confirmation_code` = '$confirmation_code'
        WHERE  `reservation_index` = '$last_id'";
include "connectToDB.php";
echo "<br/>$sql</br>$last_id:$random_hash";

// does arithmetic to keep track of total seats reserved
echo "id: $last_id";
$sql = "UPDATE `dinners` 
        SET `total_seats_reserved` = `total_seats_reserved` + '$seats_reserved'
        WHERE `dinner_id` = '$dinner_id'";
include "connectToDB.php";

include "admin-addReservationSendEmail.php";


//yyyy-mm-dd hh:mm:ss
//header('Location: admin-addReservation.php');
/* $timestamp = date('Y-m-d H:i:s'); echo $timestamp; //testing $sql = "INSERT INTO `time`  (`currTime`)  VALUES  ('$timestamp')"; include "../connectToDB.php"; */
?>