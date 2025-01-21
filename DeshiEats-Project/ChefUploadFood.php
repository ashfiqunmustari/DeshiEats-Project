<?php 
    
    session_start();
    include("connect.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_SESSION['ID'])){
        if(isset($_FILES['Img'])){
            $itemName=$_POST['itemname'];
            $itemShortDesc=$_POST['itemshortdes'];
            $itemDesc=$_POST['itemdes'];
            $itemQuantity=$_POST['itemquan'];
            $itemPrize=$_POST['itemprize'];
            //$itemImg=$_POST['itemImg'];
            $itemOwner=$_SESSION['ID'];
            
            $destination="images/FoodImg/$itemOwner";
            $destination_file="";
    

            $destination_file=$destination.basename($_FILES['Img']['name']);
            move_uploaded_file($_FILES['Img']['tmp_name'],$destination_file);
    
            $itemImg=$destination_file;              
            
            if(chefAddItem($link,$itemOwner,$itemName,$itemShortDesc,$itemDesc,$itemQuantity,$itemPrize,$itemImg)){
                ?>
                <script type="text/javascript">
                alert("Food Added!");
                window.location.href = "ChefUploadFood.php"
                </script>
                <?php
            
            }else{
                ?>
                <script type="text/javascript">
                alert("Error! Not added");
                window.location.href = "ChefUploadFood.php"
                </script>
                <?php
            }
        }else{
            ?>
                <script type="text/javascript">
                alert("Image not found");
                window.location.href = "ChefUploadFood.php"
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

        <link type="text/css" rel="stylesheet" href="css/DeStylesheet.css"/>
        
        <title>Deshieats_ChefUploadMenu_Page</title>

    </head>

    <body>


    <?php
      include "header.php" ;
    ?>


          <div class="contents">
                <div class="container">
                    <div class="row rowbg pt-3 pb-3 mb-5">
                        <div class="col-12 .col-sm-12 col-lg-2 .col-md-2 col-xl-6">
                            <div class="upload">
                                    <img src ="images/Menu/food4.jpg" height = 150 width = 150 alt="">
                                    <div class="round">
                                      <input type="file" name="Img" >
                                      <i class="fas fa-camera" style="color:aliceblue"></i>
                                    </div> 
                            </div>
                          </div>
                        <div class="col-12 .col-sm-12 col-lg-6 .col-md-6 col-xl-6 formbox">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="formbox">
                                    <p class="dont">Upload some delicious food</p>
                                </div>
                                <div class="form-group formbox mb-3"> 
                                    <label class="mb-3 formlabel">Name</label>
                                    <input type="text" placeholder="" name="itemname" value="" class="form-control" />
                                </div>
                                <div class="form-group formbox mb-3"> 
                                    <label class="mb-3 formlabel">Short Description</label>
                                    <input type="text" placeholder="" name="itemshortdes" value="" class="form-control" />
                                </div>
                                <div class="form-group formbox mb-3"> 
                                    <label class="mb-3 formlabel">Description</label>
                                    <input type="text" placeholder="" name="itemdes" value="" class="form-control" />
                                </div>
                                <div class="form-group formbox mb-3"> 
                                    <label class="mb-3 formlabel">Quantity</label>
                                    <input type="number" placeholder="" name="itemquan" value="" class="form-control" />
                                </div>
                                <div class="form-group formbox mb-3"> 
                                    <label class="mb-3 formlabel">Prize</label>
                                    <input type="text" placeholder="Set prize" name="itemprize" value="" class="form-control mb-2" />
                                </div>
                                <div class="round">
                                      <input type="file" name="Img" >
                                      <i class="fas fa-camera" style="color:aliceblue"></i>
                                </div>
                                <div class="formbox formbuto mb-3"> 
                                    <input type="submit" name="Signin" value="+ ADD ITEM" class="btn" />
                                </div>
                            </form>
                        </div>
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
