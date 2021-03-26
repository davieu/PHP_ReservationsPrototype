<?php
/* include "admin-nav.php"; include "admin-dashboardHTML.html"; include "../footer.php"; */

include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;
include "../nav.php";
echo "<div class=\"container\">
<br />
<br />
<br />
<br />
<br />
<br />";
include "admin-dashboardHTML.html";

// table
//include "dashboardTableProto.php";
include "dashboardTable.php";
echo "
<br />
<br />
<br />
<br />
</div>";

include "../footer.php";
?>