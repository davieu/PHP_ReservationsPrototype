<?php
include "account.php";

$dinner_id = $_GET['dinner_id'];

// Create SQL statement to delete from the address table
$sql = "DELETE FROM `dinners` WHERE `dinner_id`='$dinner_id'";
echo "$sql";
include "connectToDB.php";
header('Location: admin-editDinner.php');
?>