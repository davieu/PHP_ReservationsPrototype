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


    <div class=\"dashboard-btnGroup\">

      <div class=\"dropdown dashboard-links\">
        <button class=\"btn btn-secondary dropdown-toggle buttonLinksTables dashboard-btns\" type=\"button\" 
          id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
            Dinner Actions
        </button>
        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
          <li><a class=\"dropdown-item\" href=\"admin-addDinner.php\">Add Dinner</a></li>
          <li><a class=\"dropdown-item\" href=\"admin-editDinner.php\">Edit Dinner</a></li>
        </ul>
      </div>

      <br />

      <div class=\"dropdown dashboard-links\">
        <button class=\"btn btn-secondary dropdown-toggle buttonLinksTables dashboard-btns\" type=\"button\" 
          id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
            Reservation Actions
        </button>
        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
          <li><a class=\"dropdown-item\" href=\"admin-addReservation.php\">Add Reservation</a></li>
          <li><a class=\"dropdown-item\" href=\"admin-moveReservation.php\">Move Reservation</a></li>
          <li><a class=\"dropdown-item\" href=\"admin-cancelReservation.php\">Cancel Reservation</a></li>
          <li><hr class=\"dropdown-divider\"></li>
          <li><a class=\"dropdown-item\" href=\"admin-emailConfirmation.php\">Email Confirmation</a></li>
          <li>
        </ul>
      </div>
      <br />
      <a href=\"admin-systemLogs.php\" class=\"buttonLinksTables\" style=\"width: 12rem; text-align:center\">View Logs</a>
      </div>
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