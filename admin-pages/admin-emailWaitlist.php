<?php
// purpose: cancel one reservation. data will be sent to admin-cancelOneResrvationProcess

include "fileLinks.php";
include "../header.php";
include "helperFunctions.php";

include "account.php";
//simulates signed in
$signedin = true;

$dinner_id = $_GET['dinner_id'];

// WAITLIST TABLE STARTS HERE
// gets record count of total waitlist records.
$sql = "SELECT COUNT(`waitlist_id`)
        FROM waitlist
        WHERE  `dinner_id` = '$dinner_id'";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);
$recordCount = $record[0];

include "../nav.php";
echo " <div class=\"container\">
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <h1>
  Admin Email Waitlist:<br/>
  Select Recipients
  </h1>
  <br />
  <hr class=\"HRstyle\"/>
  <p><strong>Current Dinner Data</strong></p>
  <table>
    <tr>
      <th>
      Entrée
      </th>
      <th>Seat<br/>Capacity</th>
      <th>Reserved<br/>Seats</th>
      <th>Available<br/>Seats</th>
    </tr>
 ";

// dinners table data
$sql = "SELECT entree_name, event_date, start_time, end_time, seats, total_seats_reserved
        FROM dinners
        WHERE dinner_id = '$dinner_id'";
include "connectToDB.php";
$dinnerInfo = mysqli_fetch_array($sql_results);
$dinnerInfoArrToStr = implode("|", $dinnerInfo);

$availableSeats = $dinnerInfo['seats'] - $dinnerInfo['total_seats_reserved'];

echo "
    <tr>
      <td>$dinnerInfo[entree_name]</td>
      <td>$dinnerInfo[seats]</td>
      <td>
      $dinnerInfo[total_seats_reserved]
      </td>
      <td style=\"background-color: rgb(148, 226, 148)\">$availableSeats</td>
  </table>
  <br />
  <hr class=\"HRstyle\"/>
  <p><strong>Waitlist Records Found: $recordCount</strong></p>
  <form name=\"addDinner\" 
  action=\"admin-emailHub.php\"
  method=\"POST\">
 <table>
  <tr>
    <th>
    Email
    </th>
    <th>Seats<br/>Reserved</th>
    <th>Name</th>
    <th><span onclick=\"checkAll()\" style=\"cursor: pointer;\">Toggle <i class=\"far fa-check-square\"></i></span></th>
  </tr>
 ";


// Waitlist table data
$sql = "SELECT * FROM `waitlist`
 WHERE  `dinner_id` = '$dinner_id'
 ORDER BY `seats_reserved`";
include "connectToDB.php";

while ($record = mysqli_fetch_array($sql_results)) {
  echo "
    <tr>
    <td>$record[2]</td>
    <td>$record[6]</td>
    <td>
    $record[4], $record[3]
    </td>
    <td><input type=\"checkbox\" id=\"$record[1]\" name=\"waitlist_emails\" value=\"$record[2]\" checked></td>
    </tr>
    ";
}
echo "
  </table><br />
  <input type=\"text\" id=\"dinnerInfoArrToStr\" name=\"dinnerInfoArrToStr\" value=\"$dinnerInfoArrToStr\" style=\"visibility:hidden;\">
  ";
?>
      
<script>
// this whole block is a toggle for the checkboxes. Toggles between checked and unchecked
let toggleData = true;

function checkAll() {
  toggleData = !toggleData;
  var inputs = document.getElementsByTagName('input');

  if (toggleData) {
    for(var i = 0; i < inputs.length; i++) {
      inputs[i].checked = true;
    }
  } else {
    for(var i = 0; i < inputs.length; i++) {
      inputs[i].checked = false;
    }
  }
};
</script>

<?PHP
echo "
    <div style=\"text-align:center;\">
      <input type=\"submit\" class=\"buttonLinks3\"
      name=\"submit\"	
      value=\"Send Emails\"/>	
    </div>
    </form>
      <br />
      <div class=\"buttonGroupContainer\">
        <div class=\"buttonGroup\">
          <a href=\"admin-dashboard.php\" class=\"buttonLinks3 dashboard-btns\">Dashboard</a>
          <a href=\"admin-cancelReservationList.php?dinner_id=$dinner_id\" class=\"buttonLinks3 dashboard-btns\">Back To List</a>    
        </div>
        </div>

    <br /><br /><br />
  </div>
  ";

include "../footer.php";
?>