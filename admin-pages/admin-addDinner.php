<?php
// Purpose: Fill out form to add a new dinner

include "account.php";

include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;
$sqlEventDatesArray = array();

$sql = "SELECT event_date FROM dinners
        ORDER BY event_date";
include "connectToDB.php";

include "../nav.php";

// needed to stop the dates of thursdays in the select input at december
$stopMonth = 13;
// generates the dates in the select menu
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
      Admin Add Dinner
		</h1>
    <br />
    <br />

		<form style=\"\" name=\"addDinner\" 
			 action=\"admin-addDinnerProcess.php\"
			 method=\"POST\">
        <div style=\"margin-bottom:1rem;\">
          Entrée Name:
          <input type=\"text\" 
            name=\"entree_name\"	
            id=\"entree_name\" class=\"inputText\" required/>
        </div>
        <div style=\"margin-bottom:8rem;\">
          <span>Event Date:</span>
          ";

// date input component that will be resused in other pages. the select with popualated Thursday dates          
echo "
    <select name=\"event_date\" id=\"event_date\" class=\"inputText\" size=\"6\" required>
  ";


// block will push the used dates for dinners and put them in an array.
while ($record = mysqli_fetch_array($sql_results)) {
  $event_dateArray = explode('-', $record[0]);
  $event_dateYear = $event_dateArray[0];
  $event_dateMonth = $event_dateArray[1];
  $event_dateDay = $event_dateArray[2];
  $event_dateFormatted = $event_dateMonth . "-" . $event_dateDay . "-" . $event_dateYear;
  array_push($sqlEventDatesArray, $event_dateFormatted);
}

// finds the difference of two arrays. in this case it will find difference of all selectable dates for
// the year and the dates that are already reserved for dinners.
$ArrayDifference = array_diff($datesArray, $sqlEventDatesArray);

for ($i = 0; $i < count($datesArray); $i++) {
  if ($ArrayDifference[$i] != "") {
    echo "
    <option value=\"$datesArray[$i]\">$datesArray[$i]</option>";
  }
  else {
    echo "
    <option value=\"$datesArray[$i]\" style=\"color:red;\" disabled>$datesArray[$i]</option>";
  }
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
            id=\"start_time\" class=\"inputText\" value=\"11:30\" required/><br />
        </div>
				End Time: 
				<input type=\"time\" 
					 name=\"end_time\"	
					 id=\"end_time\" class=\"inputText\" value=\"13:30\" required/><br /><hr />
				Available Seats: 
				<input type=\"number\" 
					 name=\"seats\"	
					 id=\"seats\" class=\"inputText\" value=\"32\" required/><br /><br />
        Price Per Seat:
           <input type=\"number\" 
              name=\"price\"	
              id=\"price\" class=\"inputText\" value=\"16\" required/><br /><br /><br />

        <div style=\"text-align:center; display:flex; justify-content:space-evenly\">
        <input type=\"submit\" class=\"buttonLinks3\"
        name=\"submit\"	
        value=\"Submit\" />	
        <input type=\"reset\" class=\"buttonLinks3\"
        name=\"reset\"	
        value=\"Clear\"/>
        <a href=\"admin-dashboard.php\" class=\"buttonLinks3\" >Dashboard</a>
        </div>
		</form>
       <br /><br /><br />
        ";
echo "
</div>";

include "../footer.php";
?>