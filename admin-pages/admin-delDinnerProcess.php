<?php
include "account.php";
include "loginCheckForSID.php";

$dinner_id = $_GET['dinner_id'];
$successful = TRUE;

// delete the dinner from the dinners table with the specified id
$sql = "DELETE FROM `dinners` WHERE `dinner_id`='$dinner_id'";
include "connectToDBV2.php";
echo "$sql";

// delete any reservations related to the dinner that was chosen for deletion
$sql = "DELETE FROM `reservations` WHERE `dinner_id`='$dinner_id'";
include "connectToDBV2.php";

if ($successful) {
  // delete any customers related to the dinner that was chosen for deletion
  $sql = "DELETE FROM `customers` WHERE `dinner_id`='$dinner_id'";
  include "connectToDBV2.php";
  //echo "$sql<br />";

    // SYSTEM LOGGING
  $sql = "INSERT INTO `logging` 
      (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
      `dinner_id`, `timestamp`, `seats_reserved`,
      `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
  VALUES 
      (NULL, '$user_session_ID', 'null', 'null', 'null', 'null',
      '0', '$dinner_id', NULL,
      '0', 'Delete_Dinner', 'True', '$user_email', 'null', 'null')";
  echo "<br/>$sql";
  include "connectToDB.php";
}

// delete any waitlists related to the dinner that was chosen for deletion
$sql = "DELETE FROM `waitlist` WHERE `dinner_id`='$dinner_id'";
include "connectToDB.php";

header('Location: admin-editDinner.php');
?>