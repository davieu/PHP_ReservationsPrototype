<?php
//Purpose: Takes in the data from the admin-cancelOneWaitlist page and processes it to cancel a specific waitlist that
// was chosen

include "account.php";

$successful = TRUE;
$dinner_id = $_GET['dinner_id'];
$reservation_info = $_POST['reservation_info'];
$reservationInfoArray = explode("|", $reservation_info);
$waitlist_id = $reservationInfoArray[0];
$seats_reserved = $reservationInfoArray[1];
// delete the reservation
$sql = "DELETE FROM `waitlist` WHERE `waitlist_id`='$waitlist_id'";
include "connectToDBV2.php";

if ($successful) {
  // update the dinner data
  $sql = "UPDATE `dinners` 
    SET `waitlist_total_reserved` = `waitlist_total_reserved` - '$seats_reserved'
    WHERE `dinner_id` = '$dinner_id'";
  include "connectToDBV2.php";
//echo "$sql<br />";
}

// include "admin-cancelReservationList?dinner_id=$dinner_id.php";
header("Location: admin-cancelReservationList.php?dinner_id=$dinner_id");
?>