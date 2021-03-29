<?php
include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;
include "../nav.php";

$stopMonth = 13;
include "../dateGenerator.php";
include "admin-addReservationComponent.php";

include "../footer.php";
?>