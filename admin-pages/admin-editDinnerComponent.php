<?php

echo "
  <br />
  <h1>Admin Edit Dinner</h1>
  <br /><br /><br />
";

include "account.php";
// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        ORDER BY event_date";
include "connectToDB.php";

echo "
<table>
  <tr>
    <th>Date</th>
    <th>Entrée<br/>Type</th>
    <th>
      Seats
    </th>
    <th>
      Price
    </th>
    <th>Total <br />Reserved</th>
    <th>Select</th>
  </tr>
";

while ($record = mysqli_fetch_array($sql_results)) {

  // temp variable for PROTO. For the dashboard. Everything else is live from database
  $totalReserved = 0;
  // if ($availableSeats == 0) {
  //   $avialabilityCount = 'Waitlisted: ' . $waitlist;
  //   $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
  //   $totalReserved = 32 + $waitlist;
  // }
  // // if availability these will produce the computed css or html outputs
  // else {
  //   $avialabilityCount = $availableSeats;
  //   $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
  //   $totalReserved = 32 - $avialabilityCount;
  // }

  // formats the SQL data start/end time into hh:mm AM/PM
  $event_dateArray = explode('-', $record[2]);
  $event_dateYear = $event_dateArray[0];
  $event_dateMonth = $event_dateArray[1];
  $event_dateDay = $event_dateArray[2];
  $event_dateFormatted = $event_dateMonth . "-" . $event_dateDay . "-" . $event_dateYear;

  $startTime = date_format(date_create($record[3]), "h:i A");
  $endTime = date_format(date_create($record[4]), "h:i A");
  echo "
		<tr>
			<td><strong>$event_dateFormatted</strong><br />
          $startTime-<br />
          $endTime</td>
			<td>$record[1]</td>
			<td>$record[5]</td>
      <td>$record[6]</td>
      <td>$totalReserved</td>
      <td><a href=\"admin-editOneDinner.php?dinner_id=$record[0]\" class=\"buttonLinks3\">Edit</a></td>
      

		</tr>
	";
}

echo "
    </table><br /><br />
    <a href=\"admin-dashboard.php\" class=\"buttonLinks3\" >Dashboard</a>
  ";
?>