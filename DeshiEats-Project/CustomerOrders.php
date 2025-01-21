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


    <title>Desh-eats_CustomerOrders_Page</title>

</head>

<body>


      <?php
        include "header.php" ;
      ?>

    <div class="container userprofileform">

        <div class="row userprofileformrow">
            <!--image container div-->

            <div class="col-11 userprofiledit ">
                <div class="userprofileheading mt-4">
                    <p class="userprofileheadinguser">#Name, Your Order History:</p>
                </div>
            </div>
            <div class="col-xl-12">
                <table class="table table-bordered ordertable">
                    <thead>
                        <tr class="text-align-center">
                            <th scope="col" class="orderhead">Order No.</th>
                            <th scope="col" class="orderhead">Item Name</th>
                            <th scope="col" class="orderhead">Base Price</th>
                            <th scope="col" class="orderhead">Quantity</th>
                            <th scope="col" class="orderhead">Pending Status</th>
                            <th scope="col" class="orderhead">Cancel Order</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td class='orderdatas'>1</td>
                            <td class='orderdatas'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, porro quibusdam. Doloribus cupiditate vitae similique numquam accusamus quam, odit est repudiandae itaque aliquid saepe amet iure deserunt harum odio beatae.</td>
                            <td class='orderdatas'>12</td>
                            <td class='orderdatas'>1</td>
                            <td class='orderdatas'>Delivered</td>
                            <td>
                                <form action='ManageCart.php' method='POST'>
                                    <button name='Remove_Item' class='plusMinusButton'> Cancel </button>
                                    <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td class='orderdatas'>2</td>
                            <td class='orderdatas'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, porro quibusdam. Doloribus cupiditate vitae similique numquam accusamus quam, odit est repudiandae itaque aliquid saepe amet iure deserunt harum odio beatae.</td>
                            <td class='orderdatas'>1</td>
                            <td class='orderdatas'>10</td>
                            <td class='orderdatas'>Pending</td>
                            <td>
                                <form action='ManageCart.php' method='POST'>
                                    <button name='Remove_Item' class='plusMinusButton'> Cancel </button>
                                    <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td class='orderdatas'>2</td>
                            <td class='orderdatas'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, porro quibusdam. Doloribus cupiditate vitae similique numquam accusamus quam, odit est repudiandae itaque aliquid saepe amet iure deserunt harum odio beatae.</td>
                            <td class='orderdatas'>1</td>
                            <td class='orderdatas'>10</td>
                            <td class='orderdatas'>Received</td>
                            <td>
                                <form action='ManageCart.php' method='POST'>
                                    <button name='Remove_Item' class='plusMinusButton'> Cancel </button>
                                    <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                </form>
                            </td>
                        </tr>
                        <?php

                        //********Backend e help lagle php code rakhis naile delete korish********
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $serial = $key + 1;

                                //print_r($key);
                                echo "
                                <tr>
                                <td class='orderdatas'>$serial</td>
                                <td class='orderdatas'>$value[Item_name]</td>
                                <td class='orderdatas'>$value[Item_price]<input type='hidden' class='iprice' value='$value[Item_price]'</td>
                                <td class='orderdatas'>
                                    <input class='text-center iquantity' onchange='subTotal()' type='number' value='$value[Quantity]' min='1' max= '20'>
                                </td>
                                <td class='itotal orderdatas'></td>
                                <td>
                                  <form action='ManageCart.php' method='POST'>
                                    <button name='Remove_Item' class='plusMinusButton'> REMOVE </button>
                                    <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                  </form>
                                </td>
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


    <?php
      include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>









</html>