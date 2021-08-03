<?php
// --------FILENAME: customer-pages/customerBill.php ---------
//Purpose: This page gathers the form data to send to the admin-addResrvationProcess page.

include "account.php";

include "fileLinks.php";
include "../header.php";

$dinner_id = $_GET['dinner_id'];
$seats_reserved = $_POST['seats_reserved'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];


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
$dinner_info = $event_dateFormatted . "|" . $startTime . "|" . $endTime . "|" . $price . "|" . $total_seats_reserved . "|" . $seats;

$customer_info = $seats_reserved . "|" . $first_name . "|" . $last_name . "|" . $phone_number . "|" . $email;

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
    <h1>
      Customer Transaction
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

$price_total = $price * $seats_reserved;

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
  <p><strong>Card Information</strong></p>
  $dinner_id $first_name $last_name $phone_number $email $seats_reserved
  <br />
  <form style=\"\" name=\"addDinner\" 
    class=\"formUserInfo\"
    action=\"transactionComplete.php?dinner_id=$dinner_id&seats_reserved=$seats_reserved&price_total=$price_total\"
    method=\"POST\">

      <input type=\"text\" 
      name=\"dinner_info\"	
      id=\"dinner_info\" style=\"display:none;\" value=\"$dinner_info\"/>

      <div style=\"margin-bottom:1rem;\">
        Card Number:
        <input type=\"text\" 
          name=\"card_number\"	
          id=\"card_number\" class=\"inputText\" value=\"4242 4242 4242 4242\" disabled required/>
          <input type=\"text\" 
              name=\"previous_data\"	
              id=\"previous_data\" class=\"\" value=\"Entree:hjhj|event_date:hjhj|start:ghjj|end:ghjgj|seats:ghjgj|price:ggg\" style=\"visibility:hidden;\"required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        Expiration Date:
        <input type=\"text\" 
          expiration_date=\"last_name\"	
          id=\"expiration_date\" class=\"inputText\" value=\"04/25\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        CVV:
        <input type=\"text\" 
          name=\"cvv\"	
          id=\"cvv\" class=\"inputText\" value=\"333\" required/>
      </div>
      <br />
      <div style=\"\">
        <span>Price Per Seat: $$price</span>
      </div>
      <div style=\"\">
        <span>Seats Reserved: $seats_reserved</span>
      </div>
      <div style=\"\">
        <span>Transaction Total: $$price_total</span>
      </div>
  ";


echo "
      <hr /> 
      <br />
      <div 
      style=\"text-align:center; display:flex; 
        justify-content:center; 
        padding-right: 1rem; padding-left: 1rem\">

        <input type=\"submit\" class=\"buttonLinksTables\"
        name=\"submit\"	
        value=\"Pay Amount\" />	
      </div>
      <br />
      <div 
      style=\"text-align:center; display:flex; 
        justify-content:space-between; 
        padding-right: 1rem; padding-left: 1rem\">

        <a href=\"userInfo.php?dinner_id=$dinner_id\" class=\"buttonLinksTables\">Back</a>
        <input type=\"reset\" class=\"buttonLinksTables\"
        name=\"reset\"	
        value=\"Clear\"/>
        <a href=\"../index.php\" class=\"buttonLinksTables\">Home</a>
      </div>
      <div style=\"text-align:right; margin-top:1.5rem; padding-right: 1rem\">

      </div>
		</form>
    <br /><br /><br/>
</div>";

include "../footer.php";
?>