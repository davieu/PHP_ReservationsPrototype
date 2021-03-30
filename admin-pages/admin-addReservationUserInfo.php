<?php
include "fileLinks.php";
include "account.php";
include "../header.php";

$dinner_id = $_GET['dinner_id'];
//simulates signed in
$signedin = true;

$sql = "SELECT * FROM dinners
        WHERE dinner_id = $dinner_id";
include "connectToDB.php";

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
      Admin Add<br />Customer Information
		</h1>
    <br />
    <br />

		<form style=\"\" name=\"addDinner\" 
			 action=\"admin-addDinnerProcess.php\"
			 method=\"POST\">
        <div style=\"margin-bottom:1rem;\">
          First Name:
          <input type=\"text\" 
            name=\"first_name\"	
            id=\"first_name\" class=\"inputText\" required/>
        </div>
        <div style=\"margin-bottom:1rem;\">
          Last Name:
          <input type=\"text\" 
            name=\"last_name\"	
            id=\"last_name\" class=\"inputText\" required/>
        </div>
        <div style=\"margin-bottom:1rem;\">
        Email:
        <input type=\"text\" 
          name=\"email\"	
          id=\"email\" class=\"inputText\" required/>
        </div>
        <div style=\"margin-bottom:1rem;\">
        Phone Number:
        <input type=\"text\" 
          name=\"phone_number\"	
          id=\"phone_number\" class=\"inputText\" required/>
        </div><br />
      <table>
        <tr>
          <th>Date</th>
          <th>Entrée<br/>Type</th>
          <th>
            Available<br />
            Seats
          </th>
          <th>Reserve<br />Seats</th>
        </tr>
    ";



while ($record = mysqli_fetch_array($sql_results)) {
  //$rec[0]=dinner_id, $rec[1]=entree_name, $rec[2]=event_date, $rec[3]=start_time, $rec[4]=end_time, $rec[5]=seats, $rec[6]=price 
  // parses data from the sql and also helps with the table "Available Seats" column coloring.
  // to understand the parsing and the variables below please view the "sqlDataParser.php" page
  include "sqlDataParser.php";
  echo "
        <tr>
          <td><strong>$event_dateFormatted</strong><br />
              $startTime-<br />
              $endTime
          </td>
          <td>$record[1]</td>
          <td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
          <td>      
            <select name=\"seats_reserved\" id=\"seats_reserved\">
              <option value=\"0\">0</option>
              <option value=\"1\">1</option>
              <option value=\"2\">2</option>
              <option value=\"3\">3</option>
              <option value=\"4\">4</option>
            </select>
          </td>
        </tr>
      ";
}

echo "
      </table>
      <br />
      <br />    
        
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
    <br /><br />

</div>";

include "../footer.php";
?>