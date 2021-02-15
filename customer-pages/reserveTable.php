<?php
include "fileLinks.php";
include "../header.php";
include "../nav.php";
include "reserveTableHTML.html";

// Get current month and only thursdays
date_default_timezone_set("America/New_York");
echo date('Y M D d') . '<br />';
echo date('Y-m-d') . '<br />';
echo date('Y M D d', strtotime('2021-11-05')) . '<br />';
$str = '2021-11-';
for ($i2 = 1; $i2 < 32; $i2++) 
{

  // echo '<br>',
  $ddd = $str . $i2;
  // echo '',

  $date = date('Y M D d', $time = strtotime($ddd));

  if (strpos($date, 'Thu')) {
    echo $date . '----';
    echo $ddd . '<br />';
  }
}

echo '----------------------------------- <br /> <br />';



// get all months and only thursdays
for ($month = 1; $month < 13; $month++) {
  //$month = 1;
  $str = '2021-' . $month . '-';
  echo '<br />' . $month . '<br />';
  for ($i2 = 1; $i2 < 31; $i2++) {

    $ddd = $str . $i2;
    // echo '',

    $date = date('Y M D d', $time = strtotime($ddd));

    if (strpos($date, 'Thu')) {
      echo $date . '----';
      echo $ddd . '<br />';
    }

  }


}

// GET YEAR
// $str2 = '-01-01';
// for ($i3 = 2021; $i3 < 2030; $i3++) 
// {

//   // echo '<br>',
//   $ddd2 = $i3 . $str2;
//   // echo '',

//   $date2 = date('Y M D d', $time = strtotime($ddd2));
//   echo $date2 . '----';
//   echo $ddd2 . '<br />';
// }
// include "../footer.php";
?>