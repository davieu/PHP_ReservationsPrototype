<?php
// --------FILENAME: admin-pages/admin-addReservationProcess.php ---------

// Purpose: This page processes the data from the admin-addResrvationUserInfo and puts
// in the DB to create a reservation

include "account.php";
include "loginCheckForSID.php";

date_default_timezone_set("America/New_York");

// has the | pipe delimited data about the specific dinner
//$entree_name|$event_dateFormatted|$startTime|$endTime|$price|$total_seats_reserved|$seats;
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
$seats = $dinnerInfoArray[6];

$reservation_total = $price * $seats_reserved;
$timestamp = date('Y-m-d H:i:s');

// added this to get the most current amount of seats reserved for the specific dinner
$sql = "SELECT total_seats_reserved FROM dinners
        WHERE dinner_id = $dinner_id";
include "connectToDB.php";

$record = mysqli_fetch_array($sql_results);
// most current data for total seats reserved for chosen dinner
$total_seats_reserved = $record['total_seats_reserved'];

// current seats resrved in SQL db for this dinner and adding the amount that is being
// resrved for this reservation.
$currentTotalSeatsReserved = $total_seats_reserved + $seats_reserved;

//to make custom confirmation code 
$random_hash = substr(md5(uniqid(rand(), true)), 16, 16);
echo "$dinner_info<br />$currentTotalSeatsReserved<br />";

if (isset($_SESSION['email'])) {
  $user_email = $_SESSION['email'];
} else {
  $user_email = '';
}

if (isset($_SESSION['email'])) {
  $user_session_ID = session_id();
} else {
  $user_session_ID = '';
}

if ($currentTotalSeatsReserved <= $seats) {
  // for logging
  $user_email = $_SESSION['email'];
  $user_session_ID = session_id();
  // include "formatToSQLhelper.php";
  echo "yesyyyy";
  // add a reservation to SQL DB
  $sql = "INSERT INTO `reservations` 
    (`dinner_id`, `reservation_index`, `session_id`, `confirmation_code`, `seats_reserved`, `timestamp`) 
    VALUES 
    ('$dinner_id', NULL, '$user_session_ID', '1', '$seats_reserved', '$timestamp')";
  // echo "$sql</br>";
  include "connectToDBID.php";

  // create confirmation code. add customer into DB with a confirmation code

  $confirmation_code = "$last_id:$random_hash";
  //echo "<br/>ssssss---$confirmation_code <br/>";
  $sql = "INSERT INTO `customers` 
    (`session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
     `reservation_index`, `confirmation_code`, `dinner_id`, `timestamp`, `seats_reserved`) 
    VALUES 
    ('$user_session_ID', '$first_name', '$last_name', '$phone_number', '$email', '$reservation_total',
     '$last_id', '$confirmation_code', '$dinner_id', '$timestamp', '$seats_reserved')";
  echo "$sql</br>$last_id:$random_hash";
  include "connectToDB.php";

  // sets the confirmation for the reservation
  $sql = "UPDATE `reservations` 
      SET `confirmation_code` = '$confirmation_code'
      WHERE  `reservation_index` = '$last_id'";
  include "connectToDB.php";
  // echo "<br/>$sql</br>$last_id:$random_hash";

  // does arithmetic to keep track of total seats reserved
  $sql = "UPDATE `dinners` 
      SET `total_seats_reserved` = `total_seats_reserved` + '$seats_reserved'
      WHERE `dinner_id` = '$dinner_id'";
  include "connectToDB.php";

  // SYSTEM LOGGING
  $sql = "INSERT INTO `logging` 
    (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
     `dinner_id`, `timestamp`, `seats_reserved`,
      `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
    VALUES 
    (NULL, '$user_session_ID', '$first_name', '$last_name', '$phone_number', '$email',
     '$reservation_total', '$dinner_id', '$timestamp',
      '$seats_reserved', 'Add_Reservation', 'True', '$user_email', '$last_id', 'null')";
  echo "<br/>$sql";
  include "connectToDB.php";

  // emails the customer with reseervation related data/confirmation code
  include "admin-addReservationSendEmail.php";
}
else {
  //ADD to WAITLIST if no available seats
  echo "wait";
  $sql = "INSERT INTO `waitlist` 
    (`dinner_id`, `waitlist_id`, `first_name`, `last_name`, `phone_number`,
     `email`, `timestamp`, `seats_reserved`) 
    VALUES 
    ('$dinner_id', NULL, '$first_name', '$last_name', '$phone_number',
     '$email', '$timestamp', '$seats_reserved')";
  // echo "$sql</br>$last_id:$random_hash";
  include "connectToDBID.php";

  // does arithmetic to keep track of total seats reserved for waitlist
  $sql = "UPDATE `dinners` 
    SET `waitlist_total_reserved` = `waitlist_total_reserved` + '$seats_reserved'
    WHERE `dinner_id` = '$dinner_id'";
  include "connectToDB.php";

    // SYSTEM LOGGING
  $sql = "INSERT INTO `logging` 
    (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
     `dinner_id`, `timestamp`, `seats_reserved`,
      `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
    VALUES 
    (NULL, '$user_session_ID', '$first_name', '$last_name', '$phone_number', '$email',
     '$reservation_total', '$dinner_id', '$timestamp',
      '$seats_reserved', 'Add_Waitlist', 'True', '$user_email', '$last_id', 'null')";
  echo "<br/>$sql";
  include "connectToDB.php";

  // emails the customer with reseervation related data/confirmation code
  include "admin-addWaitlistSendEmail.php";
}


//yyyy-mm-dd hh:mm:ss
header('Location: admin-addReservation.php');
/* $timestamp = date('Y-m-d H:i:s'); echo $timestamp; //testing $sql = "INSERT INTO `time`  (`currTime`)  VALUES  ('$timestamp')"; include "../connectToDB.php"; */
?>