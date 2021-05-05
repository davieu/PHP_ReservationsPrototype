<?php
// Filename: logout.php
// Author: Davis Umana
// Purpose: Allow logout
$filename="logout.php";
$title="You have been logged out";
session_start();
if (isset($_SESSION['username']))
	{
			$_SESSION['username'] = "error";
			unset($_SESSION['username']);
	}
session_destroy();
include "fileLinks.php";
include "../header.php";
//simulates signed in
$signedin = false;
include "../nav.php";
echo "
    <div class=\"container\">
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <h1 style=\"text-align: center\">Logout Confirmed</h1>
        <br />
        <br />
        <br />
        <h5>
            $title
        </h5>
        <a href=\"../index.php\" class=\"buttonLinksTables\">Home</a>
    </div> \n";
include "../footer.php";
?>
