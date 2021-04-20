<?php
//Purpose: Shows the list of reservations. Click on one of the resrvations to move it to a different dinner event

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

// queries record count of total waitlist records.
$sql = "SELECT COUNT(`waitlist_id`)
        FROM waitlist
        WHERE  `dinner_id` = '$dinner_id'";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);
$waitlistRecordCount = $record[0];

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
  Admin Move:<br />
  Reservation and Waitlist
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

// This block will display the filter seection if waitlist data is available. if waitlist count is not 0 then
// show the filter tables section. If waitlist then the SHOW filter will be active with the sectionFilterActive class
if ($waitlistRecordCount == 0) {
  echo "";
}
else {
  echo "
    <hr class=\"HRstyle\"/>
    <div class=\"buttonGroupFiltersContainer\" style=\"margin-top:1rem; color:#005a87\">
      <div class=\"buttonGroupFilters\">
        <button onclick=\"toggleAll()\" class=\"buttonLinks3 sectionFilterActive btnAll\">All</button> 
        <button onclick=\"toggleReservationSection()\" class=\"buttonLinks3 btnReservations\" style=\"\">
          Reservations
        </button>
        <button onclick=\"toggleWaitlistSection()\" class=\"buttonLinks3 btnWaitlist\">Waitlist</button>  
      </div>
    </div>";
}

// RESRVATIONS SECTION ---------------------------------------------------------------------
echo "
  <div class=\"reservations-section\" style=\"text-align:center\">
    <div class=\"table-caption\">
      <h5 style=\"margin-top:0px;\">
        <strong>Select A Reservation To Move</strong><br />
      </h5>
        <p>Reservations Found: $recordCount</p>
    </div>
  ";
?>

<?php
echo "
<div class=\"table-container\">
  <table class=\"table table-hover align-middle\">
    <tr>
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
          <a href=\"admin-moveOneReservation.php?reservation_index=$record[7]&dinner_id=$dinner_id\" 
            class=\"buttonLinksTables tableSelect\">
            $record[3], $record[2]
          </a>
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
  </div>
    ";

// WAITLIST SECTION STARTS HERE ---------------------------------------------------------
if ($waitlistRecordCount == 0) {
  echo "";
}
else {
  //queries the waitlist table data
  $sql = "SELECT * FROM `waitlist`
          WHERE  `dinner_id` = '$dinner_id'
          ORDER BY `last_name`";
  include "connectToDB.php";
  echo "
    <div class=\"waitlist-section\" style=\"text-align:center\">
      <div class=\"table-caption\">
        <h5 style=\"margin-top:0px;\">
          <strong>Select A Waitlist To Move</strong><br />
        </h5>
        <p>Waitlists Found: $waitlistRecordCount</p>
      </div>
      <div class=\"table-container\">
        <table class=\"table table-hover align-middle\">
          <tr>
            <th>Name</th>
            <th>
              Email
            </th>
            <th>
              Phone&nbspNumber
            </th>
            <th>Seats&nbspReserved</th>  
          </tr>
  ";

  // loops through the waitlist. makes table data for waitlist  
  while ($record = mysqli_fetch_array($sql_results)) {
    echo "
      <tr>
        <td>
          <a href=\"admin-cancelOneWaitlist.php?waitlist_id=$record[1]&dinner_id=$dinner_id\"
            class=\"buttonLinksTables tableSelect\">
            $record[4], $record[3]
          </a>
        </td>
        <td>$record[2]</td>
        <td>$record[5]</td>
        <td>$record[6]</td>
      </tr>
    ";
  }
  echo "
        </table>
      </div>
      <br />
    </div>
      ";
}

echo "
      <br />
      <div class=\"buttonGroupContainer\">
        <div class=\"buttonGroup\">
          <a href=\"admin-dashboard.php\" class=\"buttonLinksTables dashboard-btns\">Dashboard</a>
          <a href=\"admin-moveReservation.php\" class=\"buttonLinksTables dashboard-btns\">Back To List</a>    
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

  function toggleDataFunction() {
    // var x = document.querySelectorAll('.confirmationRow');
    // var k = document.querySelectorAll('.emailRow');

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

  function toggleReservationSection() {
      //changes the backgorund color to green to look active. smae pattern below
      document.querySelector(".btnWaitlist").classList.remove("sectionFilterActive");
      document.querySelector(".btnAll").classList.remove("sectionFilterActive");
      document.querySelector(".btnReservations").classList.add("sectionFilterActive");

      document.querySelector(".reservations-section").classList.add("showSection");
      document.querySelector(".waitlist-section").classList.add("hideSection");
      document.querySelector(".waitlist-section").classList.remove("showSection");
      document.querySelector(".waitlist-section").classList.remove("showSection");
  }

  function toggleWaitlistSection() {
      document.querySelector(".btnReservations").classList.remove("sectionFilterActive");
      document.querySelector(".btnAll").classList.remove("sectionFilterActive");
      document.querySelector(".btnWaitlist").classList.add("sectionFilterActive");

      document.querySelector(".waitlist-section").classList.remove("hideSection");
      document.querySelector(".waitlist-section").classList.add("showSection");
      document.querySelector(".reservations-section").classList.add("hideSection");
      document.querySelector(".reservations-section").classList.remove("showSection");
  }

  function toggleAll() {
    document.querySelector(".btnReservations").classList.remove("sectionFilterActive");
    document.querySelector(".btnWaitlist").classList.remove("sectionFilterActive");
    document.querySelector(".btnAll").classList.add("sectionFilterActive");

    document.querySelector(".reservations-section").classList.remove("hideSection");
    document.querySelector(".reservations-section").classList.add("showSection");
    document.querySelector(".waitlist-section").classList.remove("hideSection");
    document.querySelector(".waitlist-section").classList.add("showSection");
  }
</script>