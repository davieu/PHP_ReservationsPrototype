<?php
// Purpose: show a list of reservations/waitlist for a specific dinner event. click checkboxes to email confirmation.

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

// queries the current dinner data
$sql = "SELECT * FROM dinners
        WHERE dinner_id = $dinner_id";
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

// parses dates
include "sqlDataParser.php";

// queries record count of total reservation records. non waitlist
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


// DINNER DATA/INFO SECTION STARTS HERE -----------------------------------------------------------
echo "
<div class=\"container\">
  <br /><br /><br /><br /><br /><br />
  <h1>
  Admin Email:<br />Confirmation Code
  </h1>
  <br />
  <br />
    <p>
      <strong>Current Dinner Data:</strong><br />
    </p>  
  ";

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

// will determine what is placed in the Available Seats td. based on the sqlDataParser logic
$tdAvailableSeats = $availabilityCount;
if (!$waitlisted) {
  $tdAvailableSeats = "Available:&nbsp$availabilityCount<br/>
  Waitlist:&nbsp$waitlistReservedSeats";
}

// Table for the current dinner. Has info pertaining to the current dinner
echo "
      <tr>
			<td>$entree_name</td>
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
    </table>
  </div>
";

// RESRVATIONS SECTION ---------------------------------------------------------------------
// hides reservation list if no records
if ($recordCount == 0) {
  echo "";
}
else {
  echo "
    <div class=\"reservations-section\" style=\"text-align:center\">

      <form name=\"emailConfirmationCode\" 
        action=\"admin-emailConfirmationProcess.php?dinner_id=$dinner_id\"
        method=\"POST\" class=\"moveReservationTable formTable\">

        <div class=\"table-caption\">
          <h5 style=\"margin-top:0px;\">
            <strong>Select Customers To Email</strong><br />
          </h5>
            <p>Reservations Found: $recordCount</p>
        </div>
  ";

  echo "
    <div class=\"table-container\">
      <table class=\"table table-hover align-middle\">
        <tr>
          <th>
            <span onclick=\"checkAll()\" style=\"cursor: pointer;\">
              Toggle&nbsp<i class=\"far fa-check-square\" style=\"display:inline\"></i>
            </span>
          </th>
          <th>Name</th>
          <th style=\"min-width:11rem;\">
            <span onclick=\"toggleDataFunction()\" style=\"cursor: pointer;\">
              Confirmation/Email&nbsp<i class=\"far fa-caret-square-down\"></i>
            </span>
          </th>
          <th>Phone&nbspNumber</th>
          <th>Seats&nbspReserved</th>
        </tr>
    ";

  // makes the table data for the reservations
  while ($record = mysqli_fetch_array($sql_results)) {
    echo "
      <tr>
        <td>
          <input type=\"checkbox\" id=\"$record[1]\" 
              name=\"emailConfirmation[]\" 
              value=\"$record[email]|$record[confirmation_code]|$record[first_name]|$record[last_name]|$entree_name\" 
              oninvalid=\"this.setCustomValidity('Please mark a recipient to email, or go to dashboard.')\" 
              onchange=\"this.setCustomValidity('')\">
        </td>
        <td>
          $record[3], $record[2]
        </td>
        <td>
          <span class=\"emailRow\" style=\"display:none\">
            $record[5]</span><span class=\"confirmationRow\">
            $record[8]
          </span>
        </td>
        <td>$record[4]</td>
        <td>$record[10]</td>
      </tr>
    ";
  }

  echo "
        </table>
      </div>
      <br />
      
      <div style=\"text-align:center;\">
        <input type=\"submit\" class=\"buttonLinksTables\"
        name=\"submit\"	
        value=\"Submit\"/>	
      </div>
    </form>
  </div>
  ";
}




// show an add reservation if no record count for rservations and waitlist is empty
if ($recordCount == 0 && $waitlistRecordCount == 0) {
  echo "
    <div class=\"reservations-section\" style=\"text-align:center\">
      <div class=\"table-caption\">
        <h5 style=\"margin-top:0px;\">
          <strong>No Reservations Yet</strong><br />
        </h5>
          <p>Reservations Found: $recordCount</p>   
      </div>
      <div class=\"table-container\">
        <table class=\"table table-hover align-middle\">      
          <div class=\"buttonGroupContainer\">
            <div class=\"buttonGroup\" 
              style=\"justify-content:center; background-color: rgb(238, 238, 238); 
              padding: 3rem 1rem; border-radius: 0px 0px 20px 20px\">
                <a href=\"admin-addReservationUserInfo.php?dinner_id=$dinner_id\" 
                class=\"buttonLinksTables dashboard-btns\">
                  Add Reservation
                </a>
            </div>
          </div>
        </table>
      </div>
    </div>
  ";
}

echo "
      <br />
      <div class=\"buttonGroupContainer\">
        <div class=\"buttonGroup\">
          <a href=\"admin-dashboard.php\" class=\"buttonLinksTables dashboard-btns\">Dashboard</a>
          <a href=\"admin-emailConfirmation.php\" class=\"buttonLinksTables dashboard-btns\">Back To List</a>    
        </div>
        </div>

    <br /><br /><br />
  </div>
  ";
//    <a href=\"admin-dashboard.php\" class=\"buttonLinks3\">Dashboard</a>
include "../footer.php";
?>

<script>
  // this whole block is a toggle for the confirmation/email in the table. slims down the table
  let toggleData = true;
  let toggleCheckbox = false;

  function toggleDataFunction() {

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

// this whole block is a toggle for the checkboxes. Toggles between checked and unchecked


function checkAll() {
  toggleCheckbox = !toggleCheckbox;
  var inputs = document.getElementsByTagName('input');

  if (toggleCheckbox) {
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