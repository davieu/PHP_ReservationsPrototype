<?php
//Purpose: Takes in the data from the admin-cancelOneReservation page and processes it to cancel a specific reservation that
// was chosen

include "account.php";
$confirmation_code = $_POST['confirmation_code'];
echo $confirmation_code;
?>