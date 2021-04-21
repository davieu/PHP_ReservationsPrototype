<?php
//Purpose: Takes in the data from the admin-cancelOneWaitlist page and processes it to cancel a specific waitlist that
// was chosen

include "account.php";

$successful = TRUE;
//$dinner_id = $_GET['dinner_id'];
$reservation_info = $_POST['reservation_info'];
// $reservation_info = $dinner_id . "|" . $waitlist_id . "|" . $seats_reserved . "|" . $first_name . "|" . $last_name . "|" . $email;
$reservationInfoArray = explode("|", $reservation_info);

$dinner_id = $reservationInfoArray[0];
$waitlist_id = $reservationInfoArray[1];
$seats_reserved = $reservationInfoArray[2];
$first_name = $reservationInfoArray[3];
$last_name = $reservationInfoArray[4];
$email = $reservationInfoArray[5];

// delete the waitlist
$sql = "DELETE FROM `waitlist` WHERE `waitlist_id`='$waitlist_id'";
include "connectToDBV2.php";

if ($successful) {
  // update the dinner waitlist count data
  $sql = "UPDATE `dinners` 
    SET `waitlist_total_reserved` = `waitlist_total_reserved` - '$seats_reserved'
    WHERE `dinner_id` = '$dinner_id'";
  include "connectToDBV2.php";
//echo "$sql<br />";
}

// send email to customer with canceled waitlist
include "admin-cancelWaitlistSendEmail.php";

// include "admin-cancelReservationList?dinner_id=$dinner_id.php";
header("Location: admin-cancelReservationList.php?dinner_id=$dinner_id");
?>