<?php
// will have certain functions for converting single items. Until whole site is formatted/refactored
function dateSQLtoRead($parseDate)
{
  $event_dateArray = explode('-', $parseDate);
  $event_dateYear = $event_dateArray[0];
  $event_dateMonth = $event_dateArray[1];
  $event_dateDay = $event_dateArray[2];
  return $event_dateMonth . "-" . $event_dateDay . "-" . $event_dateYear;
}
?>