<?php
//Purpose: This page sends an email to the customer of the resrvation that the admin has made a resrvation. 
// sends data pertatining to the resrvation like date and confirmation code
// include "loginCheckForSID.php";

include "../globalVariable.php";
//$dinnerInfoArray = 
//$entree_name|$event_dateFormatted|$startTime|$endTime|$price;

// currently only working for school's server. Until i can make an email server for myself
// can be switched on or off by going to globalVariable.php
if ($emailEnabled) {
  $subject = "Dinner Reservation Confirmation";
  $message = "Thank you " . $first_name . " " . $last_name . " for making a reservation with the WCC Culinary 
              Program.\nThe dinner will be based on " . $dinnerInfoArray[0] . " dishes.\nThe event starts 
              on " . $dinnerInfoArray[1] . " at " . $dinnerInfoArray[2] . "-" . $dinnerInfoArray[3] . ".\nYour total is 
              $" . $reservation_total . " for " . $seats_reserved . " seat(s).\nIf you have any questions feel free to 
              contact the business office.\nYour confirmation code: " . $confirmation_code;

  $header = "MIME-Version: 1.0\r\n";
  $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $header .= 'From: daumana461' . "\r\n";
  $header .= 'Reply-To: daumana461' . "\r\n";
  $header .= "X-Mailer: PHP/" . phpversion();
  $header .= "X-Priority: 1\r\n";

  $status = mail($email, $subject, $message, $header);
}

/*
 $emailsArray = explode(":", $emailAddresses);
 $message = wordwrap($message, 70);
 foreach ($emailsArray as $currEmail) {
 $status=mail($currEmail, $subject, $message, $header);
 }
 */
?>