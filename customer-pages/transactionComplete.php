<?php
// --------FILENAME: customer-pages/transactionComplete.php ---------
//Purpose: This page gathers the form data to send to the admin-addResrvationProcess page.

include "account.php";

include "fileLinks.php";
include "../header.php";

$dinner_id = $_GET['dinner_id'];
$price_total = $_GET['price_total'];
$seats_reserved = $_GET['seats_reserved'];

//$currReservation = explode("|", $currData);

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

$selectSeatsAmount = 4;
$lowAvailableSeats = false;
$waitlistActive = false;
$buttonTipName = "";
$titleNAme = "";

// parses the dates into readable human form.
//$rec[0]=dinner_id, $rec[1]=entree_name, $rec[2]=event_date, $rec[3]=start_time, $rec[4]=end_time, $rec[5]=seats, $rec[6]=price 
// parses data from the sql and also helps with the table "Available Seats" column coloring.
// to understand the parsing and the variables below please view the "sqlDataParser.php" page
include "sqlDataParser.php";

// has data for the dinner and will be sent as a pipe delimited data. Mainly for usage in process/emailing
$dinner_info = $entree_name . "|" . $event_dateFormatted . "|" . $startTime . "|" . $endTime . "|" . $price . "|" . $total_seats_reserved . "|" . $seats;

// if current dinner is on waitlist
if ($availabilityCount <= 0) {
  $lowAvailableSeats = false;
  $waitlistActive = true;
  $selectSeatsAmount = 4;
  $buttonTipName = "Note: Waitlist <i class=\"fas fa-info-circle\"></i>";
  $titleNAme = "Add Waitlist Reservation";
}
// for current dinner on low availabilty. if 3 seats or less available
elseif ($availabilityCount <= 3) {
  $selectSeatsAmount = $availabilityCount;
  $lowAvailableSeats = true;
  $buttonTipName = "Note: Low Availability <i class=\"fas fa-info-circle\"></i>";
  $titleNAme = "Add Reservation";
}
else {
  $buttonTipName = "Note: Reservation <i class=\"fas fa-info-circle\"></i>";
  $titleNAme = "Add Reservation";
}

include "../nav.php";

echo "
  <div class=\"container\">
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
  <h1 style=\"text-align: center\">
    Thank You for Supporting The WCC Culinary Program
  </h1>
    <br />
    <br />

    <br />
    <p style=\"text-align:center;\"><strong>Dinner Info</strong></p>
    <br />
  ";

// will determine what is placed in the Available Seats td. based on the sqlDataParser logic
$tdAvailableSeats = $availabilityCount;
if (!$waitlisted) {
  $tdAvailableSeats = "Available:&nbsp$availabilityCount<br/>
      Waitlist:&nbsp$waitlistReservedSeats";
}

// START of current dinner Table
echo "  
    <div class=\"table-container\">
      <table class=\"table table-hover align-middle\">
        <tr>
          <th>Entrée&nbspType</th>
          <th>Date</th>
          <th>Price</th>
          <th>
            Available&nbspSeats
          </th>
          <th>Seats&nbspReserved</th>
          <th>Total</th>
        </tr>
        <tr>
          <td>$entree_name</td>
          <td>
            <strong>$event_dateFormatted</strong><br />
            $startTime-<br />
            $endTime
          </td>
          <td>$$price</td>
          <td $inlineStyleAvailabiltyColor style=\"width:10rem\">
            $tdAvailableSeats
          </td>
          <td>$seats_reserved</td>
          <td>$$price_total</td>
        </tr>
      </table>
    </div>
  ";
// END of current dinner table


// START of form
echo "
  <hr class=\"HRstyle\"/>
  <br />
  <div style=\"background-color:rgb(238, 238, 238); text-align: center; padding: 1rem; border-radius: 12px\">
    <h4>Seats Reserved: $seats_reserved</h4>
    <h4>Total Payed: $$price_total</h4>
        <p>
        If you have any questions or need to update
        your reservation(s) do not hesitate to call G. Ramsey - 334-222-1111<br/><br />
        Confirmation Code:<br />
        123:43j5j4k43033j3j
    </p>
          <div style=\"\">
        <a href=\"../index.php\" class=\"buttonLinksTables\">Home</a>
      </div>
  </div>
  ";


echo "
      <hr /> 
      <div 
      style=\"text-align:center; display:flex; 
        justify-content:space-between; 
        padding-right: 1rem; padding-left: 1rem;\">


      </div>

    <br /><br /><br/>
</div>";

include "../footer.php";
?>