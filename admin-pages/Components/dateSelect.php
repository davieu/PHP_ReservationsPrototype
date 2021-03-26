<?php
// include "../../dateGenerator.php";
echo "
  <select name=\"event_date\" id=\"event_date\" class=\"inputText\" size=\"6\" required>
";

for ($i = 0; $i < count($datesArray); $i++) {
  echo "
      
        <option value=\"$datesArray[$i]\">$datesArray[$i]</option>
      
    <!-- <td><a href=\"userInfo.html\" class=\"buttonLinks2\">Reserve Now</a></td> -->
";
}

echo "
</select>
";
?>
