<?php

// sets default timezone for EST
date_default_timezone_set("America/New_York");

// Only displays Thursdays to reserve
function populateReservationTable()
{
  // current date = 12-2-2021
  $currDate = date('d-m-Y');
  // splits date by '-' into an array
  $currDateArray = explode('-', $currDate);

  $currYear = $currDateArray[2];
  $currMonth = $currDateArray[1];
  $currDay = $currDateArray[0];
  $counter = 0;

  // targets only current year (2021) 
  $stopMonth = 5; // Change to stop what month to stop poulating data at
  for ($currMonthInt = (int)$currMonth; $currMonthInt < $stopMonth; $currMonthInt++) {

    // string for month-day-year  ex. 12-14-2021
    $dateStr = $currMonthInt . '-'; // 'month-'
    $dateStr2 = '-' . $currYear; // '-year'

    // used for the date() to parse correctly. day-month-year
    $dateParseStr = '-' . $currMonthInt . '-' . $currYear; // '-month-year' for the date() to parse into 

    // pseudo code for telling table when to start depending on current date's day
    // if the current month's (int)date is equal to the loops (int) then start from the current day only for this month
    if ($currMonth == $currMonthInt) {
      $startDay = (int)$currDay;
    }
    // else it will start from day 1 since it will populate each month from the first day
    else {
      $startDay = 1;
    }

    // accurate method to find length of calander days for a month
    $numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currMonthInt, (int)$currYear);

    // NESTED LOOP for the days. 
    for ($startDay; $startDay <= $numberOfDaysInMonth; $startDay++) {
      include '../customerData.php';
      // if loop is just for formatting the visual of the date. will add a '0' if the day is a single digit. 
      // ex. if the day 3 it will make it look like 03
      if (strlen($startDay) == 1) {
        $ddd = $dateStr . '0' . $startDay . $dateStr2;
        $dddParse = '0' . $startDay . $dateParseStr;
      }
      else {
        $ddd = $dateStr . $startDay . $dateStr2;
        $dddParse = $startDay . $dateParseStr;
      }

      // date format
      $date = date('M d D Y', $time = strtotime($dddParse));

      $avialabilityCount;
      $inlineStyleAvailabiltyColor;
      if ($availableSeats[$counter] == 0) {
        $avialabilityCount = 'Waitlisted: ' . $waitlist[$counter];
        $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
      }
      else {
        $avialabilityCount = $availableSeats[$counter];
        $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
      }
      // if date is a thurs then echo it
      if (strpos($date, 'Thu')) {
        echo "
          <tr>
            <td>$ddd<br />6:00PM</td>
            <td>Moroccan</td>
            <td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
            <td>
              <select name=\"cars\" id=\"cars\">
                <option value=\"0\">0</option>
                <option value=\"1\">1</option>
                <option value=\"2\">2</option>
                <option value=\"3\" selected=\"selected\">$makeReservation[$counter]</option>
                <option value=\"4\">4</option>
              </select>
            </td>
            <!-- <td><a href=\"userInfo.html\" class=\"buttonLinks2\">Reserve Now</a></td> -->
          </tr>
       ";
        $counter++;
      }
    }
  }
  echo '<br />';

}
echo "

    <table>
      <tr>
        <th>Date</th>
        <th>Entrée<br/>Type</th>
        <th>
          Available<br />
          Seats
        </th>
        <th>Make a <br />Reservation</th>
      </tr>
  ";
// inserts the table's data'
populateReservationTable();

echo "
    </table>

  ";
?>