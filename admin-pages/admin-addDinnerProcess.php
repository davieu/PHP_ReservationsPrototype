<?php
// Purpose: proccess the form data from the admin-addDinner.php page to add into the DB

include "account.php";

// all of the data goes thru this page then parses it into the variables below
include "formatToSQLhelper.php";

$sql = "INSERT INTO `dinners` 
(`dinner_id`, `entree_name`, `event_date`, `start_time`, `end_time`, `seats`, `price`) 
VALUES 
(NULL, '$entree_name', '$event_dateFormatted', '$start_timeFormatted', '$end_timeFormatted',  '$seats', '$price')";
echo "$sql</br>";
include "../connectToDB.php";
header('Location: admin-dashboard.php');
?>