<?php
// purpose: cancel one reservation. data will be sent to admin-cancelOneResrvationProcess

include "fileLinks.php";
include "../header.php";
include "helperFunctions.php";

include "account.php";
//simulates signed in
$signedin = true;

include "../nav.php";

$reservation_index = $_GET['reservation_index'];
$dinner_id = $_GET['dinner_id'];

$sql = "SELECT dinners.entree_name, dinners.event_date    
        FROM dinners
        WHERE dinner_id = $dinner_id";
include "connectToDB.php";

$record = mysqli_fetch_array($sql_results);
$entree_name = $record['entree_name'];
// function from "helperFunctions.php". parses the date to mm/dd/yyyy from yyyy/mm/dd
$event_date = dateSQLtoRead($record['event_date']);

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
  . "|" . $last_name . "|" . $email;

echo "
<div class=\"container\">
<br />
<br />
<br />
<br />
<br />
<br />
    <h1>
      Admin Cancel Reservation 
		</h1>
    <br />
    <br />

		<form name=\"addDinner\" 
			 action=\"admin-cancelOneReservationProcess.php\"
			 method=\"POST\">
        ";

echo "   
      <div class=\"info-card2\" style=\"border-radius: 10px 10px 0px 0px\">
        <div><p>Entrée:</p></div><div>$entree_name</div>
      </div>
      <div class=\"info-card2\" style=\"border-radius: 0px 0px 10px 10px\">
        <div><p>Event Date:</p></div><div>$event_date</div>
      </div>
      <div class=\"info-card\">
        <p>First Name: <span>$first_name</span></p>
        <hr />
        <p>Last Name: <span>$last_name</span></p>
        <hr />
        <p>Seats Reserved: <span>$seats_reserved</span></p>
        <hr />
        <p>Phone Number: <br />$phone_number</p>
        <hr />
        <p>email: <br />$email</p>
        <hr />
        <p>Confirmation Code: <br />$confirmation_code</p>
      </div>
      <input type=\"text\" 
      name=\"reservation_info\"	
      id=\"reservation_info\" class=\"inputText\" value=\"$reservation_info\" style=\"visibility:hidden;\"required/><br />
          ";

echo "
        <hr /><br />
        <div style=\"text-align:center; display:flex; justify-content:space-between\">
          <a href=\"admin-cancelReservationList.php?dinner_id=$dinner_id\" class=\"buttonLinks3\" >Back To List</a>
          <a href=\"admin-dashboard.php\" class=\"buttonLinks3\" >Dashboard</a>
          </div>
          <div style=\"text-align:right; margin-top:1.5rem;\">
          
          <a href=\"#\" class=\"buttonLinksWarning\" style=\"align-content:center;\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteDinnerModal\">Cancel Reservation</a>
          </div>

<div class=\"modal fade\" id=\"deleteDinnerModal\" tabindex=\"-1\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">
  <div class=\"modal-dialog\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h5 class=\"modal-title\" id=\"ModalLabel\">Are you sure?</h5>
        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
      </div>
      <div class=\"modal-body\">
        Are you sure you want to cancel <strong>$first_name $last_name's</strong> reservation that is scheduled for <strong>$event_date</strong> with <strong>$entree_name</strong> meal type?
      </div>
      <div class=\"modal-footer\">
        <a href=\"#\" class=\"buttonLinks3\" style=\"align-content:center;\" data-bs-dismiss=\"modal\">Close</a>
        <input type=\"submit\" class=\"buttonLinksWarning\"
        name=\"submit\"	
        value=\"Cancel Reservation\" style=\"align-content:center; margin-left:1rem;\"/>	
      </div>
    </div>
  </div>
</div>
		</form>
       <br /><br /><br />
</div>";

include "../footer.php";
?>