<?php
//Purpose: Processes the data from the admin-editOneDinner page/form. Will update the DB for that dinner

include "account.php";
include "loginCheckForSID.php";


$dinner_id = $_GET['dinner_id'];
$previous_data = $_POST['previous_data'];
$entree_name = $_POST['entree_name'];
$event_date = $_POST['event_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$seats = $_POST['seats'];
$price = $_POST['price'];

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

include "formatToSQLhelper.php";

$sql = "UPDATE  `dinners` 
SET  
`entree_name` =  '$entree_name',
`event_date` =  '$event_dateFormatted',
`start_time` =  '$start_timeFormatted',
`end_time` =  '$end_timeFormatted',
`seats` =  '$seats',
`price` =  '$price'
WHERE  `dinner_id` ='$dinner_id'";
include "connectToDB.php";

$details = "(NEW DATE:$event_dateFormatted $start_timeFormatted-$end_timeFormatted)|(PREVIOUS: $previous_data)";

// SYSTEM LOGGING
$sql = "INSERT INTO `logging` 
    (`logging_id`, `session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
    `dinner_id`, `timestamp`, `seats_reserved`,
    `action`, `isAdmin`, `user_email`, `specific_id`, `details`) 
VALUES 
    (NULL, '$user_session_ID', 'null', 'null', 'null', 'null',
    '$price', '$dinner_id', '$timestamp',
    '$seats', 'Edit_Dinner', 'True', '$user_email', 'null', 'entree:$entree_name|$event_dateFormatted $start_timeFormatted-$end_timeFormatted')";
echo "<br/>$sql";
include "connectToDB.php";

header('Location: admin-editDinner.php');
?>