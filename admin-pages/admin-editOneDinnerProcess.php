<?php
include "account.php";

$dinner_id = $_GET['dinner_id'];
$entree_name = $_POST['entree_name'];
$event_date = $_POST['event_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$seats = $_POST['seats'];
$price = $_POST['price'];

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

// connectToDBID to insert and retrieve the id.
include "connectToDB.php";
header('Location: admin-editDinner.php');
?>