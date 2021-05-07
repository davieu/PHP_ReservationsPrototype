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
";

//    (`session_id`, `first_name`, `last_name`, `phone_number`, `email`, `reservation_total`,
//    `dinner_id`, `timestamp`, `seats_reserved`,
//     `action`, `isAdmin`, `user_email`) 
while ($record = mysqli_fetch_array($sql_results)) {
    $count = 1;
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


    echo "
    <div class=\"logging-container\">
      <p>
        #$count|$timestamp|isAdmin:$isAdmin|$user_email|ACTION:$action|FOR:
      </p>
    </div>";
  }

echo "
</div>";

include "../footer.php";
?>