<?php
include "fileLinks.php";
include "account.php";
include "../header.php";
//simulates signed in
$signedin = true;

include "../nav.php";

$stopMonth = 13;
include "../dateGenerator.php";

$dinner_id = $_GET['dinner_id'];
$recordCount = 0;

$sql = "SELECT * FROM dinners
        WHERE dinner_id = $dinner_id";
include "connectToDB.php";

$record = mysqli_fetch_array($sql_results);
$entree_name = $record['entree_name'];
$event_date = $record['event_date'];
$start_time = $record['start_time'];
$end_time = $record['end_time'];
$seats = $record['seats'];
$price = $record['price'];
$total_seats_reserved = $record['total_seats_reserved'];

include "sqlDataParser.php";


// gets record count of total reservation records. non waitlist
$sql = "SELECT COUNT(`dinner_id`)
        FROM customers
        WHERE  `dinner_id` = '$dinner_id'";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);

$recordCount = $record[0];

// gets all customer data with specified meal id in ordered form based on last name
$sql = "SELECT * FROM `customers`
        WHERE  `dinner_id` = '$dinner_id'
        ORDER BY `last_name`";
include "connectToDB.php";

// while ($test = mysqli_fetch_array($sql_results)) {
//   $recordCount++;
// }

echo "
<div class=\"container\">
  <br /><br /><br /><br /><br /><br />
  <h1>
  Admin Cancel Reservation:<br/>
  Reservation List
  </h1>
  <br />
  <hr class=\"HRstyle\"/>
  <p><strong>Current Dinner Data</strong></p>
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
      <th>
        Total<br />
        Reserved
      </th>
    </tr>
";


echo "
    <tr>
      <td><strong>$event_dateFormatted</strong><br />
          $startTime-<br />
          $endTime
      </td>
      <td>$entree_name</td>
      <td $inlineStyleAvailabiltyColor>$availabilityCount</td>
      <td >$total_seats_reserved</td>
    </tr>
  </table>
  <br/>
  <hr class=\"HRstyle\"/>
  <br />
  <p><strong>Select a reservation from the list to cancel</strong></p>
  <p><strong>Records Found: $recordCount</strong></p>
  <br />
  ";
?>



<script>
// this whole block is a toggle for the confirmation/email in the table. slims down the table
let toggleData = true;

function toggleDataFunction() {
  var x = document.querySelectorAll('.confirmationRow');
  var k = document.querySelectorAll('.emailRow');

  var emailRow = document.querySelectorAll('.emailRow');
  var confirmationRow= document.querySelectorAll('.confirmationRow');

  toggleData = !toggleData

  if (toggleData) {
    for (i = 0; i < emailRow.length; i++) {
      confirmationRow[i].style.display = "block";
      emailRow[i].style.display = "none";
    };
  } else {
    for (i = 0; i < confirmationRow.length; i++) {
      confirmationRow[i].style.display = "none";
      emailRow[i].style.display = "block";
    };
  }
};
</script>

<?php
echo "
    <table>
    <tr>

      <th>
        <span onclick=\"toggleDataFunction()\"\" style=\"cursor: pointer;\">Confirmation/Email <i class=\"far fa-caret-square-down\"></i></span>
      </th>
      <th>Seats<br/>Reserved</th>
      <th>Name</th>
    </tr>
  ";

// query for event dates in ordered form (ascending)
while ($record = mysqli_fetch_array($sql_results)) {
  echo "
      <tr>
        <td><span class=\"emailRow\" style=\"display:none\">$record[5]</span><span class=\"confirmationRow\">$record[8]</span></td>
        <td>$record[10]</td>
        <td>
          <a href=\"admin-cancelOneReservation.php?reservation_index=$record[7]&dinner_id=$dinner_id\" class=\"buttonLinks3 tableSelect\">
            $record[3], $record[2]
          </a>
        </td>
      </tr>
    ";
}

echo "
      </table>
    ";

// WAITLIST TABLE STARTS HERE
// gets record count of total waitlist records.
$sql = "SELECT COUNT(`waitlist_id`)
        FROM waitlist
        WHERE  `dinner_id` = '$dinner_id'";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);

$recordCount = $record[0];

$sql = "SELECT * FROM `waitlist`
          WHERE  `dinner_id` = '$dinner_id'
          ORDER BY `last_name`";
include "connectToDB.php";

echo "
    <br /><br /><br /><br /><br /><br />
    <h1>
    Admin Cancel Reservation:<br/>
    Waitlist List
    </h1>
    <br />
    <hr class=\"HRstyle\"/>
    <p><strong>Records Found: $recordCount</strong></p>
  
    <table>
    <tr>
      <th>
        Email
      </th>
      <th>Seats<br/>Reserved</th>
      <th>Name</th>
    </tr>
  ";

// query for event dates in ordered form (ascending)
while ($record = mysqli_fetch_array($sql_results)) {
  echo "
      <tr>
        <td>$record[2]</td>
        <td>$record[6]</td>
        <td>
          <a href=\"admin-cancelOneWaitlist.php?waitlist_id=$record[1]&dinner_id=$dinner_id\" class=\"buttonLinks3 tableSelect\">
            $record[4], $record[3]
          </a>
        </td>
      </tr>
    ";
}

echo "
      </table>
    ";

echo "
      </table><br /><br />

      <div class=\"buttonGroupContainer\">
        <div class=\"buttonGroup\">
          <a href=\"admin-dashboard.php\" class=\"buttonLinks3 dashboard-btns\">Dashboard</a>
          <a href=\"admin-cancelReservation.php\" class=\"buttonLinks3 dashboard-btns\">Back To List</a>    
        </div>
        </div>

    <br /><br /><br />
  </div>
  ";
//    <a href=\"admin-dashboard.php\" class=\"buttonLinks3\">Dashboard</a>
include "../footer.php";
?>