<?php
// --------FILENAME: admin-pages/admin-emailConfirmationProcess.php ---------

//Purpose: This page sends an emails to the waitlist of the specified dinner and notifies them that a spot/s are avaailable 

include "loginCheckForSID.php";

// it's a global variable to enable sending emails or not.
include "../globalVariable.php";
include "helperFunctions.php";


$dinner_id = $_GET['dinner_id'];
// data looks like email | confirmation_code | first_name | last_name |$entree_name
$confirmationCodeData = $_POST['emailConfirmation'];

// if the checkboxes were not checked then automatically go back to the reservation list. if data empty then redirect to list page
if (count($confirmationCodeData) == 0) {
  echo "empty";
  header("Location: admin-dashboard.php");
}


// currently; only working for school's server. Until i can make an email server for myself
// can be switched on or off by going to globalVariable.php

if ($emailEnabled) {

  $subject = "Confirmation Code Request";

  $header = "MIME-Version: 1.0\r\n";
  $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $header .= 'From: daumana461' . "\r\n";
  $header .= 'Reply-To: daumana461' . "\r\n";
  $header .= "X-Mailer: PHP/" . phpversion();
  $header .= "X-Priority: 1\r\n";

  foreach ($confirmationCodeData as $currData) {
    // data looks like--- email | confirmation_code | first_name | last_name |$entree_name
    $currReservation = explode("|", $currData);
    $currEmail = $currReservation[0];
    $currconfirmation_code = $currReservation[1];
    $currFirstName = $currReservation[2];
    $currLastName = $currReservation[3];
    $currentree_name = $currReservation[4];

    $message = "Hello " . $currFirstName . " " . $currLastName .
      ", your confirmation code for the dinner event of " . $currentree_name . " is:\n" . $currconfirmation_code . "\n" .
      "We hope to see you there and thank you for supporting the WCC " . "Culinary Program.\nIf you have any questions feel free to " . "contact the business office.";
    $status = mail($currEmail, $subject, $message, $header);
  }
}

header("Location: admin-emailConfirmation.php");

/* //reference
 $emailsArray = explode(":", $emailAddresses);
 $message = wordwrap($message, 70);
 foreach ($emailsArray as $currEmail) {
 $status=mail($currEmail, $subject, $message, $header);
 }
 */
?>