<?php
include "account.php";

$dinner_id = $_GET['dinner_id'];
$successful = TRUE;
// Create SQL statement to delete from the address table
$sql = "DELETE FROM `dinners` WHERE `dinner_id`='$dinner_id'";
include "connectToDBV2.php";
echo "$sql";

$sql = "DELETE FROM `reservations` WHERE `dinner_id`='$dinner_id'";
include "connectToDBV2.php";

if ($successful) {
  // Delete the customer
  $sql = "DELETE FROM `customers` WHERE `dinner_id`='$dinner_id'";
  include "connectToDBV2.php";
//echo "$sql<br />";
}

// $sql = "SELECT waitlist_total_reserved FROM dinners
//         WHERE dinner_id = '$dinner_id'";
// include "connectToDB.php";
// $record = mysqli_fetch_array($sql_results);
// $waitlistCount = $record['entree_name'];
// echo "$waitlistCount";

$sql = "DELETE FROM `waitlist` WHERE `dinner_id`='$dinner_id'";
include "connectToDB.php";

header('Location: admin-editDinner.php');
?>