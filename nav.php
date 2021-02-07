<?php
echo "
    <!DOCTYPE html>
    <html lang=\"en\">
      <head>
        <meta charset=\"UTF-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\" />
        <title>Document</title>
        <link rel=\"stylesheet\" href=\"../css/main.css\" />
        <link rel=\"stylesheet\" href=\"../css/nav.css\" />
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
              Reserve Table <i class=\"fas fa-calendar-check\"></i></a
            >
          </li>
          <li>
          <a href=\"#about\"
            ><div class=\"tops\"></div>
            About</a
          >
        </li>
        <li>
        <a href=\"#\"
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
            <li><a href=\"#\">Login</a></li>
          </ul>
        </div>
      </div>

  ";
?>