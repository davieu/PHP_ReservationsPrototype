<?php
//Purpose: Takes in the data from the admin-cancelOneReservation page and processes it to cancel a specific reservation that
// was chosen

include "account.php";

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
}

// send email to customer with canceled resrvation
//include "admin-cancelReservationSendEmail.php";

header("Location: admin-cancelReservationList.php?dinner_id=$dinner_id");
?>