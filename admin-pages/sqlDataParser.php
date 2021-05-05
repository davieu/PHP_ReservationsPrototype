<?php
// temp variable for PROTO. For the dashboard. Everything else is live from database
// include "loginCheckForSID.php";

$availableSeats = $record['seats'];
$availabilityCount = $record['seats'] - $record['total_seats_reserved'];
$waitlist = $record['seats'] - $record['total_seats_reserved'];
$inlineStyleAvailabiltyColor = "";
$inlineStyleWaitlistColor = "";
$totalReserved = $record['total_seats_reserved'];
$waitlistReservedSeats = $record['waitlist_total_reserved'];
$SUM_waitlistAndReserved = $totalReserved + $waitlistReservedSeats;
$test = $record['seats'];
$waitlisted = false;


if ($availabilityCount > 0 and $waitlistReservedSeats < 1) {
  $waitlisted = true;
  $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
}
else {
  $waitlisted = false;
  $inlineStyleAvailabiltyColor = 'style="background-color: rgb(255, 244, 146)"';
}

if ($availabilityCount == 0 and $waitlistReservedSeats == 0) {
  $waitlisted = true;
  $inlineStyleAvailabiltyColor = 'style="background-color: rgb(255, 244, 146)"';
}
// elseif ($availabilityCount == 0) {
//   $waitlisted = true;
//   $availabilityCount = 'Waitlist:<br/ > ' . $waitlistReservedSeats;
//   $inlineStyleAvailabiltyColor = 'style="background-color: rgb(255, 244, 146)"';
// }
// // if availability these will produce the computed css or html outputs
// else {
//   $waitlisted = true;
//   $availabilityCount = 'Waitlist:<br/ > ' . $waitlistReservedSeats;
//   $inlineStyleAvailabiltyColor = 'style="background-color: rgb(255, 244, 146)"';
// }

// if ($waitlistReservedSeats > 0) {
//   $inlineStyleWaitlistColor = 'Waitlist:<br/ > ' . $waitlistReservedSeats;
//   $inlineStyleWaitlistColor = 'style="background-color: rgb(255, 244, 146)"';
// }

$event_dateArray = explode('-', $record[2]);
$event_dateYear = $event_dateArray[0];
$event_dateMonth = $event_dateArray[1];
$event_dateDay = $event_dateArray[2];
$event_dateFormatted = $event_dateMonth . "/" . $event_dateDay . "/" . $event_dateYear;

// formats the SQL data start/end time into hh:mm AM/PM
$startTime = date_format(date_create($record[3]), "h:i A");
$endTime = date_format(date_create($record[4]), "h:i A");
?>