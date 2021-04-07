<?php
include "fileLinks.php";
include "account.php";
include "../header.php";
//simulates signed in
$signedin = true;

include "../nav.php";

$stopMonth = 13;
include "../dateGenerator.php";

$dinner_id = $_GET['dinner_id'];

// $sql = "SELECT COUNT(ProductID)
//         FROM Products";
// include "connectToDB.php";

// gets all customer data with specified meal id in ordered form based on last name
$sql = "SELECT * FROM `customers`
        WHERE  `dinner_id` = '$dinner_id'
        ORDER BY `last_name`";
;
include "connectToDB.php";

echo "
<div class=\"container\">
  <br /><br /><br /><br /><br /><br />
  <h1>
  Admin Cancel Reservation: List
  </h1>
  <br />
  <br />
  <p><strong>Select a reservation from the list to cancel</strong></p>

  <table>
  <tr>

    <th>
      Email
    </th>
    <th>
      Phone<br />Number
    </th>
    <th>Seats<br/>Reserved</th>
    <th>Name</th>
  </tr>
";

// query for event dates in ordered form (ascending)
while ($record = mysqli_fetch_array($sql_results)) {
  echo "
		<tr>
      <td>$record[5]</td>
			<td>$record[4]</td>
      <td>$record[10]</td>
      <td><a href=\"admin-addReservationUserInfo.php?dinner_id=$record[2]\" class=\"buttonLinks3 tableSelect\">$record[3], $record[2]</a></td>
		</tr>
	";
}

echo "
    </table>
  ";

echo "
    </table><br /><br />
    <a href=\"admin-dashboard.php\" class=\"buttonLinks3\" >Dashboard</a>
  <br /><br /><br />
</div>";

include "../footer.php";
?>