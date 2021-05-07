<?php
//Purpose: This is the table for the dashboard. Seperated to slim down the dashboard page.php.
// It is also for viewing reservations and waitlists

include "account.php";
// include "loginCheckForSID.php";

// queries record count of total dinner records.
$sql = "SELECT COUNT(`dinner_id`)
        FROM `dinners`";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);
$dinnerRecordCount = $record[0];


$today = date("Y-m-d");
// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        WHERE `event_date` >= '$today'
        ORDER BY event_date";
include "connectToDB.php";

echo "
<div class=\"table-caption elementWidth\" >
  <p style=\"text-align: center;\">
    <strong>
      Dinner Reservations Overview</strong><br/>
      Dinner Records Found: $dinnerRecordCount
  </p>
</div>

<div class=\"table-container\">
  <table class=\"table table-hover align-middle\">
    <tr>
      <th>Entrée&nbspType</th>
      <th>Date</th>
      <th>Price</th>
      <th>Seats</th>
      <th>
        Available&nbspSeats
      </th>
      <th>Total&nbspReserved</th>
    </tr>
";

while ($record = mysqli_fetch_array($sql_results)) {
  include "sqlDataParser.php";
  // will determine what is placed in the Available Seats td. based on the sqlDataParser logic
  $tdAvailableSeats = $availabilityCount;
  if (!$waitlisted) {
    $tdAvailableSeats = "Available:&nbsp$availabilityCount<br/>
    Waitlist:&nbsp$waitlistReservedSeats";
  }
  echo "
		<tr>
			<td>
        <a href=\"admin-viewReservationList.php?dinner_id=$record[0]\" 
          class=\"buttonLinksTables tableSelect\">
            $record[1]
        </a>
      </td>
      <td>
        <strong>$event_dateFormatted</strong><br />
        $startTime-$endTime
      </td>
      <td>$$record[price]</td>
      <td>$record[seats]</td>
			<td $inlineStyleAvailabiltyColor style=\"width:10rem\">
        $tdAvailableSeats
      </td>
			<td>$totalReserved</td>
		</tr>
	";
}

echo "
      </table>
    </div>

  ";
?>
