<?php
include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;
include "../nav.php";

echo "<div class=\"container\"><br />
<br />
<br />
<br />
<br />
<br />";
$stopMonth = 13;
include "../dateGenerator.php";
include "admin-editDinnerComponent.php";
echo "</div> <br /><br /><br />";

include "../footer.php";
?>