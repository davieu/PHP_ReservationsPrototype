<?php
/* <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1\" crossorigin=\"anonymous\"> */
/*
 <li>
 <a href=\"../admin-pages/login.php\"
 ><div class=\"tops\"></div>
 Daumana <i class=\"fas fa-angle-double-down\"></i></a
 >
 </li>
 */
echo "
    <!DOCTYPE html>
    <html lang=\"en\">
      <head>
        <meta charset=\"UTF-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\" />
        <title>Document</title>
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1\" crossorigin=\"anonymous\"> 
        <link rel=\"stylesheet\" href=\"../css/main.css\" />
        <link rel=\"stylesheet\" href=\"../css/nav-copy.css\" />
        <link rel=\"stylesheet\" href=\"../css/footer.css\" />
        <link rel=\"stylesheet\" href=\"../css/tables.css\" />
        
        <script src=\"https://kit.fontawesome.com/104e14530f.js\"></script>
      </head>
    <body>
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
            About </a
          >
        </li>

        <li>
        <div class=\"dropdown\">
  <a class=\" dropdown-toggle dropdown\" id=\"dropdownMenuButton\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
  <div class=\"tops\"></div>Daumana101
  </a>
  <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
    <li><a class=\"dropdown-item\" href=\"admin-dashboard.php\">Dashboard</a></li>
    <li><a class=\"dropdown-item\" href=\"#\">Another action</a></li>
    <li><a class=\"dropdown-item\" href=\"../index.php\">Logout</a></li>
  </ul>
</div>
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