<?php

echo "

<table>
  <tr>
    <th>Date</th>
    <th>Entrée<br/>Type</th>
    <th>
      Available<br />
      Seats
    </th>
    <th>Total <br />Reserved</th>
  </tr>
";

$avialabilityCount;
$inlineStyleAvailabiltyColor;
$totalReserved;


for ($i = 0; $i < count($test); $i++) {
  // if no availability these will produce the computed css or html outputs
  if ($availableSeats[$i] == 0) {
    $avialabilityCount = 'Waitlisted: ' . $waitlist[$i];
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
    $totalReserved = 32 + $waitlist[$i];
  }
  // if availability these will produce the computed css or html outputs
  else {
    $avialabilityCount = $availableSeats[$i];
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
    $totalReserved = 32 - $avialabilityCount;
  }
  // populates the table
  echo "
      <tr>
        <td>$test[$i]<br />6:00PM</td>
        <td>Moroccan</td>
        <td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
        <td>$totalReserved</td>
        <!-- <td><a href=\"userInfo.html\" class=\"buttonLinks2\">Reserve Now</a></td> -->
      </tr>
      ";
}

echo "
    </table>

  ";
?>