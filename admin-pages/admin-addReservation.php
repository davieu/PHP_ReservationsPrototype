<?php
include "fileLinks.php";
include "account.php";
include "../header.php";
//simulates signed in
$signedin = true;

include "../nav.php";

$stopMonth = 13;
include "../dateGenerator.php";

echo "
<div class=\"container\">
  <br /><br /><br /><br /><br /><br />
  <h1>
  Admin Add Reservation
  </h1>
  <br />
  <br />
  ";

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
      <th>Select</th>
    </tr>
";

// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        ORDER BY event_date";
include "connectToDB.php";

while ($record = mysqli_fetch_array($sql_results)) {

  // parses data from the sql and also helps with the table "Available Seats" column coloring.
  include "sqlDataParser.php";
  echo "
		<tr>
			<td><strong>$event_dateFormatted</strong><br />
          $startTime-<br />
          $endTime</td>
			<td>$record[1]</td>
			<td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
      <td><a href=\"admin-addReservationUserInfo.php?dinner_id=$record[0]\" class=\"buttonLinks3\">Edit</a></td>
		</tr>
	";
}

echo "
    </table>
  ";

echo "
  <br /><br /><br />
</div>";

include "../footer.php";
?>