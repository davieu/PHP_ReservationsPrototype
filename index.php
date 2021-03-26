<?php
include "fileLinks.php";

include "header.php";
include "nav.php";
echo "
<div class=\"grid\">
<header id=\"showcase\">
<div class=\"showcase-container\">
  <div
    class=\"showcase-background-image\"
    role=\"img\"
    aria-label=\"Young Culinary Students\"
  >
  </div>
</div>

<!-- These fill the sides for the showcase content -->
<div class=\"fill-sides-content-right\"></div>
<div class=\"fill-sides-content-left\"></div>
<!-- divider between nav and header/showcase -->
<div class=\"nav-showcase-divider\"></div>
<div class=\"container-showcase-content\">
  <div class=\"showcase-content\">
    <h1>Culinary Arts Program</h1>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum
      delectus amet hic at deserunt enim esse velit eaque veniam magni.
    </p>
  </div>
</div>
</header>

<!-- Main Start -->
<main>
<section id=\"section-a\">
  <div class=\"content-wrap\">
    <h2 class=\"content-title\">Make a Dinner Reservation</h2>
    <div class=\"content-text\">
      <a href=\"customer-pages/reserveTable.php\" class=\"buttonLinks\"
        >Make Reservation
      </a>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis
        veritatis rem fuga ipsum, nostrum laboriosam doloremque error
        magnam, qui, cum provident saepe minus. Error, magni! Magnam
        eius dolorem accusantium, possimus ipsum harum iusto quasi
        illum, magni quaerat, deserunt vel placeat.
      </p>
    </div>
  </div>
</section>

<section id=\"section-b\">
  <ul>
    <li>
      <img src=\"assets/young-cook.jpg\" alt=\"Young cook\" />
      <div class=\"card-content\">
        <h3 class=\"card-title\">Our Cooks</h3>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Architecto molestiae consectetur iusto aut eos modi ipsa et
          obcaecati explicabo deleniti?
        </p>
      </div>
    </li>

    <li>
      <img src=\"assets/cooks-gathering.jpg\" alt=\"Cooks gathering\" />
      <div class=\"card-content\">
        <h3 class=\"card-title\">Food</h3>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Architecto molestiae consectetur iusto aut eos modi ipsa et
          obcaecati explicabo deleniti?
        </p>
      </div>
    </li>

    <li>
      <img src=\"assets/gordan-mad.jpg\" alt=\"Grodan Ramsey mad\" />
      <div class=\"card-content\">
        <h3 class=\"card-title\">Pay</h3>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Architecto molestiae consectetur iusto aut eos modi ipsa et
          obcaecati explicabo deleniti?
        </p>
      </div>
    </li>
  </ul>
</section>
<section id=\"section-c\">
  <div class=\"content-wrap\">
    <h2 class=\"content-title\">Students With Talent</h2>
    <div class=\"content-text\">
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis
        veritatis rem fuga ipsum, nostrum laboriosam doloremque error
        magnam, qui provident.
      </p>
    </div>
  </div>
</section>
</main>
</div>
";
include 'footer.php';
?>