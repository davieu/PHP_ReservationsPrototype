<?php
$cssFiles = "";

$jsFiles = "";
/* <link rel=\"stylesheet\" href=\"../css/main.css\" /> <link rel=\"stylesheet\" href=\"../css/nav-copy.css\" /> <link rel=\"stylesheet\" href=\"../css/footer.css\" /> <link rel=\"stylesheet\" href=\"../css/tables.css\" />"; */
/*       
 <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1\" crossorigin=\"anonymous\"> */
echo "
      <!-- Nav Start -->
      <nav>
        <div class=\"logo\">
          <img src=\"../assets/wccMountains.png\" alt=\"company logo\" />
          <h1>Wilkes Community College</h1>
        </div>
        <ul class=\"nav-links-desktop\">
          <li>
            <a href=\"../index.php\"
              ><div class=\"tops\"></div>
              Home</a
            >
          </li>
          <li>
            <a href=\"../customer-pages/reserveTable.php\"
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
        <a href=\"../admin-pages/login.php\"
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
              <a href=\"../index.php\">Home</a>
            </li>
            <li><a href=\"../customer-pages/reserveTable.php\">Reserve Table <i class=\"fas fa-calendar-check\"></i></a></li>
            <li><a href=\"#about\">About</a></li>
            <li><a href=\"../admin-pages/login.php\">Login</a></li>
          </ul>
        </div>
      </div>

  ";
?>