<?php
// Purpose: Fill out form to add a new dinner event

include "account.php";
include "loginCheckForSID.php";

include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;

$sql = "SELECT * FROM logging
        ORDER BY `timestamp`";
//2012-02-13 12:34:08 (096) glide.quota.manager SYSTEM URL= /incident_list.do? 
//sysparm_userpref_module=b55fbec4c0a800090088e83d7ff500de&active=true&sysparm_query=active=true^EQ,

include "connectToDB.php";

include "../nav.php";

// generates the dates in the select menu
echo "
<div class=\"container\">
<br />
<br />
<br />
<br />
<br />
<br />
    <h1>
      Admin System Logs
		</h1>
    <br />
    <br />
    <div class=\"logging-container\">
      <table>
";

//    (`session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
//    `dinner_id`, `timestamp`, `seats_reserved`,
//     `action`, `isAdmin`, `user_email`) 
while ($record = mysqli_fetch_array($sql_results)) {
    $logging_id = $record['logging_id'];
    $session_id = $record['session_id'];
    $first_name = $record['first_name'];
    $last_name = $record['last_name'];
    $phone_number = $record['phone_number'];
    $email = $record['email'];
    $reservation_total = $record['reservation_total'];
    $dinner_id = $record['dinner_id'];
    $timestamp = $record['timestamp'];
    $seats_reserved = $record['seats_reserved'];
    $action = $record['action'];
    $isAdmin = $record['isAdmin'];
    $user_email = $record['user_email'];
    $specific_id = $record['specific_id'];
    $details = $record['details'];

    if ($action == 'Add_Reservation') {
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>RESERVATION_ID:</span>$specific_id|<span>SEATS:</span>$seats_reserved|<span>RESERVATION_TOTAL:</span>$$reservation_total|<span>NAME:</span>$first_name&nbsp$last_name|<span>EMAIL:</span>$email|<br /><span>PHONE:</span>$phone_number
          </td>
        </tr>
      ";
    }
    if ($action == 'Add_Waitlist') {
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>WAITLIST_ID:</span>$specific_id|<span>SEATS:</span>$seats_reserved|<span>RESERVATION_TOTAL:</span>$$reservation_total|<span>NAME:</span>$first_name&nbsp$last_name|<span>EMAIL:</span>$email|<br /><span>PHONE:</span>$phone_number
          </td>
        </tr>
      ";
    }
    if ($action == 'Add_Dinner') {
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>DATE:</span>$details|<span>SEATS:</span>$seats_reserved|<span>PRICE:</span>$$reservation_total
          </td>
        </tr>
      ";
    }
    if ($action == 'Edit_Dinner') {
      $detailsArray = explode('|', $details);
      $dateDetails = $detailsArray[1];
      $entreeDetails = $detailsArray[0];
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>DATE:</span>$dateDetails|<span>ENTREE:</span>$entreeDetails|<span>SEATS:</span>$seats_reserved|<span>PRICE:</span>$$reservation_total
          </td>
        </tr>
      ";
    }
    if ($action == 'Cancel_Reservation') {
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>CONFIRMATION_CODE:</span>$specific_id|<span>NAME:</span>$first_name&nbsp$last_name|<span>EMAIL:</span>$email|<span>SEATS:</span>$seats_reserved
          </td>
        </tr>
      ";
    }
    if ($action == 'Cancel_Waitlist') {
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>WAITLIST_ID:</span>$specific_id|<span>NAME:</span>$first_name&nbsp$last_name|<span>EMAIL:</span>$email|<span>SEATS:</span>$seats_reserved
          </td>
        </tr>
      ";
    }
    if ($action == 'Move_Reservation') {
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>NEW_DINNER_ID:</span>$details|<span>CONFIRMATION_CODE:</span>$specific_id|<span>NAME:</span>$first_name&nbsp$last_name|<span>EMAIL:</span>$email|<span>SEATS:</span>$seats_reserved
          </td>
        </tr>
      ";
    }
    if ($action == 'Move_Waitlist_To_Reservation') {
      $detailsArray = explode('|', $details);
      $newDinnerIDDetails = $detailsArray[0];
      $confirmationCodeDetails = $detailsArray[1];
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>NEW_DINNER_ID:</span>$newDinnerIDDetails|<span>CONFIRMATION_CODE:</span>$confirmationCodeDetails|<span>DELETED_WAITLIST_ID:</span>$specific_id|<span>NAME:</span>$first_name&nbsp$last_name|<span>EMAIL:</span>$email|<span>PHONE_NUMBER:</span>$phone_number|<span>SEATS:</span>$seats_reserved|<span>RESERVATION_TOTAL:</span>$$reservation_total
          </td>
        </tr>
      ";
    }
    if ($action == 'Move_Waitlist_To_New_Waitlist') {
      echo "
        <tr>
          <td>
            <span>#$logging_id</span>|$timestamp|<span>ACTION:</span>$action|<span>isAdmin:</span>$isAdmin|<span>USER_EMAIL:</span>$user_email|<span>SESSION:</span>$session_id|<span>DINNER_ID:</span>$dinner_id|<span>NEW_DINNER_ID:</span>$details|<span>WAITLIST_ID:</span>$specific_id|<span>NAME:</span>$first_name&nbsp$last_name|<span>EMAIL:</span>$email|<span>PHONE_NUMBER:</span>$phone_number|<span>SEATS:</span>$seats_reserved
          </td>
        </tr>
      ";
    }

  }

echo "
      </table>
    </div>
    <br />
    <br />
    <br />
  </div>";

include "../footer.php";
?>