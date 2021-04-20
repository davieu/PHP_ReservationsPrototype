<?php
include "account.php";

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

$successful = TRUE;
echo "currDINNER: $dinner_id<br />changedDINNER: $dinner_change_id<br />
confirmation: $confirmation_code<br/>$seats_reserved<br/>$email<br/>$first_name<br/>$entree_name1<br/>$event_date1";

$sql = "UPDATE `reservations` 
SET `dinner_id` = '$dinner_change_id'
WHERE `confirmation_code` = '$confirmation_code'";
include "connectToDBV2.php";


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
}

// emails the customer, notifying them of the dinner change
include "admin-moveReservationEmail.php";



// header('Location: admin-editDinner.php');

?>