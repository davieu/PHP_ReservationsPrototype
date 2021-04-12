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
        <a href=\"admin-addDinner.php\" class=\"buttonLinks3 dashboard-btns\">Add Dinner</a>
        <a href=\"admin-addReservation.php\" class=\"buttonLinks3 dashboard-btns\">Add Reservation</a>    
      </div>
      <div class=\"buttonGroup\">
        <a href=\"admin-editDinner.php\" class=\"buttonLinks3 dashboard-btns\">Edit Dinner</a>
        <a href=\"admin-reservation-actions.php\" class=\"buttonLinks3 dashboard-btns\">Edit Reservation</a>
      </div>
      <div class=\"buttonGroup\">
        <a href=\"#\" style=\"visibility:hidden\"></a>
        <a href=\"admin-cancelReservation.php\" class=\"buttonLinks3 dashboard-btns\">Cancel Reservation</a>
    </div>
    </div>
      <a href=\"admin-systemLogs.php\" class=\"buttonLinks3 dashboard-btns\">View Logs</a>
      <br />
      <br />
      <br />
      <h1>Reservation Overview</h1>
      <br />
      <br />
      <p>
      Total Reserved This Week: 22<br />
      Available Seats This Week: 10<br />
      Waitlisted This Week: 0<br />
      Total Reserved This Month: 89<br />
      Total Waitlisted This Week: 15<br /><br />
      </p>
      <br />
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