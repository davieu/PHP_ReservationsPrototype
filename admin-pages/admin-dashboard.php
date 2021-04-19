<?php
//Purpose: Dashoboard for the admin. It is a portal to go to other admin actions like edit/add/delete data
// has an overview table

/* include "admin-nav.php"; include "admin-dashboardHTML.html"; include "../footer.php"; */

include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = true;
include "../nav.php";
echo
  "<div class=\"container\">
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <h1 style=\"text-align: center\">Administrator Dashboard</h1>
    <br />
    <br />
    <br />

    <div class=\"buttonGroupContainer\">
      <div class=\"buttonGroup\">
        <a href=\"admin-addDinner.php\" class=\"buttonLinksTables dashboard-btns\">Add Dinner</a>
        <a href=\"admin-addReservation.php\" class=\"buttonLinksTables dashboard-btns\">Add Reservation</a>    
      </div>
      <div class=\"buttonGroup\">
        <a href=\"admin-editDinner.php\" class=\"buttonLinksTables dashboard-btns\">Edit Dinner</a>
        <a href=\"admin-reservation-actions.php\" class=\"buttonLinksTables dashboard-btns\">Edit Reservation</a>
      </div>
      <div class=\"buttonGroup\">
        <a href=\"#\" style=\"visibility:hidden\"></a>
        <a href=\"admin-cancelReservation.php\" class=\"buttonLinksTables dashboard-btns\">Cancel Reservation</a>
    </div>
    </div>
      <a href=\"admin-systemLogs.php\" class=\"buttonLinksTables dashboard-btns\">View Logs</a>
      <br />
      <br />
      <br />
      <h4>Reservation Overview</h4>
      <br />
";

// table
include "admin-dashboardTable.php";
echo "
    <br />
    <br />
    <br />
    <br />
  </div>";

include "../footer.php";
?>