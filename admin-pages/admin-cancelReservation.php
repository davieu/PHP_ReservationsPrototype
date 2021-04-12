<?php
include "fileLinks.php";
include "account.php";
include "../header.php";
//simulates signed in
$signedin = true;

include "../nav.php";

$stopMonth = 13;
include "../dateGenerator.php";

$sql = "SELECT * FROM dinners
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
  <p><strong>Select a meal to filter the reservations</strong></p>

  <table>
  <tr>
    <th>Date</th>
    <th>
      Available<br />
      Seats
    </th>
    <th>
      Total<br />Reserved
    </th>
    <th>Entrée<br/>Type</th>
  </tr>
";

// query for event dates in ordered form (ascending)
while ($record = mysqli_fetch_array($sql_results)) {
  //$rec[0]=dinner_id, $rec[1]=entree_name, $rec[2]=event_date, $rec[3]=start_time, $rec[4]=end_time, $rec[5]=seats, $rec[6]=price 
  // parses data from the sql and also helps with the table "Available Seats" column coloring.
  // to understand the parsing and the variables below please view the "sqlDataParser.php" page
  include "sqlDataParser.php";
  echo "
		<tr>
			<td><strong>$event_dateFormatted</strong><br />
          $startTime-<br />
          $endTime</td>
			<td $inlineStyleAvailabiltyColor>$availabilityCount</td>
      <td>$SUM_waitlistAndReserved</td>
      <td><a href=\"admin-cancelReservationList.php?dinner_id=$record[0]\" class=\"buttonLinks3 tableSelect\">$record[1]</a></td>
		</tr>
	";
}

echo "
    </table>
  ";

echo "
    </table><br /><br />
    <a href=\"admin-dashboard.php\" class=\"buttonLinks3\" >Dashboard</a>
  <br /><br /><br />
</div>";

include "../footer.php";
?>