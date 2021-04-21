<?php
// purpose: Move a reservation to a different dinner event. shows the list of reservations available to move the 
// current reservation into

include "fileLinks.php";
include "../header.php";
include "helperFunctions.php";

include "account.php";
//simulates signed in
$signedin = true;

include "../nav.php";

$reservation_index = $_GET['reservation_index'];
$dinner_id = $_GET['dinner_id'];

$sql = "SELECT *    
        FROM dinners
        WHERE dinner_id = $dinner_id";
include "connectToDB.php";

$record = mysqli_fetch_array($sql_results);
$entree_name1 = $record['entree_name'];
// function from "helperFunctions.php". parses the date to mm/dd/yyyy from yyyy/mm/dd
$event_date1 = dateSQLtoRead($record['event_date']);
$price1 = $record['price'];
$start_time1 = date_format(date_create($record['start_time']), "h:i A");
$end_time1 = date_format(date_create($record['end_time']), "h:i A");
$seats1 = $record['seats'];
$total_seats_reserved1 = $record['total_seats_reserved'];
$waitlist_total_reserved1 = $record['waitlist_total_reserved'];

// i'm getting the dinner_id from the url parameter.
$sql = "SELECT * FROM customers
        WHERE reservation_index = $reservation_index";
include "connectToDB.php";

$record = mysqli_fetch_array($sql_results);
$first_name = $record['first_name'];
$last_name = $record['last_name'];
$phone_number = $record['phone_number'];
$email = $record['email'];
$seats_reserved = $record['seats_reserved'];
$reservation_total = $record['reservation_total'];
$confirmation_code = $record['confirmation_code'];

$reservation_info = $dinner_id . "|" . $confirmation_code . "|" . $seats_reserved . "|" . $first_name
  . "|" . $last_name . "|" . $email . "|" . $entree_name1 . "|" . $event_date1;

echo "
  <div class=\"container\">
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <h1>
      Admin Move Reservation 
    </h1>
    <br />
    <br />
";



// START of reservation data card
echo "   
    <div>
      <div class=\"info-card2\" style=\"border-radius: 12px 12px 0px 0px; justify-content: center;\">
        <div><p><strong>Dinner Info:</strong></p></div>
      </div>
      <div class=\"info-card2\">
        <div><p>Entrée:</p></div>
        <div>$entree_name1</div>
      </div>
      <div class=\"info-card2\">
        <div><p>Event Date:</p></div>
        <div>$event_date1</div>
      </div>

      <div class=\"info-card\" style=\"border-radius:0px 0px 12px 12px\">
        <strong><p style=\"display:block; text-align:center\">Customer Info:</p></strong><br />
        <p>First Name: <span>$first_name</span></p>
        <hr />
        <p>Last Name: <span>$last_name</span></p>
        <hr />
        <p>Seats Reserved: <span>$seats_reserved</span></p>
        <hr />
        <p>Email: <br />$email</p>
        <hr />
        <p>Confirmation Code: <br />$confirmation_code</p>
      </div>
    </div>
          ";
// END of resrvation data card

// queries record count of total dinner records that have a sufficient amount of seats available
// in regards to current customer reservation seats reserved amount. Will not include the current dinner.
$sql = "SELECT COUNT(`dinner_id`)
        FROM `dinners`
        WHERE  (`seats` - `total_seats_reserved`) >= '$seats_reserved' AND `dinner_id` <> '$dinner_id' ";
include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);
$dinnerstRecordCount = $record[0];

// This query will look for any reservations that have openings to the amount of seats reserved for the current reservation.
// It looks through the dinners and if seat capacity minus total_seats_reserved is greater than the amount of seats reserved
// by the rservation than only show the dinners that will be able to fit that reservation.
// for example. Curr resrvation has 3 seats reserved. Look through the dinners table and find any with at least availability for 
// 3 seats.
$sql = "SELECT *   
        FROM `dinners`
        WHERE (`seats` - `total_seats_reserved`) >= '$seats_reserved'
        ORDER BY event_date";
include "connectToDB.php";


//START of available dinners table
echo "
  <hr class=\"HRstyle\"/>

  <form name=\"changeDinnerEvent\" 
  action=\"admin-moveOneReservationProcess.php?dinner_id=$dinner_id\"
  method=\"POST\"  class=\"moveReservationTable formTable\">
  <div class=\"table-caption\" >
  <p style=\"text-align: center;\">
    <strong>
      Select A Dinner To Move<br />
    </strong>
    Dinners with at least $seats_reserved seats available<br />
    Records Found: $dinnerstRecordCount
  </p>

</div>
  <div class=\"table-container\">
    <table class=\"table table-hover align-middle\">
      <tr>
        <th>Select</th>
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

// the function can be found in helperFunctions.php It parses data and creates a styled <td> with the data inputted
$tdValue = inlineTableColor($seats1, $total_seats_reserved1, $waitlist_total_reserved1);
echo "
  <tr>
  <td><strong>Current</strong></td>
  <td>$entree_name1</td>
  <td>
    <strong>$event_date1</strong><br />
    $start_time1-<br />
    $end_time1
  </td>
  <td>$$price1</td>
  <td>$seats1</td>
  $tdValue
  <td>$total_seats_reserved1</td>
";

while ($record = mysqli_fetch_array($sql_results)) {
  include "sqlDataParser.php";
  // will determine what is placed in the Available Seats td. based on the sqlDataParser logic
  $tdAvailableSeats = $availabilityCount;
  if (!$waitlisted) {
    $tdAvailableSeats = "Available:&nbsp$availabilityCount<br/>
    Waitlist:&nbsp$waitlistReservedSeats";
  }

  if ($record[0] != $dinner_id) {
    echo "
      <tr>
        <td>
          <input type=\"radio\" id=\"$record[0]\" name=\"dinner_change_id\" value=\"$record[0]\" required>
        </td>
        <td>$record[1]</td>
        <td>
          <strong>$event_dateFormatted</strong><br />
          $startTime-<br />
          $endTime
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
}

echo "
      </table>
    </div>
    
    <input type=\"text\" 
    name=\"reservation_info\"	
    id=\"reservation_info\" 
    value=\"$reservation_info\" style=\"visibility:hidden;\"required/>

    <div style=\"text-align:center;\">
      <input type=\"submit\" class=\"buttonLinksTables\"
      name=\"submit\"	
      value=\"Submit\"/>	
    </div>
    <br />
  </form>
  ";
//END available dinner table

echo "
  <br /><br />
  <div style=\"text-align:center; display:flex; 
    justify-content:space-evenly; margin-right:1rem; 
    margin-left:1rem;\"  class=\"btnGroupMoveReservation\">

    <a href=\"admin-MoveReservationList.php?dinner_id=$dinner_id\" 
      class=\"buttonLinksTables\" >Back To List
    </a>
    <a href=\"admin-dashboard.php\" class=\"buttonLinksTables\">Dashboard</a>
  </div>
  <br /><br /><br />
</div>";

include "../footer.php";
?>