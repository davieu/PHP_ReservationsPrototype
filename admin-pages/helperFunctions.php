<?php
//Purpose: Helper functions to quickly convert/pasrse data to desired format

// will have certain functions for converting single items. Until whole site is formatted/refactored
function dateSQLtoRead($parseDate)
{
  $event_dateArray = explode('-', $parseDate);
  $event_dateYear = $event_dateArray[0];
  $event_dateMonth = $event_dateArray[1];
  $event_dateDay = $event_dateArray[2];
  return $event_dateMonth . "-" . $event_dateDay . "-" . $event_dateYear;
}


// formats the SQL data start/end time into hh:mm AM/PM
function startTimeSQLtoRead($parseStartTime)
{
  $startTime = date_format(date_create($parseStartTime), "h:i A");
  return $startTime;
}

function endTimeSQLtoRead($parseEndTime)
{
  $endTime = date_format(date_create($parseEndTime), "h:i A");
  return $endTime;
}

// for the inline style of coloring the seat availability
function inlineTableColor($availableSeats)
{

  $inlineStyleAvailabiltyColor = "";

  if ($availableSeats > 0) {
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';

  }
  elseif ($availableSeats == 0) {
    $waitlisted = true;
    $availableSeats = 'Waitlist:<br/ > ' . $waitlistReservedSeats;
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(255, 244, 146)"';
  }
  // if availability these will produce the computed css or html outputs
  else {
    $waitlisted = true;
    $availableSeats = 'Waitlist:<br/ > ' . $waitlistReservedSeats;
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(255, 244, 146)"';
  }
}

?>