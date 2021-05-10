<?php
// --------FILENAME: admin-pages/admin-editDinner.php ---------

//Purpose: This page shows a list of current reservations that when you click it will take you to the admin-editOneDinner.php
// shows list of dinners that ypu can edit.
include "account.php";
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

echo "
  <br />
  <h1>Admin Edit Dinner</h1>
  <br />
  <br />
  <p><strong>Select a meal to edit</strong></p>
";

$today = date("Y-m-d");
// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        WHERE `event_date` >= '$today'
        ORDER BY event_date";
include "connectToDB.php";

echo "
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
		<tr>
			<td>
        <a href=\"admin-editOneDinner.php?dinner_id=$record[0]\" 
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
    <br /><br />
    <a href=\"admin-dashboard.php\" class=\"buttonLinksTables\" >Dashboard</a>
  ";
echo "</div> <br /><br /><br />";

include "../footer.php";
?>