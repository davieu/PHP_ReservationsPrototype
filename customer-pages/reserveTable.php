<?php
//Purpose: Dashoboard for the admin. It is a portal to go to other admin actions like edit/add/delete data
// has an overview table

/* include "admin-nav.php"; include "admin-dashboardHTML.html"; include "../footer.php"; */

include "fileLinks.php";

include "../header.php";
//simulates signed in
$signedin = false;
include "../nav.php";
echo
  "<div class=\"container\">
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <h1 style=\"text-align: center\">Reserve A Table</h1>
    <br />
    <br />
    <br />
";

// table
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
      Current Dinner Events</strong><br/>
      Choose a dinner to make a reservation!<br/>
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
        <a href=\"userInfo.php?dinner_id=$record[0]\" 
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
      <br />
        <div style=\"text-align:center; margin-top:1.5rem;\">
            <a href=\"../index.php\" class=\"buttonLinksTables\">Home</a>
        </div>
    </div>

  ";
echo "
    <br />
    <br />
    <br />
    <br />
  </div>";

include "../footer.php";
?>