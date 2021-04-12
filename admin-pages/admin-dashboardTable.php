<?php
//Purpose: This is the table for the dashboard. Seperated to slim down the dashboard page.php.

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
  include "sqlDataParser.php";
  echo "
		<tr>
			<td><strong>$event_dateFormatted</strong><br />
          $startTime-<br />
          $endTime</td>
			<td>$record[1]</td>
			<td $inlineStyleAvailabiltyColor>$availabilityCount</td>
			<td>$SUM_waitlistAndReserved</td>
		</tr>
	";
}

echo "
    </table>

  ";
?>
