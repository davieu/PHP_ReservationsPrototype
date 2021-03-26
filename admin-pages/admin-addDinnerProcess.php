<?php
include "account.php";

include "formatToSQLhelper.php";

$sql = "INSERT INTO `dinners` 
(`dinner_id`, `entree_name`, `event_date`, `start_time`, `end_time`, `seats`, `price`) 
VALUES 
(NULL, '$entree_name', '$event_dateFormatted', '$start_timeFormatted', '$end_timeFormatted',  '$seats', '$price')";
echo "$sql</br>";
include "../connectToDB.php";
header('Location: admin-dashboard.php');
?>