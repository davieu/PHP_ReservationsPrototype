<?php
// yyyy-mm-dd convert to readable format mm-dd-yyyy
$event_dateArray = explode('-', $event_date);
$event_dateYear = $event_dateArray[0];
$event_dateMonth = $event_dateArray[1];
$event_dateDay = $event_dateArray[2];
$event_dateFormatted = $event_dateMonth . "-" . $event_dateDay . "-" . $event_dateYear;
// //hhmmss convert to readable hh:mm AM/PM
// $start_timeArray = explode(':', $start_time);
// $start_timeHour = $start_timeArray[0];
// $start_timeMin = $start_timeArray[1];

// $end_timeArray = explode(':', $end_time);
// $end_timeHour = $end_timeArray[0];
// $end_timeMin = $end_timeArray[1];

// $event_dateFormatted = $event_dateYear . "-" . $event_dateMonth . "-" . $event_dateDay;
// $start_timeFormatted = $start_timeHour . $start_timeMin . "00";
// $end_timeFormatted = $end_timeHour . $end_timeMin . "00";

/* echo " entree name: $entree_name <br /> event date: $event_date <br /> start time: $start_time <br /> end time: $end_time <br /> seats: $seats <br /> price: $price <br /> event_dateYear: $event_dateYear<br /> event_dateMonth: $event_dateMonth<br /> event_dateDay: $event_dateDay<br /> date_eventFormatted: $event_dateFormatted<br /> start_timeHour: $start_timeHour<br /> start_timeMin: $start_timeMin<br /> end_timeHour: $end_timeHour<br /> end_timeMin: $end_timeMin<br /> start_timeFormatted: $start_timeFormatted<br /> end_timeFormatted: $end_timeFormatted<br /> "; */
?>