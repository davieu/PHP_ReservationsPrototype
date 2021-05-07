<?php
// $loginState = "
//   <a href=\"$loginNavLink\"
//   ><div class=\"tops\"></div>
//   Login</a
//   >";

// if ($signedin == true) {
//   $loginState = "       
//     <div class=\"dropdown\">
//       <a class=\" dropdown-toggle dropdown\" id=\"dropdownMenuButton\" 
//       data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
//         <div class=\"tops\"></div><span style=\"cursor: pointer;\">Daumana101</span>
//       </a>
//       <ul class=\"dropdown-menu sidebar-drop\" aria-labelledby=\"dropdownMenuButton\">
//         <li><a class=\"dropdown-item\" href=\"admin-dashboard.php\">Dashboard</a></li>
//         <li><hr class=\"dropdown-divider\"></li>
//         <li><a class=\"dropdown-item\" href=\"admin-addDinner.php\">Add Dinner</a></li>
//         <li><a class=\"dropdown-item\" href=\"admin-editDinner.php\">Edit Dinner</a></li>
//         <li><hr class=\"dropdown-divider\"></li>
//         <li><a class=\"dropdown-item\" href=\"admin-addReservation.php\">Add Reservation</a></li>
//         <li><a class=\"dropdown-item\" href=\"admin-moveReservation.php\">Move Reservation</a></li>
//         <li><a class=\"dropdown-item\" href=\"admin-cancelReservation.php\">Cancel Reservation</a></li>
//         <li><a class=\"dropdown-item\" href=\"admin-emailConfirmation.php\">Email Confirmation</a></li>
//         <li><hr class=\"dropdown-divider\"></li>
//         <li><a class=\"dropdown-item\" href=\"admin-systemLogs.php\">System Logs</a></li>
//         <li><hr class=\"dropdown-divider\"></li>
//         <li><a class=\"dropdown-item\" href=\"../index.php\">Logout</a></li>
//       </ul>
//     </div>";
// }

// echo "
//       <!-- Nav Start -->
//       <nav>
//         <div class=\"logo\">
//           <img src=\"$NavLogoImg\" alt=\"company logo\" />
//           <h1>Wilkes Community College</h1>
//         </div>
//         <ul class=\"nav-links-desktop\">
//           <li class=\"desktop-link\">
//             <a href=\"$homeNavLink\"
//               ><div class=\"tops\"></div>
//               Home</a
//             >
//           </li>
//           <li class=\"desktop-link\">
//             <a href=\"$reserveTableNavLink\"
//               ><div class=\"tops\"></div>
//               Reserve Table</a
//             >
//           </li>
//           <li class=\"desktop-link\">
//           <a href=\"#about\"
//             ><div class=\"tops\"></div>
//             About</a
//           >
//         </li>
//         <li class=\"desktop-link\">
//         $loginState
//         </li>
//         </ul>

//         <div class=\"burger\">
//           <div class=\"burger-lines\">
//             <div class=\"line1 lines\"></div>
//             <div class=\"line2 lines\"></div>
//             <div class=\"line3 lines\"></div>
//           </div>
//         </div>
//       </nav>

//       <!-- This will only show when burger menu activated -->
//       <div class=\"side-bar\">
//         <div class=\"links-wrapper\">
//           <ul class=\"nav-links\">
//             <li class=\"side-links\">
//               <a href=\"$homeNavLink\">Home</a>
//             </li>
//             <li class=\"side-links\"><a href=\"$reserveTableNavLink\">Reserve Table</a></li>
//             <li class=\"side-links\"><a href=\"#about\">About</a></li>
//             <li class=\"side-links\">$loginState</li>
//           </ul>
//         </div>
//       </div>
//   ";
///////////////////

// not signed in
$navState = "
  <ul class=\"nav-links-desktop\">
    <li class=\"desktop-link\">
      <a href=\"$homeNavLink\"
        ><div class=\"tops\"></div>
        Home</a
      >
    </li>
    <li class=\"desktop-link\">
      <a href=\"$reserveTableNavLink\"
        ><div class=\"tops\"></div>
        Reserve Table</a
      >
    </li>
    <li class=\"desktop-link\">
      <a href=\"#about\">
        <div class=\"tops\"></div>
        About
      </a>
    </li>
    <li class=\"desktop-link\">
      <a href=\"$loginNavLink\">
        <div class=\"tops\"></div>
        Login
      </a>
    </li>
  </ul>
";

