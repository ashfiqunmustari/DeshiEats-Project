<?php
session_start();
include("connect.php");
include("functions.php");
$itemsql =  "SELECT * FROM item ORDER BY RAND() LIMIT 4";
$itemresults = mysqli_query($link, $itemsql);
$chefsql = "SELECT * FROM chef ORDER BY RAND() LIMIT 3";
$chefresults = mysqli_query($link, $chefsql);
$reviewsql = "SELECT * From reviews r join  item i  on  r.ItemID=i.ItemID join customer c on r.CustomerID=c.CustID ORDER BY RAND() LIMIT 3";
$reviewresult = mysqli_query($link, $reviewsql);
if (isset($_SESSION["ID"])) {
  if ($_SESSION['type'] == "chef") {
?>
    <script type="text/javascript">
      alert("Invalid user");
      window.location.href = "Chef'sExhibition.php"
    </script>
<?php
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <link type="text/css" rel="stylesheet" href="css/DeStylesheet.css" />


  <title>DeshiEats Home</title>

</head>

<body>

  <?php
  include "header.php";
  ?>

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/Slide/Slide3.jpg" class="d-block w-100 caroimg" alt="...">
        <div class="container carousel-caption d-block d-md-block">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-8 slidedes">
              <p class="Slidehead">Welcome to DeshiEats</p>
              <p class="Slidepara">Here you get to taste authentic cuisines of every region of Bangladesh and share the love for home-cooked meals just in one platform!</p>
              <div class=" viewmore ordernow">
                <p class="">ORDER NOW</p>
                <i class="fas fa-long-arrow-alt-right orderarrow"></i>
                <a href="Menu.php" style="text-decoration: none;" class="stretched-link"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/Slide/Slide2.jpg" class="d-block w-100 caroimg" alt="...">
        <div class="container carousel-caption d-block d-md-block">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-8 slidedes">
              <p class="Slidehead">Own a Kitchen Today!</p>
              <p class="Slidepara">Would you like millions of new customers to enjoy your amazing food? So would we! It's simple: we list your menu online, help you process orders, pick them up, and deliver them in a heartbeat! You prepare the food, we handle the rest!</p>
              <div class="viewmore ordernow">
                <p class="">ORDER NOW</p>
                <i class="fas fa-long-arrow-alt-right orderarrow"></i>
                <a href="Menu.php" style="text-decoration: none;" class="stretched-link"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/Slide/Slide1.jpg" class="d-block w-100 caroimg" alt="...">
        <div class="container carousel-caption d-block d-md-block">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-8 slidedes">
              <p class="Slidehead">Best Service at your Doorstep...</p>
              <p class="Slidepara">Order food online the easy way with DeshiEats. Whether you're too tired to cook, craving fast food favourites or looking to try different cuisines, we will deliver them to your doorstep in a heartbeat! </p>
              <div class=" viewmore ordernow">
                <p class="">ORDER NOW</p>
                <i class="fas fa-long-arrow-alt-right orderarrow"></i>
                <a href="Menu.php" style="text-decoration: none;" class="stretched-link"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="contents">

    <p class="food">Our Foods</p>

    <div class="container">
      <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($itemresults)) { ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 menuall">
            <div class="Items">
              <a href="ProductPage.php?ProductID=<?php echo $row["ItemID"] ?>" style="text-decoration: none;">
                <img src="<?php echo $row["ItemImage"] ?>">
                <div class="allthings">
                  <p class="itemheading"><?php echo $row["ItemName"] ?>
                  <p>
                  <p class="itemdes"><?php echo $row["ShortDescription"] ?></p>
                  <div class="add">
                    <p class="addalliconsp"><?php echo $row["Price"] ?>/=</p>
              </a>
              <div class="addall">
                <button class="minusplus">
                  <i class="addallicons fas fa-minus quantity"></i>
                </button>
                <p class="addalliconsp">1</p>
                <button class="minusplus">
                  <i class="addallicons fas fa-plus"></i>
                </button>
              </div>
            </div>
            <button class="addtocart">
              <p class="">ADD TO CART</p>
              <i class="fas fa-shopping-cart"></i>
            </button>
          </div>
      </div>
    </div>
  <?php
        }
  ?>
  <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 menuall">
                    <div class="Items">
                        <img src="images/Menu/Food10.jpg">
                            <div class="allthings">
                                    <p class="itemheading">Ham Burger<p>
                                    <p class="itemdes">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam perspiciatis doloribus o</p>
                                    <div class="add">
                                        <p class="addalliconsp">200.00/=</p>
                                            <div class="addall">
                                              <button class="minusplus">
                                                <i class="addallicons fas fa-minus quantity"></i>
                                              </button>
                                                <p class="addalliconsp">1</p>
                                                <button class="minusplus">
                                                  <i class="addallicons fas fa-plus"></i>
                                                </button>
                                            </div>
                                    </div>
                                    <button class="addtocart">
                                      <p class="">ADD TO CART</p>
                                      <i class="fas fa-shopping-cart"></i>
                                    </button>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 menuall">
                  <div class="Items">
                      <img src="images/Menu/Food12.jpg">
                          <div class="allthings">
                                  <p class="itemheading">Ham Burger<p>
                                  <p class="itemdes">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam perspiciatis doloribus o</p>
                                  <div class="add">
                                      <p class="addalliconsp">200.00/=</p>
                                          <div class="addall">
                                            <button class="minusplus">
                                              <i class="addallicons fas fa-minus quantity"></i>
                                            </button>
                                              <p class="addalliconsp">1</p>
                                              <button class="minusplus">
                                                <i class="addallicons fas fa-plus"></i>
                                              </button>
                                          </div>
                                  </div>
                                  <button class="addtocart">
                                    <p class="">ADD TO CART</p>
                                    <i class="fas fa-shopping-cart"></i>
                                  </button>
                          </div>
                  </div>
              </div>
              <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 menuall">
                <div class="Items">
                    <img src="images/Menu/food2.jpg">
                        <div class="allthings">
                                <p class="itemheading">Ham Burger<p>
                                <p class="itemdes">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam perspiciatis doloribus o</p>
                                <div class="add">
                                    <p class="addalliconsp">200.00/=</p>
                                        <div class="addall">
                                          <button class="minusplus">
                                            <i class="addallicons fas fa-minus quantity"></i>
                                          </button>
                                            <p class="addalliconsp">1</p>
                                            <button class="minusplus">
                                              <i class="addallicons fas fa-plus"></i>
                                            </button>
                                        </div>
                                </div>
                                <button class="addtocart">
                                  <p class="">ADD TO CART</p>
                                  <i class="fas fa-shopping-cart"></i>
                                </button>
                        </div>
                </div>
            </div> -->
  <a href="Menu.php" style="text-decoration: none;">
    <button class="viewmore">
      <p class="">VIEW MORE</p>
      <i class="fas fa-long-arrow-alt-right arrow"></i>
    </button>
  </a>


  </div>

  <div class="container">

    <p class="food mb-5">Our Expert Chefs</p>

    <div class="row">
      <?php
      while ($row = mysqli_fetch_assoc($chefresults)) { ?>
        <div class=" col-sm-6 col-md-6 col-lg-4 col-xl-4 cheffall">
        <?php
          if (!empty($row["ChefImage"])) {
          ?>
            <img src="<?php echo $row["ChefImage"] ?>">
          <?php
          } else { ?>
            <img src="images/profile.png">
          <?php
          }
          ?>
          <div class="cheffdeatails ml-31">
            <p class="cheffname"><?php echo $row["ChefName"] ?>
            <p>
            <p class="cheffdes"><?php echo $row["ChefDescription"] ?></p>
            <a href="CustomerChefView.php?chefID=<?php echo $row["ChefID"]?>" style="text-decoration: none;">
              <button class="visitmenu">
                <p>Visit Menu-></p>
              </button>
            </a>

          </div>
        </div>
      <?php
      }
      ?>
      <!-- <div class=" col-sm-6 col-md-6 col-lg-4 col-xl-4 cheffall">
                <img src="images/Menu/food2.jpg">
                  <div class="cheffdeatails ml-31">
                      <p class="cheffname">Courtney Lapresi<p>
                      <p class="cheffdes">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam perspiciatis doloribus o</p>
                      <button class="visitmenu">
                        <p>Visit Menu-></p>
                      </button>
                  </div>
               </div>
  
               <div class=" col-sm-6 col-md-6 col-lg-4 col-xl-4 cheffall">
                <img src="images/Menu/food2.jpg">
                  <div class="cheffdeatails ml-31">
                      <p class="cheffname">Gerron Hurt<p>
                      <p class="cheffdes">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam perspiciatis doloribus o</p>
                      <button class="visitmenu">
                        <p>Visit Menu-></p>
                      </button>
                  </div>
               </div> -->
    </div>

  </div>

  <div class="container">
    <p class="food mt-5">What our Customers Say</p>
    <div class="row">
      <?php
      while ($row = mysqli_fetch_assoc($reviewresult)) { ?>
        <div class="col-xl-4">
          <div class="Reviewitems">
            <img src="<?php echo $row["ItemImage"] ?>" class="rounded-circle">
            <p class="Reviewitemsname"><?php echo $row["CustName"] ?></p>
            <p class="Reviewitemsdes"><?php echo $row["Message"] ?></p>
            <p class="">

          </div>
        </div>
      <?php
      }
      ?>
      <!-- <div class="col-xl-4">
                      <div class="Reviewitems">
                          <img src="images/Menu/Food10.jpg" class="rounded-circle">
                          <p class="Reviewitemsname">Sanjay Mondol</p>
                          <p class="Reviewitemsdes">"Halar putera bal banay amrrrr......."</p>
                      </div>
                  </div>
                  <div class="col-xl-4">
                      <div class="Reviewitems">
                          <img src="images/Menu/Food9.jpeg" class="rounded-circle">
                          <p class="Reviewitemsname">Sanjay Mondol</p>
                          <p class="Reviewitemsdes">"Halar putera bal banay amrrrr......."</p>
                      </div>
                  </div> -->
    </div>
  </div>

  </div>

  <?php
  include "footer.php";
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>