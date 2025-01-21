<?php
session_start();
include("connect.php");
include("functions.php");
if (isset($_SESSION["ID"])) {
  if ($_SESSION["type"] == "customer") {
?>
    <script type="text/javascript">
      alert("Invalid user");
      window.location.href = "Index.php"
    </script>
  <?php
  }
} else {
  ?>
  <script type="text/javascript">
    alert("User needs to be logged In");
    window.location.href = "Login.php"
  </script>
  <?php
}

$sqlItem = "SELECT * FROM item where OwnerID=" . $_SESSION["ID"];
$resultItem = mysqli_query($link, $sqlItem);

if (isset($_GET["id"])) {
  $item = $_GET["id"];
  if (removeItems($link, $item)) {

  ?>
    <script type="text/javascript">
      alert("Item Removed.");
      window.location.href = 'DeleteItems.php'
    </script>
  <?php

  } else {
  ?>
    <script type="text/javascript">
      alert("Error!Item not removed check the remove function");
      window.location.href = 'DeleteItems.php'
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
  <title>Deshieats_DeleteItems_Page</title>
</head>

<body>
  <?php
  include "header.php";
  ?>
  <div class="contents">
    <div class="container">
      <div class="row">
        <?php
        while ($rowItem = mysqli_fetch_assoc($resultItem)) {
        ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 menuall">
            <div class="Items">
              <img src="<?php echo $rowItem["ItemImage"] ?>">
              <div class="allthings">
                <p class="itemheading"><?php echo $rowItem["ItemName"] ?></p>
                <p class="itemdes"><?php echo $rowItem["ShortDescription"] ?></p>
                <p class="addalliconsp"><?php echo $rowItem["Price"] ?>/=</p>
              </div>
              <button class="addtocart" onclick="location.href='DeleteItems.php?id=<?php echo $rowItem['ItemID'] ?>'">
                <p class="">Delete</p>
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </div>

        <?php
        } ?>

        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 menuall">
                <div class="Items">
                    <img src="images/Menu/food2.jpg">
                        <div class="allthings">
                                <p class="itemheading">Ham Burger<p>
                                <p class="itemdes">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam perspiciatis doloribus o</p>
                                <div class="add">
                                    <p class="addalliconsp">200.00/=</p>
                                </div>
                                <button class="addtocart">
                                  <p class="">Delete</p>
                                  <i class="fas fa-trash-alt"></i>
                                </button>
                        </div>
                </div>
            </div> -->
      </div>
    </div>

  </div>
  </div>


  <?php
  include "footer.php";
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>