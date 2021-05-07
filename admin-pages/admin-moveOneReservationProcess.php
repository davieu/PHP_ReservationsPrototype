<?php
include "account.php";
include "loginCheckForSID.php";

$dinner_id = $_GET['dinner_id'];
$dinner_change_id = $_POST['dinner_change_id'];

//reservation_info = dinner_id | confirmation_code | seats_reserved | first_name | last_name |
//                     email | entree_name1 | event_date1;
$reservation_info = $_POST['reservation_info'];

$reservation_info = explode("|", $reservation_info);

// customer data
$confirmation_code = $reservation_info[1];
$seats_reserved = $reservation_info[2];
$first_name = $reservation_info[3];
$last_name = $reservation_info[4];
$email = $reservation_info[5];
$entree_name1 = $reservation_info[6];
$event_date1 = $reservation_info[7];

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

$successful = TRUE;
echo "currDINNER: $dinner_id<br />changedDINNER: $dinner_change_id<br />
confirmation: $confirmation_code<br/>$seats_reserved<br/>$email<br/>$first_name<br/>$entree_name1<br/>$event_date1";

// update the reservation dinner_id. moves the dinner to specified new dinner/dinner_id
$sql = "UPDATE `reservations` 
SET `dinner_id` = '$dinner_change_id'
WHERE `confirmation_code` = '$confirmation_code'";
include "connectToDBV2.php";

// update the customer dinner_id. moves the dinner to specified new dinner/dinner_id
if ($successful) {
  $sql = "UPDATE `customers` 
  SET `dinner_id` = '$dinner_change_id'
  WHERE `confirmation_code` = '$confirmation_code'";
  include "connectToDBV2.php";
}

if ($successful) {
  // update the dinner reservation seats count data. Since the customer is changing dinners. 
  // this subtracts seats from the original dinner reserved total_seats_reserved field in the dinners table. 
  $sql = "UPDATE `dinners` 
    SET `total_seats_reserved` = `total_seats_reserved` - '$seats_reserved'
    WHERE `dinner_id` = '$dinner_id'";
  include "connectToDBV2.php";
//echo "$sql<br />";
}

if ($successful) {
  // update the dinner reservation seats count data. Since the customer is changing dinners. 
  // this adds seats to the newly picked dinner's reserved total_seats_reserved field in the dinners table. 
  $sql = "UPDATE `dinners` 
    SET `total_seats_reserved` = `total_seats_reserved` + '$seats_reserved'
    WHERE `dinner_id` = '$dinner_change_id'";
  include "connectToDBV2.php";
  //echo "$sql<br />";

  // SYSTEM LOGGING
  $sql = "INSERT INTO `logging` 
      (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
      `dinner_id`, `timestamp`, `seats_reserved`,
      `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
  VALUES 
      (NULL, '$user_session_ID', '$first_name', '$last_name', 'null', '$email',
      '0', '$dinner_id', NULL,
      '$seats_reserved', 'Move_Reservation', 'True', '$user_email', '$confirmation_code', '$dinner_change_id')";
  echo "<br/>$sql";
  include "connectToDB.php";
}

// emails the customer, notifying them of the dinner change
include "admin-moveReservationEmail.php";



header('Location: admin-dashboard.php');

?>