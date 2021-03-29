<?php
// temp variable for PROTO. For the dashboard. Everything else is live from database
$availableSeats = 32;
$avialabilityCount = 32;
$waitlist = 0;
$inlineStyleAvailabiltyColor;

if ($availableSeats == 0) {
  $avialabilityCount = 'Waitlisted: ' . $waitlist;
  $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
}
// if availability these will produce the computed css or html outputs
else {
  $avialabilityCount = $availableSeats;
  $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
}

$event_dateArray = explode('-', $record[2]);
$event_dateYear = $event_dateArray[0];
$event_dateMonth = $event_dateArray[1];
$event_dateDay = $event_dateArray[2];
$event_dateFormatted = $event_dateMonth . "-" . $event_dateDay . "-" . $event_dateYear;

// formats the SQL data start/end time into hh:mm AM/PM
$startTime = date_format(date_create($record[3]), "h:i A");
$endTime = date_format(date_create($record[4]), "h:i A");
?>