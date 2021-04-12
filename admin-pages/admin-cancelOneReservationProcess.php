<?php
//Purpose: Takes in the data from the admin-cancelOneReservation page and processes it to cancel a specific reservation that
// was chosen

include "account.php";

$successful = TRUE;
$dinner_id = $_GET['dinner_id'];
$reservation_info = $_POST['reservation_info'];
$reservationInfoArray = explode("|", $reservation_info);
$confirmation_code = $reservationInfoArray[0];
$seats_reserved = $reservationInfoArray[1];
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
  // update the dinner data
  $sql = "UPDATE `dinners` 
    SET `total_seats_reserved` = `total_seats_reserved` - '$seats_reserved'
    WHERE `dinner_id` = '$dinner_id'";
  include "connectToDBV2.php";
//echo "$sql<br />";
}

// include "admin-cancelReservationList?dinner_id=$dinner_id.php";
header("Location: admin-cancelReservationList.php?dinner_id=$dinner_id");
?>