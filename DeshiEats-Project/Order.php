<?php
session_start();

include("connect.php");
include("functions.php");

if(isset($_SESSION["ID"])){
    $user_id=$_SESSION["ID"];
    $query="SELECT * FROM orderlist o join cartlist c  ON c.OrderID = o.OrderID WHERE o.CustomerID=".$user_id;
    $resultset = mysqli_query($link, $query);
    
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

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="css/DeStylesheet2.css" />


    <title>Desh-eats_ChefOrderStatus_Page</title>

</head>

<body>



      <?php

        include "header.php" ;
        
      ?>



        <div class="contents">    
            <div class="container userprofileform">

                <div class="row userprofileformrow">
                    <!--image container div-->

                    <div class="col-11 userprofiledit ">
                        <div class="userprofileheading mt-4">
                            <p class="userprofileheadinguser"><?php echo $_SESSION["uName"]; ?>, Your Order history:</p>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <table class="table table-bordered ordertable">
                            <thead>
                                <tr class="text-align-center">
                                    <th hidden scope="col" class="orderhead">Order No.</th>
                                    <th scope="col" class="orderhead">Item Name</th>
                                    <th scope="col" class="orderhead">Total Price</th>
                                    <th scope="col" class="orderhead">Address</th>
                                    <th scope="col" class="orderhead">Status</th>
                                    <th scope="col" class="orderhead">Delivery date</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php 
                                while($row=mysqli_fetch_assoc($resultset)){
                                ?>
                                <tr>
                                    <td hidden class='orderdatas'><?php echo $row['OrderID']; ?></td>
                                    <td class='orderdatas'><?php echo $row['ItemName']; ?></td>
                                    <td class='orderdatas'><?php echo $row['TotalPrice'];   ?></td>
                                    <td class='orderdatas'><?php echo $row['OrderAddress'];     ?></td>
                                    <td class='orderdatas'><?php echo $row['CartStatus'];       ?></td>
                                    <td class='orderdatas'><?php echo $row['DeliveryDate'];       ?></td>
                                </tr>
                                <?php 
                                }
                                ?>
                                <?php

                                //********Backend e help lagle php code rakhis naile delete korish********
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $key => $value) {
                                        $serial = $key + 1;

                                        //print_r($key);
                                        echo "
                                <tr>
                                <td class='orderdatas'></td>
                                <td class='orderdatas'></td>
                                <td class='orderdatas'></td>
                                <td class='orderdatas'></td>
                                <td class='orderdatas'></td>
                                </tr> 
                                ";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>


            </div>
        </div>

    <!--</div>-->

    <?php
          include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>