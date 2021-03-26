<?php
include "fileLinks.php";
include "../header.php";

include "account.php";
//simulates signed in
$signedin = true;
include "../nav.php";

$stopMonth = 13;
$dinner_id = $_GET['dinner_id'];

// i'm getting the dinner_id from the url parameter.
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

include "formatToReadableHelper.php";
include "../dateGenerator.php";

echo "
<div class=\"container\">
<br />
<br />
<br />
<br />
<br />
<br />
    <h1>
      Admin Edit Dinner
		</h1>
    <br />
    <br />

		<form name=\"addDinner\" 
			 action=\"admin-editOneDinnerProcess.php?dinner_id=$dinner_id\"
			 method=\"POST\">
        <div style=\"margin-bottom:1rem;\">
        ";

echo "
          Entrée Name:
          <input type=\"text\" 
            name=\"entree_name\"	
            id=\"entree_name\" class=\"inputText\" value=\"$entree_name\"required/>
        </div>
        <div style=\"margin-bottom:8rem;\">
          <span>Event Date:</span>
          ";

echo "
  <select name=\"event_date\" id=\"event_date\" class=\"inputText\" size=\"6\" required>
";
// This helps set a default for the select menu of event dates
for ($i = 0; $i < count($datesArray); $i++) {
  $selectedDate;
  if ($datesArray[$i] == $event_dateFormatted) {
    $selectedDate = "selected";
  }
  else {
    $selectedDate = "";
  }

  echo "
        <option value=\"$datesArray[$i]\" $selectedDate>$datesArray[$i]</option>
";
}

echo "
</select>
";
echo "
        </div>
        <div style=\"margin-bottom:1rem;\">
          <span>Start Time:</span>
          <input type=\"time\" 
            name=\"start_time\"	
            id=\"start_time\" class=\"inputText\" value=\"$start_time\" required/><br />
        </div>
				End Time: 
				<input type=\"time\" 
					 name=\"end_time\"	
					 id=\"end_time\" class=\"inputText\" value=\"$end_time\" required/><br /><hr />
				Available Seats: 
				<input type=\"number\" 
					 name=\"seats\"	
					 id=\"seats\" class=\"inputText\" value=\"$seats\" required/><br /><br />
        Price Per Seat:
           <input type=\"number\" 
              name=\"price\"	
              id=\"price\" class=\"inputText\" value=\"$price\" required/><br /><br /><br />

        <div style=\"text-align:center; display:flex; justify-content:space-between\">
          <input type=\"submit\" class=\"buttonLinks3\"
          name=\"submit\"	
          value=\"Submit\" />	
          <input type=\"reset\" class=\"buttonLinks3\"
          name=\"reset\"	
          value=\"Clear\"/>
          <a href=\"admin-dashboard.php\" class=\"buttonLinks3\" >Dashboard</a>
          <a href=\"admin-delDinnerProcess.php?dinner_id=$dinner_id\" class=\"buttonLinksWarning\" style=\"align-content:center;\">Delete</a>
        </div>
		</form>
       <br /><br /><br />
</div>";

include "../footer.php";
?>