<?php
include "account.php";
// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        ORDER BY event_date";
include "connectToDB.php";

echo "
Filter by Meals: ALL <br />Moraccan, German, Cajun
<br /><br />
";

echo "
<table>
  <tr>
    <th>Date</th>
    <th>Entrée<br/>Type</th>
    <th>
      Available<br />
      Seats
    </th>
    <th>Total <br />Reserved</th>
  </tr>
";

while ($record = mysqli_fetch_array($sql_results)) {

  // temp variable for PROTO. For the dashboard. Everything else is live from database
  $availableSeats = 32;
  $avialabilityCount = 32;
  $waitlist = 0;
  $inlineStyleAvailabiltyColor;
  $totalReserved = 0;



  if ($availableSeats == 0) {
    $avialabilityCount = 'Waitlisted: ' . $waitlist;
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
    $totalReserved = 32 + $waitlist;
  }
  // if availability these will produce the computed css or html outputs
  else {
    $avialabilityCount = $availableSeats;
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
    $totalReserved = 32 - $avialabilityCount;
  }

  $event_dateArray = explode('-', $record[2]);
  $event_dateYear = $event_dateArray[0];
  $event_dateMonth = $event_dateArray[1];
  $event_dateDay = $event_dateArray[2];
  $event_dateFormatted = $event_dateMonth . "-" . $event_dateDay . "-" . $event_dateYear;

  // formats the SQL data start/end time into hh:mm AM/PM
  $startTime = date_format(date_create($record[3]), "h:i A");
  $endTime = date_format(date_create($record[4]), "h:i A");
  echo "
		<tr>
			<td><strong>$event_dateFormatted</strong><br />
          $startTime-<br />
          $endTime</td>
			<td>$record[1]</td>
			<td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
			<td>$totalReserved</td>

		</tr>
	";
}

echo "
    </table>

  ";


?>

<!-- echo "
<table>
  <tr>
    <th>Date</th>
    <th>Entrée<br/>Type</th>
    <th>
      Available<br />
      Seats
    </th>
    <th>Total <br />Reserved</th>
  </tr>
";

$avialabilityCount;
$inlineStyleAvailabiltyColor;
$totalReserved;


for ($i = 0; $i < count($datesArray); $i++) {
  // if no availability these will produce the computed css or html outputs
  if ($availableSeats[$i] == 0) {
    $avialabilityCount = 'Waitlisted: ' . $waitlist[$i];
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
    $totalReserved = 32 + $waitlist[$i];
  }
  // if availability these will produce the computed css or html outputs
  else {
    $avialabilityCount = $availableSeats[$i];
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
    $totalReserved = 32 - $avialabilityCount;
  }
  // populates the table
  echo "
      <tr>
        <td>$datesArray[$i]<br />6:00PM</td>
        <td>Moroccan</td>
        <td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
        <td>$totalReserved</td>
      </tr>
      ";
}

echo "
    </table>

  "; -->