// signed in
if (isset($_SESSION['email']) && $signedin == true) {
  // separates the email name from the @ portion. So I can just get the email name
  $navEmailArray = explode('@', $_SESSION['email']);
  // doing a substring in case a name is too big it will only show a portion of it followed by "..."
  $navName = $navEmailArray[0];
  if (strlen($navName) > 18) {
    $navName = substr($navName,0, 18) . "...";
  }
  //substr("Hello world",6);

  // $name = '';
  // if (isset($_SESSION['email'])) {
  //   $name = $_SESSION['email']);
  // }
  $navState = "        
      <ul class=\"nav-links-desktop\">
        <li class=\"desktop-link\">
          <a href=\"$adminDash\">
            <div class=\"tops\"></div>
            Dashboard
          </a>
        </li>
        <li class=\"desktop-link\">
          <a href=\"#about\">
            <div class=\"tops\"></div>
            About
          </a>
        </li>
        <li class=\"desktop-link\">
          <div class=\"dropdown\">
            <a class=\" dropdown-toggle dropdown\" id=\"dropdownMenuButton\" 
            data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
              <div class=\"tops\"></div><span style=\"cursor: pointer;\">$navName</span>
            </a>
            <ul class=\"dropdown-menu sidebar-drop\" aria-labelledby=\"dropdownMenuButton\">
              <li><a class=\"dropdown-item\" href=\"admin-dashboard.php\">Dashboard</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"admin-addDinner.php\">Add Dinner</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-editDinner.php\">Edit Dinner</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"admin-addReservation.php\">Add Reservation</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-moveReservation.php\">Move Reservation</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-cancelReservation.php\">Cancel Reservation</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-emailConfirmation.php\">Email Confirmation</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"admin-systemLogs.php\">System Logs</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"$logout\">Logout</a></li>
            </ul>
          </div>
        </li>
      </ul>";
}

// where the $navstate goes 
echo "
    <!-- Nav Start -->
    <nav>
      <div class=\"logo\">
        <img src=\"$NavLogoImg\" alt=\"company logo\" />
        <h1>Wilkes Community College</h1>
      </div>
      $navState
  ";

echo "
      <div class=\"burger\">
        <div class=\"burger-lines\">
          <div class=\"line1 lines\"></div>
          <div class=\"line2 lines\"></div>
          <div class=\"line3 lines\"></div>
        </div>
      </div>
    </nav>
  ";

// sidebar not signed in
$sideBarNav = "
    <div class=\"side-bar\">
      <div class=\"links-wrapper\">
        <ul class=\"nav-links\">
          <li class=\"side-links\">
            <a href=\"$homeNavLink\">Home</a>
          </li>
          <li class=\"side-links\"><a href=\"$reserveTableNavLink\">Reserve Table</a></li>
          <li class=\"side-links\"><a href=\"#about\">About</a></li>
          <li class=\"side-links\">
            <a href=\"$loginNavLink\">
              <div class=\"tops\"></div>
              Login
            </a>
          </li>
        </ul>
      </div>
    </div>
";

// signed in
if (isset($_SESSION['email']) && $signedin == true) {
  // separates the email name from the @ portion. So I can just get the email name
  $navEmailArray = explode('@', $_SESSION['email']);
  // doing a substring in case a name is too big it will only show a portion of it followed by "..."
  $navName = $navEmailArray[0];
  if (strlen($navName) > 8) {
    $navName = substr($navName,0, 8) . "...";
  }

  $sideBarNav = "  
    <div class=\"side-bar\">
      <div class=\"links-wrapper\">
        <ul class=\"nav-links\">
          <li class=\"side-links\">
            <a href=\"$adminDash\">Dashboard</a>
          </li>
          <li class=\"side-links\"><a href=\"#about\">About</a></li>
          <li class=\"side-links\">
          
          <div class=\"dropdown\">
            <a class=\" dropdown-toggle dropdown\" id=\"dropdownMenuButton\" 
            data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
              <div class=\"tops\"></div><span style=\"cursor: pointer;\">$navName</span>
            </a>
            <ul class=\"dropdown-menu sidebar-drop\" aria-labelledby=\"dropdownMenuButton\">
              <li><a class=\"dropdown-item\" href=\"admin-dashboard.php\">Dashboard</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"admin-addDinner.php\">Add Dinner</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-editDinner.php\">Edit Dinner</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"admin-addReservation.php\">Add Reservation</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-moveReservation.php\">Move Reservation</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-cancelReservation.php\">Cancel Reservation</a></li>
              <li><a class=\"dropdown-item\" href=\"admin-emailConfirmation.php\">Email Confirmation</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"admin-systemLogs.php\">System Logs</a></li>
              <li><hr class=\"dropdown-divider\"></li>
              <li><a class=\"dropdown-item\" href=\"$logout\">Logout</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div> 
    ";
}

// displays the state of the navbar for signed in or not
echo "
  $sideBarNav
";
?>