<?php
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
        <a href=\"$loginNavLink\"
          ><div class=\"tops\"></div>
          Login</a
        >
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
            <li>
              <a href=\"$homeNavLink\">Home</a>
            </li>
            <li><a href=\"$reserveTableNavLink\">Reserve Table <i class=\"fas fa-calendar-check\"></i></a></li>
            <li><a href=\"#about\">About</a></li>
            <li><a href=\"$loginNavLink\">Login</a></li>
          </ul>
        </div>
      </div>

  ";
?>