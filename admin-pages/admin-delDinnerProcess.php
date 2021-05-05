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
}

// delete any waitlists related to the dinner that was chosen for deletion
$sql = "DELETE FROM `waitlist` WHERE `dinner_id`='$dinner_id'";
include "connectToDB.php";

header('Location: admin-editDinner.php');
?>