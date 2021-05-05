<?php
include "fileLinks.php";
include "../header.php";
include "../nav.php";

$email = '';
if (isset($_GET['email'])) {
  $email = $_GET['email'];
}

// will display previous email when error is found or on sucessful create user
$emailValue = (true ? $email : '');



echo "
  <div class=\"container\">
  <h1 style=\"text-align: center\">Sign-in</h1>
  <br />
  <br />
";

  // the tab above the forms for displaying the login or create account
  echo"
    <div class=\"myModal\"><span style=\"text-align:center\">$email<br />Email Already In Use</span></div>
    <br/>
    <div class=\"login-choices-container\">
      <span class=\"login-selected login-choices login-tab\" onclick=\"loginActive()\">Login</span>
      <span class=\"login-choices create-tab\" onclick=\"createActive()\">Create Account</span>
    </div>
  ";

  // forms START
  echo "
    <form name=\"login\" 
        action=\"loginProcessSession.php\"
        method=\"POST\"
        class=\"login-form login\">

      <div style=\"margin-bottom:1rem;\">
        Email:
        <input type=\"email\" 
          name=\"email\"	
          id=\"email\" class=\"inputText\" value=\"$email\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        Password:
        <input type=\"password\" 
          name=\"password\"	
          id=\"password\" class=\"inputText\" value=\"\" required/>
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
        action=\"loginProcessCreateAccount.php\"
        method=\"POST\"
        class=\"login-form create-account hide-create-account\">

      <div style=\"margin-bottom:1rem;\">
        Email:
        <input type=\"email\" 
          name=\"email\"	
          id=\"email\" class=\"inputText\" value=\"$emailValue\" required/>
      </div>
      <div style=\"margin-bottom:1rem;\">
        Password:
        <input type=\"password\" 
          name=\"password\"	
          id=\"password\" class=\"inputText\" value=\"\" required/>
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

<script>

  function loginActive() {
    // for the tabs above the form. will light up for whichever one is active
    document.querySelector(".login-tab").classList.add("login-selected");
    document.querySelector(".create-tab").classList.remove("login-selected");
    // for hiding and showing the correct form
    document.querySelector(".create-account").classList.remove("show-create-account");
    document.querySelector(".create-account").classList.add("hide-create-account");
    document.querySelector(".login").classList.remove("hide-login");
    document.querySelector(".login").classList.add("show-login");
  }

  function createActive() {
    // for the tabs above the form. will light up for whichever one is active
    document.querySelector(".create-tab").classList.add("login-selected");
    document.querySelector(".login-tab").classList.remove("login-selected");
    // for hiding and showing the correct form
    document.querySelector(".login").classList.remove("show-login");
    document.querySelector(".login").classList.add("hide-login");
    document.querySelector(".create-account").classList.remove("hide-create-account");
    document.querySelector(".create-account").classList.add("show-create-account");
  }

  const duplicateFound = new URL(location.href).searchParams.get("duplicate"); //will be true or false
  const loginErrorFound = new URL(location.href).searchParams.get("error");
  const accountCreatedsuccess = new URL(location.href).searchParams.get("status");

  function showError() {
    document.querySelector(".myModal").style.visibility = 'hidden';
  }

  // will pop out if a duplicate email is entered when creating new account
  if (duplicateFound) {
    createActive()
    document.querySelector(".myModal").style.visibility = 'visible'
    setTimeout(showError, 4000);
  }

  // will pop out if wrong credentials are entered or non-existent credentials are entered
  if (loginErrorFound) {
    document.querySelector(".myModal").innerHTML = 'Error With Credentials: Try Again';
    document.querySelector(".myModal").style.visibility = 'visible'
    setTimeout(showError, 4000);
  }

  // will pop out if accoutn created was success
  if (accountCreatedsuccess) {
    document.querySelector(".myModal").innerHTML = 'Account Created: Success!';
    document.querySelector(".myModal").style.color = 'rgb(148, 226, 148)';
    document.querySelector(".myModal").style.visibility = 'visible';
    setTimeout(showError, 4000);
  }

</script>