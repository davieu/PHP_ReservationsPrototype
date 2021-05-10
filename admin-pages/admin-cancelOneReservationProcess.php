<?php
// --------FILENAME: admin-pages/admin-cancelOneReservationProcess.php ---------

//Purpose: Takes in the data from the admin-cancelOneReservation page and processes it to cancel a specific reservation that
// was chosen

include "account.php";
include "loginCheckForSID.php";

$successful = TRUE;
// $dinner_id = $_GET['dinner_id'];
$reservation_info = $_POST['reservation_info'];
//$reservation_info = $dinner_id . "|" . $confirmation_code . "|" . $seats_reserved . "|" . $first_name . "|" . $last_name . "|" . $email;
$reservationInfoArray = explode("|", $reservation_info);

$dinner_id = $reservationInfoArray[0];
$confirmation_code = $reservationInfoArray[1];
$seats_reserved = $reservationInfoArray[2];
$first_name = $reservationInfoArray[3];
$last_name = $reservationInfoArray[4];
$email = $reservationInfoArray[5];

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

// delete the reservation
$sql = "DELETE FROM `reservations` WHERE `confirmation_code`='$confirmation_code'";
include "connectToDBV2.php";

if ($successful) {
  // Delete the customer
  $sql = "DELETE FROM `customers` WHERE `confirmation_code`='$confirmation_code'";
  include "connectToDBV2.php";
//echo "$sql<br />";
}

if ($successful) {
  // update the dinner reservation seats count data
  $sql = "UPDATE `dinners` 
    SET `total_seats_reserved` = `total_seats_reserved` - '$seats_reserved'
    WHERE `dinner_id` = '$dinner_id'";
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
      '$seats_reserved', 'Cancel_Reservation', 'True', '$user_email', '$confirmation_code', 'null')";
  echo "<br/>$sql";
  include "connectToDB.php";
}


// send email to customer with canceled resrvation
include "admin-cancelReservationSendEmail.php";

// gets record count of total waitlist records.
$sql = "SELECT COUNT(`waitlist_id`)
        FROM waitlist
        WHERE  `dinner_id` = '$dinner_id'";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);
$waitlistRecordCount = $record[0];


// looks at the waitlist record count for a dinner with the specified ID. If waitlist records found then
// redirect to the waitlist email page. If no waitlists then send back to reservation lists.
if ($waitlistRecordCount > 0) {
  // send email to customer with canceled resrvation
  header("Location: admin-emailWaitlist.php?dinner_id=$dinner_id");
}
else {
  header("Location: admin-cancelReservationList.php?dinner_id=$dinner_id");
}
?>