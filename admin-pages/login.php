<?php
include "fileLinks.php";
include "../header.php";
include "../nav.php";

$isLogin = true;

echo "
  <div class=\"container\">
  <h1 style=\"text-align: center\">Sign-in</h1>
  <br />
  <br />
  <br />
  <div class=\"login-choices-container\">
    <span class=\"login-selected login-choices\">Login</span><span class=\"login-choices\">Create Account</span>
  </div>
";

  echo "
    <form name=\"login\" 
        action=\"admin-dashboard.php\"
        method=\"POST\"
        class=\"login-form login\">

      <div style=\"margin-bottom:1rem;\">
        Email:
        <input type=\"email\" 
          name=\"email\"	
          id=\"email\" class=\"inputText\" value=\"daumana461@cs.wilkescc.edu\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        Password:
        <input type=\"password\" 
          name=\"Password\"	
          id=\"Password\" class=\"inputText\" value=\"password\" required/>
      </div>
      <br />
      <div style=\"text-align:center;\">
        <input type=\"submit\" class=\"buttonLinksTables\" \"
          name=\"submit\"	
          value=\"Login\" />	
      </div>
    </form>
  ";

  echo "
      <form name=\"createAccount\" 
        action=\"admin-dashboard.php\"
        method=\"POST\"
        class=\"login-form create-account\">

      <div style=\"margin-bottom:1rem;\">
        Email:
        <input type=\"email\" 
          name=\"email\"	
          id=\"email\" class=\"inputText\" value=\"\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        Password:
        <input type=\"password\" 
          name=\"Password\"	
          id=\"Password\" class=\"inputText\" value=\"\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        First Name:
        <input type=\"text\" 
          name=\"first_name\"	
          id=\"first_name\" class=\"inputText\" value=\"\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        Last Name:
        <input type=\"text\" 
          name=\"last_name\"	
          id=\"last_name\" class=\"inputText\" value=\"\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        Phone Number:
        <input type=\"text\" 
          name=\"phone_number\"	
          id=\"phone_number\" class=\"inputText\" value=\"\" required/>
      </div>
      <br />
      <div style=\"text-align:center;\">
        <input type=\"submit\" class=\"buttonLinksTables\" \"
          name=\"submit\"	
          value=\"Create User\" />	
      </div>
    </form>
  ";

echo "
  </div>
  <br />
  <br />
  <br />
";
include "../footer.php";
?>