<?php
// --------FILENAME: admin-pages/admin-cancelReservation.php ---------

// Purpose: Shows the list of dinner events. Click on a dinner event to show reservations for that specific dinner

include "account.php";
include "loginCheckForSID.php";

include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;

include "../nav.php";

// $stopMonth = 13;
// include "../dateGenerator.php";

$today = date("Y-m-d");
// query for event dates in ordered form (ascending)
$sql = "SELECT * FROM dinners
        WHERE `event_date` >= '$today'
        ORDER BY event_date";
include "connectToDB.php";

echo "
<div class=\"container\">
  <br /><br /><br /><br /><br /><br />
  <h1>
  Admin Cancel Reservation:<br />
  Dinner List
  </h1>
  <br />
  <br />
  <p><strong>Select an Entrée to filter reservations</strong></p>
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

// query for event dates in ordered form (ascending)
while ($record = mysqli_fetch_array($sql_results)) {
  //$rec[0]=dinner_id, $rec[1]=entree_name, $rec[2]=event_date, $rec[3]=start_time, $rec[4]=end_time, $rec[5]=seats, $rec[6]=price 
  // parses data from the sql and also helps with the table "Available Seats" column coloring.
  // to understand the parsing and the variables below please view the "sqlDataParser.php" page
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
        <strong>
          <a href=\"admin-cancelReservationList.php?dinner_id=$record[0]\" 
          class=\"buttonLinksTables tableSelect\">$record[1]</a>
        <strong>
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
  <br /><br /><br />
</div>";

include "../footer.php";
?>