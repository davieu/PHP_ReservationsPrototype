<?php
//Purpose: This page shows a list of current reservations that when you click it will take you to the admin-editOneDinner.php
// shows list of dinners that ypu can edit.

include "loginCheckForSID.php";

include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;
include "../nav.php";

echo "<div class=\"container\"><br />
<br />
<br />
<br />
<br />
<br />";
$stopMonth = 13;
include "../dateGenerator.php";
echo "
  <br />
  <h1>Admin Edit Dinner</h1>
  <br />
  <br />
  <p><strong>Select a meal to edit</strong></p>
";

include "account.php";
// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        ORDER BY event_date";
include "connectToDB.php";

// turn  dinner data to variables for eeasy access
$record = mysqli_fetch_array($sql_results);
$entree_name = $record['entree_name'];
$event_date = $record['event_date'];
$start_time = $record['start_time'];
$end_time = $record['end_time'];
$seats = $record['seats'];
$price = $record['price'];
$total_seats_reserved = $record['total_seats_reserved'];

echo "
  <div class=\"table-container\">
    <table class=\"table table-hover align-middle\">
      <tr>
        <th>Entrée&nbspType</th>
        <th>Date</th>
        <th>Seats</th>
        <th>
          Available&nbspSeats
        </th>
        <th>Total&nbspReserved</th>
      </tr>
";

while ($record = mysqli_fetch_array($sql_results)) {
  // formats the SQL data start/end time into hh:mm AM/PM
  include "sqlDataParser.php";

  // will determine what is placed in the Available Seats td. based on the sqlDataParser logic
  $tdAvailableSeats = $availabilityCount;
  if (!$waitlisted) {
    $tdAvailableSeats = "Available:&nbsp$availabilityCount<br/>
    Waitlist:&nbsp$waitlistReservedSeats";
  }

  // creates the table rows with data from the query
  echo "
		<tr href=\"#\">
    <td>
      <a href=\"admin-editOneDinner.php?dinner_id=$record[0]\" 
        class=\"buttonLinksTables tableSelect\">
        $record[1]
      </a>
    </td>
    <td>
      <strong>$event_dateFormatted</strong><br />
      $startTime-<br />
      $endTime
    </td>
    <td>$seats</td>
    <td $inlineStyleAvailabiltyColor style=\"width:10rem\">
      $tdAvailableSeats
    </td>
    <td>$totalReserved</td>
    </tr>
		</tr>
	";
}

echo "
      </table>
    </div>
    <br /><br />
    <a href=\"admin-dashboard.php\" class=\"buttonLinksTables\" >Dashboard</a>
  ";
echo "</div> <br /><br /><br />";

include "../footer.php";
?>