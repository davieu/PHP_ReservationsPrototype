<?php
// --------FILENAME: admin-pages/admin-addDinnerProcess.php ---------

// Purpose: proccess the form data from the admin-addDinner.php page to add into the DB

include "account.php";
include "loginCheckForSID.php";

// all of the data goes thru this page then parses it into the variables below
include "formatToSQLhelper.php";

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

$sql = "INSERT INTO `dinners` 
(`dinner_id`, `entree_name`, `event_date`, `start_time`, `end_time`, `seats`, `price`) 
VALUES 
(NULL, '$entree_name', '$event_dateFormatted', '$start_timeFormatted',
 '$end_timeFormatted',  '$seats', '$price')";
echo "$sql</br>";
include "connectToDBID.php";

// SYSTEM LOGGING
$sql = "INSERT INTO `logging` 
    (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
    `dinner_id`, `timestamp`, `seats_reserved`,
    `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
VALUES 
    (NULL, '$user_session_ID', 'null', 'null', 'null', 'null',
    '$price', '$last_id', '$timestamp',
    '$seats', 'Add_Dinner', 'True', '$user_email', 'null', '$event_dateFormatted $start_timeFormatted-$end_timeFormatted')";
echo "<br/>$sql";
include "connectToDB.php";

header('Location: admin-dashboard.php');
?>