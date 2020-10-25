<body>
  <nav id="navbar-custom" class="navbar navbar-expand-lg navbar-light bg-custom sticky-top">
    <a class="navbar-brand" href="">
      <h4>WP</h4>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto h4">
        <?php
        switch ($page_name) {
          case "menu":
            echo '<li class="nav-item active">
            <a class="nav-link" href="#">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Make Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">View Basket</a>
          </li>';
            break;
          case "make_order":
            echo '<li class="nav-item">
            <a class="nav-link" href="#">Menu</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Make Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">View Basket</a>
          </li>';
            break;
          case "view_basket":
            echo '<li class="nav-item">
            <a class="nav-link" href="#">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Make Order</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">View Basket</a>
          </li>';
            break;
          case "confirm_order":
            echo '<li class="nav-item">
              <a class="nav-link" href="#">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Make Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">View Basket</a>
            </li>';
            break;
        }
        ?>
      </ul>
    </div>
  </nav>