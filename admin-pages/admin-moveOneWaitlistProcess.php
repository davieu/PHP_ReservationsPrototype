<?php

include "account.php";
include "loginCheckForSID.php";

$successful = TRUE;

date_default_timezone_set("America/New_York");

$dinner_id = $_GET['dinner_id'];

// NEW DINNER DATA
$new_dinner = $_POST['new_dinner'];
$newDinnerArray = explode("|", $new_dinner);
$newDinner_id = $newDinnerArray[0];
$newPrice = $newDinnerArray[1];

//reservation_info = dinner_id | waitlist_id |seats_reserved | first_name |  last_name | email | entree_name1 |
// event_date1 | phone_number;
$reservation_info = $_POST['reservation_info'];
$reservation_info = explode("|", $reservation_info);
// customer data
$waitlist_id = $reservation_info[1];
$seats_reserved = $reservation_info[2];
$first_name = $reservation_info[3];
$last_name = $reservation_info[4];
$email = $reservation_info[5];
$entree_name1 = $reservation_info[6];
$event_date1 = $reservation_info[7];
$phone_number = $reservation_info[8];

$timestamp = date('Y-m-d H:i:s');
$reservation_total = $newPrice * $seats_reserved;
echo "$newPrice<br />$seats_reserved<br />$newDinner_id";

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

// added this to get the most current amount of seats reserved for the specific new dinner
$sql = "SELECT total_seats_reserved, seats FROM dinners
        WHERE dinner_id = $newDinner_id";
include "connectToDB.php";

$record = mysqli_fetch_array($sql_results);
// most current data for total seats reserved for chosen new dinner
$total_seats_reserved = $record['total_seats_reserved'];
$seats = $record['seats'];

// current seats resrved in SQL db for this new dinner and adding the amount that is being reserved for this reservation.
$currentTotalSeatsReserved = $total_seats_reserved + $seats_reserved;

//to make custom confirmation code 
$random_hash = substr(md5(uniqid(rand(), true)), 16, 16);

// if seats are available then make a resrvation for the waitlist customer and delete the waitlist
if ($currentTotalSeatsReserved <= $seats) {
  echo "yesyyyy";
  // add a reservation to SQL DB
  $sql = "INSERT INTO `reservations` 
    (`dinner_id`, `reservation_index`, `session_id`, `confirmation_code`, `seats_reserved`, `timestamp`) 
    VALUES 
    ('$newDinner_id', NULL, '$user_session_ID', '1', '$seats_reserved', '$timestamp')";
  // echo "$sql</br>";
  include "connectToDBID.php";

  // create confirmation code. add customer into DB with a confirmation code
  $confirmation_code = "$last_id:$random_hash";
  //echo "<br/>ssssss---$confirmation_code <br/>";
  $sql = "INSERT INTO `customers` 
    (`session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`, `reservation_index`, `confirmation_code`, `dinner_id`, `timestamp`, `seats_reserved`) 
    VALUES 
    ('user_session_ID', '$first_name', '$last_name', '$phone_number', '$email', '$reservation_total', '$last_id', '$confirmation_code', '$newDinner_id', '$timestamp', '$seats_reserved')";
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
      WHERE `dinner_id` = '$newDinner_id'";
  include "connectToDB.php";


  // delete the waitlist after the dinner change happens
  $sql = "DELETE FROM `waitlist` WHERE `waitlist_id`='$waitlist_id'";
  include "connectToDBV2.php";
  // UPDATES the old dinner waitlist count. subtract from the amount since we are removing a waitlist
  if ($successful) {
    // update the dinner waitlist count data
    $sql = "UPDATE `dinners` 
      SET `waitlist_total_reserved` = `waitlist_total_reserved` - '$seats_reserved'
      WHERE `dinner_id` = '$dinner_id'";
    include "connectToDBV2.php";
    //echo "$sql<br />";

    // SYSTEM LOGGING
    $sql = "INSERT INTO `logging` 
        (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
        `dinner_id`, `timestamp`, `seats_reserved`,
        `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
    VALUES 
        (NULL, '$user_session_ID', '$first_name', '$last_name', '$phone_number', '$email',
        '$reservation_total', '$dinner_id', NULL,
        '$seats_reserved', 'Move_Waitlist_To_Reservation', 'True', '$user_email', '$waitlist_id', '$newDinner_id|$confirmation_code')";
    echo "<br/>$sql";
    include "connectToDB.php";
  }

  // emails the customer with reseervation related data/confirmation code
  include "admin-moveWaitlistEmail.php";
}
else {
  // this will more than likely not happen. since you are not able to choose unavailable dinners with no room.
  // but it could happen if multiple people use the system. So on the chance that the dinner becomes full when submitting
  // the waitlist will just be moved as a waitlist and not be created into a reservation.
  // if for some reason the newly picked dinner is full it will simply change the waitlist's dinner_id into the new 
  // dinner_id
  $sql = "UPDATE `waitlist` 
  SET `dinner_id` = '$newDinner_id'
  WHERE `waitlist_id` = '$waitlist_id'";
  include "connectToDBV2.php";


  if ($successful) {
    // update the new dinner's waitlist reservation seats count data. We add since we are putting into new dinner
    $sql = "UPDATE `dinners` 
      SET `waitlist_total_reserved` = `waitlist_total_reserved` + '$seats_reserved'
      WHERE `dinner_id` = '$newDinner_id'";
    include "connectToDBV2.php";
  //echo "$sql<br />";
  }

  if ($successful) {
    // update the original dinner's waitlist reservation seats count data. 
    // We subtract since we are essentially removing from old dinner
    $sql = "UPDATE `dinners` 
      SET `waitlist_total_reserved` = `waitlist_total_reserved` - '$seats_reserved'
      WHERE `dinner_id` = '$dinner_id'";
    include "connectToDBV2.php";
    //echo "$sql<br />";

    // SYSTEM LOGGING
    $sql = "INSERT INTO `logging` 
        (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
        `dinner_id`, `timestamp`, `seats_reserved`,
        `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
    VALUES 
        (NULL, '$user_session_ID', '$first_name', '$last_name', '$phone_number', '$email',
        'null', '$dinner_id', NULL,
        '$seats_reserved', 'Move_Waitlist_To_New_Waitlist', 'True', '$user_email', '$waitlist_id', '$newDinner_id')";
    echo "<br/>$sql";
    include "connectToDB.php";
  }
// emails the customer with reseervation related data/confirmation code
// include "admin-addWaitlistSendEmail.php";
}

header('Location: admin-dashboard.php');
?>