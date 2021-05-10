<?php
// --------FILENAME: admin-pages/admin-moveReservationEmail.php ---------

//Purpose: This page sends an email to the customer of the resrvation that the admin has moved the resrvation
// to a different dinner. 
// sends data pertatining to the resrvation like date and confirmation code
// include "loginCheckForSID.php";

include "../globalVariable.php";
include "helperFunctions.php";

// currently only working for school's server. Until i can make an email server for myself
// can be switched on or off by going to globalVariable.php for making a reservation with the WCC Culinary Program

// query the new dinner data
$sql = "SELECT * FROM `dinners`
        WHERE `dinner_id` = $dinner_change_id";

include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);

// parse the new dinner data
$entree_name = $record['entree_name'];
$event_date = dateSQLtoRead($record['event_date']);
$start_time = startTimeSQLtoRead($record['start_time']);
$end_time = endTimeSQLtoRead($record['end_time']);
$price = $record['price'];

echo "$entree_name<br />$event_date<br />$start_time<br />$end_time<br />$price<br />";


if ($emailEnabled) {
  $subject = "Dinner Reservation Change";
  $message = "Hello " . $first_name . " " . $last_name . " .\nWe have moved your reservation of " . $entree_name1 . "  
              to " . $entree_name . " cuisine and the event starts on " . $event_date . " at " . $start_time . "-" . $end_time .
    ". If you have any questions feel free to contact the business office.\nYour 
              confirmation code: " . $confirmation_code;


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