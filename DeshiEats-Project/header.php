<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand disabled navlogo">
          <img src="images/Login/deshi.png">
        </a>

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">



          <!-- <li class="nav-item">
                    <a class="nav-link navwrite" href="Menu.php">Menu</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link navwrite" href="#">Order</a>
                  </li> -->
          <?php
          if (isset($_SESSION['ID'])) {
            if ($_SESSION['type'] == "customer") {
              echo "<li class='nav-item'>
                         <a class='nav-link navwrite' aria-current='page' href='Index.php'>Home</a>
                       </li>";
              echo "<li class='nav-item'><a class='nav-link navwrite' href='Menu.php'>Menu</a>
                      </li>
                      <li class='nav-item'><a class='nav-link navwrite' href='Order.php'>Order</a>
                      </li>
                      <li class='nav-item'><a class='nav-link navwrite' href='Contact.php'>Contact Us</a>
            </li>";
              // echo "<li class='nav-item'><a class='nav-link navwrite' href='ChefProfile.php'>Profile</a></li>";
              // echo "<li class='nav-item'><a class='nav-link' href='logOut.php'><i class='fas fa-sign-out-alt ico'></i></a></li>";
            } elseif ($_SESSION['type'] == "chef") {
          ?><li class='nav-item'><a class='nav-link navwrite' href="Chef'sExhibition.php">Exhibition</a></li>
              <li class='nav-item'><a class='nav-link navwrite' href='ChefOrderStatus.php'>Chef's Order</a>
              </li>
              <li class='nav-item'><a class='nav-link navwrite' href='Contact.php'>Contact Us</a>
              </li><?php
                    // echo "<li class='nav-item'><a class='nav-link' href='logOut.php'><i class='fas fa-sign-out-alt ico'></i></a></li>";
                  } elseif ($_SESSION['type'] == "Admin") {
                    ?><li class='nav-item'>
                <a class='nav-link navwrite' href="AdminPanel.php">Admin Panel</a>
              </li>
          <?php
                  }
                } else {
                  //  echo "<li class='nav-item'><a class='nav-link navwrite' href='Register.php'>Register</a></li>";
                  //  echo "<li class='nav-item'><a class='nav-link navwrite' href='Login.php'>Login</a></li>";
                  echo "<li class='nav-item'>
                         <a class='nav-link navwrite' aria-current='page' href='Index.php'>Home</a>
                       </li>
                       <li class='nav-item'><a class='nav-link navwrite' href='Contact.php'>Contact Us</a>
            </li>";
                }
          ?>
          <!-- <li class="nav-item">
                    <a class="nav-link navwrite" href="#">About</a>
                  </li> -->
          <!-- <li class="nav-item">
                    <a class="nav-link navwrite" href="#">Devs Corner</a>
                  </li> -->

        </ul>
        <ul class="navbar-nav  " style="float:right !important">
          <?php
          if (isset($_SESSION['ID'])) {
            if ($_SESSION['type'] == "chef") {
              echo "<li class='nav-item'><a class='nav-link navwrite' href='ChefProfile.php'><i class='fas fa-user ico'></i></a></li>";
              //echo "<li class='nav-item'><a class='nav-link' href='logOut.php'><i class='fas fa-sign-out-alt ico'></i></a></li>";
            } else if ($_SESSION['type'] == "customer") {
              echo "<li class='nav-item'><a class='nav-link' href='MyCart.php'><i class='fas fa-shopping-cart icons ico'></i></a></li>";
              echo "<li class='nav-item'><a class='nav-link navwrite' href='CustomerProfile.php'><i class='fas fa-user ico'></i></a></li>";
              //echo "<li class='nav-item'><a class='nav-link' href='logOut.php'><i class='fas fa-sign-out-alt ico'></i></a></li>";
            } else if ($_SESSION['type'] == "Admin") {
            }
            echo "<li class='nav-item'><a class='nav-link' href='logOut.php'><i class='fas fa-sign-out-alt ico'></i></a></li>";
          } else {
            echo "<li class='nav-item'><a class='nav-link navwrite' href='Register.php'>Register</a></li>";
            echo "<li class='nav-item'><a class='nav-link navwrite' href='Login.php'>Login</a></li>";
          }
          ?>
          <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user ico"></i></a>
                      </li> -->
          <!-- <li class='nav-item'><a class='nav-link' href='logOut.php'><i class='fas fa-sign-out-alt ico'></i></a></li> -->
        </ul>
      </div>
    </div>
  </nav>





</header>