<?php
//Purpose: This is the table for the dashboard. Seperated to slim down the dashboard page.php.

include "account.php";

// queries record count of total dinner records.
$sql = "SELECT COUNT(`dinner_id`)
        FROM `dinners`";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);
$dinnerRecordCount = $record[0];


// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        ORDER BY event_date";
include "connectToDB.php";

// <div class=\"table-caption\">
// <h4 style=\"margin-top:0px;\">
//   Reservations Found: $recordCount   
// </h4>
//   <p>Select a reservation</p>
// </div>


// <p style=\"text-align: center;\">
//   <strong>
//     Dinner Reservations Overview<br/>
//     Dinner Records Found: $dinnerRecordCount
//   </strong>
// </p>
// <br />

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
			<td>$record[1]</td>
      <td>
        <strong>$event_dateFormatted</strong><br />
        $startTime-<br />
        $endTime
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
