<?php
$loginState = "
  <a href=\"$loginNavLink\"
  ><div class=\"tops\"></div>
  Login</a
  >";

if ($signedin == true) {
  $loginState = "       
    <div class=\"dropdown\">
    <a class=\" dropdown-toggle dropdown\" id=\"dropdownMenuButton\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
    <div class=\"tops\"></div>Daumana101
    </a>
    <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
      <li><a class=\"dropdown-item\" href=\"admin-dashboard.php\">Dashboard</a></li>
      <li><a class=\"dropdown-item\" href=\"admin-reservation-actions.php\">Edit Reservations</a></li>
      <li><a class=\"dropdown-item\" href=\"admin-systemLogs.php\">System Logs</a></li>
      <li><a class=\"dropdown-item\" href=\"../index.php\">Logout</a></li>
    </ul>
  </div>";
}

echo "
      <!-- Nav Start -->
      <nav>
        <div class=\"logo\">
          <img src=\"$NavLogoImg\" alt=\"company logo\" />
          <h1>Wilkes Community College</h1>
        </div>
        <ul class=\"nav-links-desktop\">
          <li>
            <a href=\"$homeNavLink\"
              ><div class=\"tops\"></div>
              Home</a
            >
          </li>
          <li>
            <a href=\"$reserveTableNavLink\"
              ><div class=\"tops\"></div>
              Reserve Table</a
            >
          </li>
          <li>
          <a href=\"#about\"
            ><div class=\"tops\"></div>
            About</a
          >
        </li>
        <li>
        $loginState
        </li>
        </ul>

        <div class=\"burger\">
          <div class=\"burger-lines\">
            <div class=\"line1 lines\"></div>
            <div class=\"line2 lines\"></div>
            <div class=\"line3 lines\"></div>
          </div>
        </div>
      </nav>

      <!-- This will only show when burger menu activated -->
      <div class=\"side-bar\">
        <div class=\"links-wrapper\">
          <ul class=\"nav-links\">
            <li class=\"side-links\">
              <a href=\"$homeNavLink\">Home</a>
            </li>
            <li class=\"side-links\"><a href=\"$reserveTableNavLink\">Reserve Table <i class=\"fas fa-calendar-check\"></i></a></li>
            <li class=\"side-links\"><a href=\"#about\">About</a></li>
            <li class=\"side-links\">$loginState</li>
          </ul>
        </div>
      </div>

  ";
?>