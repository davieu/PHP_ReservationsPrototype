<?php
include "fileLinks.php";
include "../header.php";
include "../nav.php";
//include "reserveTableHTML.html";
echo "<div class=\"container\">
<br />
<br />
<br />
<br />
<br />
<br />
<h1 style=\"text-align: center\">Reserve a Table</h1>
<br />
<br />";
// table
$stopMonth = 6;
include "../dateGenerator.php";
//include "resTableProto.php";
include "resTable.php";

echo "
<br />
<br />
<a href=\"userInfo.php\" class=\"buttonLinks2\">Reserve Now</a>
<br />
<br />
</div>";

include "../footer.php";
?>