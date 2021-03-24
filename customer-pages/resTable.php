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
    <th>Reserve<br />Seats</th>
  </tr>
";

$avialabilityCount;
$inlineStyleAvailabiltyColor;

for ($i = 0; $i < count($datesArray); $i++) {
  // if no availability these will produce the computed css or html outputs
  if ($availableSeats[$i] == 0) {
    $avialabilityCount = 'Waitlisted: ' . $waitlist[$i];
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
  }
  // if availability these will produce the computed css or html outputs
  else {
    $avialabilityCount = $availableSeats[$i];
    $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
  }
  // populates the table
  echo "
  <tr>
    <td>$datesArray[$i]<br />6:00PM</td>
    <td>Moroccan</td>
    <td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
    <td>
      <select name=\"cars\" id=\"cars\">
        <option value=\"0\">0</option>
        <option value=\"1\">1</option>
        <option value=\"2\">2</option>
        <option value=\"3\" selected=\"selected\">$makeReservation[$i]</option>
        <option value=\"4\">4</option>
      </select>
    </td>
    <!-- <td><a href=\"userInfo.html\" class=\"buttonLinks2\">Reserve Now</a></td> -->
  </tr>
";
}

echo "
    </table>

  ";



// echo "<br /><br /><br />";
// echo "
// <table class=\"table table-striped\">
//   <tr>
//     <th>Date</th>
//     <th>Entrée<br/>Type</th>
//     <th>
//       Available<br />
//       Seats
//     </th>
//     <th>Make a <br />Reservation</th>
//   </tr>
// ";

// $avialabilityCount;
// $inlineStyleAvailabiltyColor;

// for ($i = 0; $i < count($datesArray); $i++) {
//   // if no availability these will produce the computed css or html outputs
//   if ($availableSeats[$i] == 0) {
//     $avialabilityCount = 'Waitlisted: ' . $waitlist[$i];
//     $inlineStyleAvailabiltyColor = 'style="background-color: rgb(243, 166, 166)"';
//   }
//   // if availability these will produce the computed css or html outputs
//   else {
//     $avialabilityCount = $availableSeats[$i];
//     $inlineStyleAvailabiltyColor = 'style="background-color: rgb(148, 226, 148)"';
//   }
//   // populates the table
//   echo "
//   <tr>
//     <td>$datesArray[$i]<br />6:00PM</td>
//     <td>Moroccan</td>
//     <td $inlineStyleAvailabiltyColor>$avialabilityCount</td>
//     <td>
//       <select name=\"cars\" id=\"cars\">
//         <option value=\"0\">0</option>
//         <option value=\"1\">1</option>
//         <option value=\"2\">2</option>
//         <option value=\"3\" selected=\"selected\">$makeReservation[$i]</option>
//         <option value=\"4\">4</option>
//       </select>
//     </td>
//     <!-- <td><a href=\"userInfo.html\" class=\"buttonLinks2\">Reserve Now</a></td> -->
//   </tr>
// ";
// }

// echo "
//     </table>

//   ";
?>