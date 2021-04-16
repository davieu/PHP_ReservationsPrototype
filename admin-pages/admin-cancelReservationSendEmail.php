<?php
//Purpose: This page sends an emails to the customer of the resrvation notifying the customer that their reservation 
// has been canceled. 

// it's a global variable to enable sending emails or not.
include "../globalVariable.php";
//$dinnerInfoArray = 

// currently only working for school's server. Until i can make an email server for myself
// can be switched on or off by going to globalVariable.php
if ($emailEnabled) {
  $subject = "Dinner Reservation Cancelation";
  $message = "Your dinner cancelation has been confirmed.\n" . $first_name . " " . $last_name . " we hope to see you for a future dinner event and thank you for supporting the WCC Culinary Program.\nIf you have any questions feel free to contact the business office.";

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