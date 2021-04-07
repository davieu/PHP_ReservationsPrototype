<?php

echo "
  <div class=\"container\">
    <h1 style=\"text-align: center\">Edit Reservation List</h1>
    <h1 style=\"text-align: center\">PROTOTYPE PROTOTYPE PROTOTYPE PROTOTYPE</h1>
    <br />
    <br />
    <br />
    <h3>Choose Date</h3>
    ";

// just displays viable dates for selection
echo "<select name=\"date\" id=\"dates\">";
for ($i = 0; $i < count($datesArray); $i++) {
  echo "  
      <option value=\"$datesArray[$i]\" >$datesArray[$i]</option>
      ";
}
echo "</select>";

echo "
    <br />
    <p>
      Total Reserved for Date: 22<br />
      Available Seats: 10<br />
      Waitlist: 0
      <br />
      Current Meal: Moroccan
    </p>
    <br />
    <h3>Reserved</h3>
    <br />
    <table>
      <tr>
        <th>Date</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Contact Info</th>
        <th>Total <br />Reserved</th>
        <th>Confirmation #</th>
        <th>Select</th>
      </tr>
      <tr>
        <td>2021-01-30<br />6:00PM</td>
        <td>Hugo</td>
        <td>Koko</td>
        <td>336-484-1554<br />HugoK@gmail.com</td>

        <td>2</td>
        <td>3312663434</td>
        <td>
          <div class=\"btn-group\"role=\"group\">
            <a href=\"admin-viewReservation.php\"><button class=\"btn btn btn-success\"style=\"margin-left: 0.5rem\">
              View
          </div>
        </td>
      </tr>
      <tr>
        <td>2021-01-30<br />6:00PM</td>
        <td>Jane</td>
        <td>Hudson</td>
        <td>336-484-1554<br />HugoK@gmail.com</td>

        <td>2</td>
        <td>3312663434</td>
        <td>
          <div class=\"btn-group\"role=\"group\">
            <a href=\"admin-viewReservation.php\"><button class=\"btn btn btn-success\"style=\"margin-left: 0.5rem\">
              View
          </div>
        </td>
      </tr>
      <tr>
        <td>2021-01-30<br />6:00PM</td>
        <td>John</td>
        <td>Johnson</td>
        <td>336-484-1554<br />HugoK@gmail.com</td>

        <td>2</td>
        <td>3312663434</td>
        <td>
          <div class=\"btn-group\"role=\"group\">
            <a href=\"admin-viewReservation.php\"><button class=\"btn btn btn-success\"style=\"margin-left: 0.5rem\">
              View
          </div>
        </td>
      </tr>
      <tr>
        <td>2021-01-30<br />6:00PM</td>
        <td>Jim</td>
        <td>Hew</td>
        <td>336-484-1554<br />HugoK@gmail.com</td>

        <td>2</td>
        <td>3312663434</td>
        <td>
          <div class=\"btn-group\"role=\"group\">
            <a href=\"admin-viewReservation.php\"><button class=\"btn btn btn-success\"style=\"margin-left: 0.5rem\">
              View
          </div>
        </td>
      </tr>
      <tr>
        <td>2021-01-30<br />6:00PM</td>
        <td>Dim</td>
        <td>Sum</td>
        <td>336-484-1554<br />HugoK@gmail.com</td>

        <td>2</td>
        <td>3312663434</td>
        <td>
          <div class=\"btn-group\"role=\"group\">
            <a href=\"admin-viewReservation.php\"><button class=\"btn btn btn-success\"style=\"margin-left: 0.5rem\">
              View
          </div>
        </td>
      </tr>
      <tr>
        <td>2021-01-30<br />6:00PM</td>
        <td>Ash</td>
        <td>Ketchup</td>
        <td>336-484-1554<br />HugoK@gmail.com</td>

        <td>2</td>
        <td>3312663434</td>
        <td>
          <div class=\"btn-group\"role=\"group\">
            <a href=\"admin-viewReservation.php\"><button class=\"btn btn btn-success\"style=\"margin-left: 0.5rem\">
              View
          </div>
        </td>
      </tr>
    </table>
  </div>
  <br />
  <br />
  <br />
  ";
?>