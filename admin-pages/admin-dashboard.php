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
        <a href=\"admin-moveReservation.php\" class=\"buttonLinksTables dashboard-btns\">Move Reservation</a>
      </div>
      <div class=\"buttonGroup\">
        <a href=\"#\" style=\"visibility:hidden\"></a>
        <a href=\"admin-cancelReservation.php\" class=\"buttonLinksTables dashboard-btns\">Cancel Reservation</a>
    </div>
    </div>
      <a href=\"admin-emailConfirmation.php\" class=\"buttonLinksTables dashboard-btns\">Email Confirmation</a>
      <br />
      <a href=\"admin-systemLogs.php\" class=\"buttonLinksTables dashboard-btns\">View Logs</a>
      <br />

      <div class=\"dropdown\">
        <button class=\"btn btn-secondary dropdown-toggle buttonLinksTables\" type=\"button\" 
          id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
            Dinner Actions
        </button>
        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
          <li><a class=\"dropdown-item\" href=\"admin-addDinner.php\">Add Dinner</a></li>
          <li><a class=\"dropdown-item\" href=\"admin-editDinner.php\">Edit Dinner</a></li>
        </ul>
      </div>

      <br />
      <div class=\"dropdown\">
        <button class=\"btn btn-secondary dropdown-toggle buttonLinksTables\" type=\"button\" 
          id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
            Reservation Actions
        </button>
        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
          <li><a class=\"dropdown-item\" href=\"admin-addReservation.php\">Add Reservation</a></li>
          <li><a class=\"dropdown-item\" href=\"admin-moveReservation.php\">Move Reservation</a></li>
          <li><a class=\"dropdown-item\" href=\"admin-cancelReservation.php\">Cancel Reservation</a></li>
          <li><a class=\"dropdown-item\" href=\"admin-emailConfirmation.php\">Email Confirmation</a></li>
          
        </ul>
      </div>


      <br />
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