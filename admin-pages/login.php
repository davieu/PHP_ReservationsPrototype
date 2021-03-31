<?php
include "fileLinks.php";
include "../header.php";
include "../nav.php";
echo "
  <div class=\"container\">
  <h1 style=\"text-align: center\">Sign-in</h1>
  <br />
  <br />
  <br />
  <form>
    <label for=\"email\">Email</label><br />
    <input
      type=\"text\"
      id=\"email\"
      name=\"email\"
      value=\"daumana@wcc.edu\"
    /><br /><br />
    <label for=\"password\">CVV:</label><br />
    <input
      type=\"password\"
      id=\"password\"
      name=\"password\"
      value=\"password\"
    /><br /><br /><br />
  </form>
  <a href=\"admin-dashboard.php\" class=\"buttonLinks2\">Sign In</a>
  </div>
  <br />
  <br />
  <br />
";
include "../footer.php";
?>