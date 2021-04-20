<?php
// purpose: menu for displaying the list of waitlist for a specified dinner. Uses checkboxes to determine who on the wait;ist to email

include "fileLinks.php";
include "../header.php";
include "helperFunctions.php";

include "account.php";
//simulates signed in
$signedin = true;

$dinner_id = $_GET['dinner_id'];


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
  <div class=\"table-container\">
  ";

// TABLE for current dinner
echo "
    <table class=\"table table-hover align-middle\">
      <tr>
        <th>
        Entrée
        </th>
        <th>Available&nbspSeats</th>
        <th>Seat&nbspCapacity</th>
        <th>Reserved&nbspSeats</th>
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
$TDavailableSeatsStyle = "";
if ($availableSeats > 0) {
  $TDavailableSeatsStyle = 'style="background-color: rgb(148, 226, 148)"';
}
else {
  $TDavailableSeatsStyle = 'style="background-color: rgb(255, 244, 146)"';
}

echo "
      <tr>
        <td>$dinnerInfo[entree_name]</td>
        <td $TDavailableSeatsStyle>$availableSeats</td>
        <td>$dinnerInfo[seats]</td>
        <td>
        $dinnerInfo[total_seats_reserved]
        </td>
    </table>
  </div>
  <br />
  <hr class=\"HRstyle\"/>
  <p>
    <strong>Waitlist Records Found: $recordCount</strong>
  </p>
  <form name=\"emailRecipients\" 
    action=\"admin-emailWaitlistProcess.php?dinner_id=$dinner_id\"
    method=\"POST\"  class=\"emailWaitlistForm formTable\">
    <div class=\"table-container\" style=\"  margin: auto;\">
      <table class=\"table table-hover align-middle\">
        <tr>
          <th>
            <span onclick=\"checkAll()\" style=\"cursor: pointer;\">
              Toggle <i class=\"far fa-check-square\"></i>
            </span>
          </th>
          <th>
            Email
          </th>
          <th>Seats<br/>Reserved</th>
          <th>Name</th>
        </tr>
 ";


// Waitlist table data to email
$sql = "SELECT * FROM `waitlist`
 WHERE  `dinner_id` = '$dinner_id'
 ORDER BY `seats_reserved`";
include "connectToDB.php";

while ($record = mysqli_fetch_array($sql_results)) {
  echo "
    <tr>
      <td>
        <input type=\"checkbox\" id=\"$record[1]\" 
            name=\"waitlist_emails[]\" 
            value=\"$record[email]|$record[first_name]|$record[last_name]\" 
            oninvalid=\"this.setCustomValidity('Please mark a recipient to email, or go to dashboard.')\" 
            onchange=\"this.setCustomValidity('')\"
            checked>
      </td>
      <td>$record[2]</td>
      <td>$record[6]</td>
      <td>
      $record[4], $record[3]
      </td>
    </tr>
    ";
}
echo "
      </table>
    </div>
    <input type=\"text\" id=\"dinnerInfoArrToStr\"
     name=\"dinnerInfoArrToStr\" value=\"$dinnerInfoArrToStr\"
      style=\"visibility:hidden;\">
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
        <input type=\"submit\" class=\"buttonLinksTables\"
        name=\"submit\"	
        value=\"Send Emails\"/>	
      </div>
      <br />
    </form>
      <br />
      <div class=\"buttonGroupContainer\">
        <div class=\"buttonGroup\">
          <a href=\"admin-dashboard.php\" class=\"buttonLinksTables\">Dashboard</a>
          <a href=\"admin-cancelReservationList.php?dinner_id=$dinner_id\" class=\"buttonLinksTables\">Back To List</a>    
        </div>
      </div>
    <br /><br />
  </div>
  ";

include "../footer.php";
?>