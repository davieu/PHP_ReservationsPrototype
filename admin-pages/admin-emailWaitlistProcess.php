<?php
//Purpose: This page sends an emails to the waitlist of the specified dinner and notifies them that a spot/s are avaailable 

// it's a global variable to enable sending emails or not.
include "../globalVariable.php";
include "helperFunctions.php";


$dinner_id = $_GET['dinner_id'];
// data looks like email|first_name|last_name
$waitList_data = $_POST['waitlist_emails'];

// if the checkboxes were not checked then automatically go back to the reservation list. if data empty then redirect to list page
if (count($waitList_data) == 0) {
  echo "empty";
  header("Location: admin-cancelReservationList.php?dinner_id=$dinner_id");
}
//    0           1              2       3          4          5       
// entree_name|entree_name|event_date|event_date|start_time|start_time|
//    6        7      8     9       10
//end_time|end_time|seats|seats|total_seats_reserved
//Frenchy|Frenchy|2021-04-29|2021-04-29|11:30:00|11:30:00|13:30:00|13:30:00|10|10|5|5
// this is how the array looks like. since it was an associative array
$dinnerInfoArrToStr = $_POST['dinnerInfoArrToStr'];
$dinnerInfoStrToArr = explode("|", $dinnerInfoArrToStr);
$entree_name = $dinnerInfoStrToArr[0];
$event_date = dateSQLtoRead($dinnerInfoStrToArr[2]);
$start_time = startTimeSQLtoRead($dinnerInfoStrToArr[4]);
$end_time = endTimeSQLtoRead($dinnerInfoStrToArr[6]);


// currently; only working for school's server. Until i can make an email server for myself
// can be switched on or off by going to globalVariable.php
if ($emailEnabled) {

  $subject = "Dinner Reservation Openings";

  $header = "MIME-Version: 1.0\r\n";
  $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $header .= 'From: daumana461' . "\r\n";
  $header .= 'Reply-To: daumana461' . "\r\n";
  $header .= "X-Mailer: PHP/" . phpversion();
  $header .= "X-Priority: 1\r\n";

  foreach ($waitList_data as $currData) {
    $currWaitlist = explode("|", $currData);
    $currEmail = $currWaitlist[0];
    $currFirstName = $currWaitlist[1];
    $currLastName = $currWaitlist[2];

    $message = "Hello " . $currFirstName . " " . $currLastName . ", we have great news regarding your dinner 
      waitlist reservation.\nThe dinner reservation of $entree_name cuisine on $event_date has 
      openings.\nWe hope to see you there and thank you for supporting the WCC Culinary Program.\nIf you have any 
      questions feel free to contact the business office.";
    $status = mail($currEmail, $subject, $message, $header);
  }
}

header("Location: admin-cancelReservationList.php?dinner_id=$dinner_id");
/* //reference
 $emailsArray = explode(":", $emailAddresses);
 $message = wordwrap($message, 70);
 foreach ($emailsArray as $currEmail) {
 $status=mail($currEmail, $subject, $message, $header);
 }
 */
?>