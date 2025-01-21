<?php
session_start();

include("connect.php");

$price = 0;
$count = 0;

if(!isset($_SESSION['cart']))
{
    echo "<script>
            alert('No item in cart');
            window.location.href='Menu.php';
            </script>";
}
if (isset($_SESSION['ID'])) {
    $user_id = $_SESSION['ID'];
    $namesql = "SELECT * FROM CUSTOMER WHERE CustID= ".$user_id;
    $nameresult = mysqli_query($link,$namesql);
    $nameUser = mysqli_fetch_assoc($nameresult);
}else{
    echo "<script>
            alert('User needs to log in');
            window.location.href='Menu.php';
            </script>";
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Something was posted


    if (isset($_SESSION['ID'])) {
        $user_id = $_SESSION['ID'];

    }
    
    //$name =  $_POST['username'];
    //$contact = $_POST['usercontact'];
    $useraddress = $_POST['useraddress'];
    //$usermessage = $_POST['usermessage'];
    $finalTotal = $_POST['finalTotal'];
    $stats = "Pending";

    //echo $user_id . " " . $contact . " " . $useraddress . " " . $usermessage . " " . $finalTotal;

    $i = 1;
    $ItemNames = "";
    foreach ($_SESSION['cart'] as $x => $z) {

        $ItemNames .= $i . ". " . $z['Item_name'] . "<br>";
        $i++;

        //$Query1="INSERT INTO cartlist(ID, OrderID, ItemName, Quantity, TotalPrice) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])";

    }

    $date = date('Y-m-d', strtotime('+7 days'));
    // echo $date;
    $instruction = $_POST['paymentSystem'];

    if (!empty($user_id) && !empty($useraddress) &&  !empty($finalTotal) && !empty($ItemNames)) {
        $Query="INSERT INTO orderlist(CustomerID, OrderAddress, OrderStatus, OrderPrice, DeliveryDate, DeliveryInstruction) VALUES ('$user_id','$useraddress','$stats','$finalTotal','$date','$instruction')";
        


        if (mysqli_query($link, $Query)) {
            //unset($_SESSION['cart']);
            echo "<script>
            alert('Checked out');
            //window.location.href='Menu.php';
            </script>";

            $Query2 = "SELECT * FROM orderlist ORDER BY OrderID DESC LIMIT 1";
            $result = mysqli_query($link, $Query2);
            $row = mysqli_fetch_assoc($result);
            $orderID = $row['OrderID'];

            foreach ($_SESSION['cart'] as $x => $z) {

                $item = $z['Item_name'];
                $qty = $z['Quantity'];
                
                (float)$price = (float)$z['Item_price'] * (float)$z['Quantity'];

                $Query3 = "INSERT INTO cartlist(OrderID, ItemName, Quantity, TotalPrice,CartStatus) VALUES ('$orderID','$item','$qty','$price','Pending')";
                //echo $Query3;
                mysqli_query($link, $Query3);
            }
            unset($_SESSION['cart']);
        } else {
            unset($_SESSION['cart']);
            echo "<script>
            alert('Error!');
            //window.location.href='Menu.php';
            </script>";
        }
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

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="css/DeStylesheet2.css" />


    <title>Desh-eats_MyCart_Page</title>

</head>

<body>


    <?php
    include "header.php";
    ?>


    <div class="container">

        <div class="row allorders">
            <!--image container div-->

            <div class="col-11 userprofiledit ">
                <div class="userprofileheading mt-4">
                    <p class="userprofileheadinguser"><?php echo $nameUser["CustName"]?>, Your Cart:</p>
                </div>
            </div>
            <div class="col-xl-12">
                <table class="table table-bordered ordertable">
                    <thead>
                        <tr class="text-align-center">
                            <th scope="col" class="orderhead">Item No.</th>
                            <th scope="col" class="orderhead">Item Name and Description</th>
                            <th scope="col" class="orderhead">Base Price</th>
                            <th scope="col" class="orderhead">Quantity</th>
                            <th scope="col" class="orderhead">Total Price</th>
                            <th scope="col" class="orderhead">Remove</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
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
                                <td class='orderdatas'>$value[Item_price]<input type='hidden' class='iprice' value='$value[Item_price]'/></td>
                                <td class='orderdatas'>
                                    <input class='text-center iquantity' onchange='subTotal()' type='number' name='Quantity' value='$value[Quantity]' min='1' max= '20'/>
                                </td>
                                <td class='itotal orderdatas'></td>
                                <td>
                                  <form action='ManageCart.php' method='POST'>
                                    <button name='Remove_Item' class='plusMinusButton'> REMOVE </button>
                                    <input type='hidden' class='iquantity' name='Quantity' value='$value[Quantity]'>
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


            <form action="" method="POST">



                <div class="col-xl-12">
                    <div class="mb-3 orderdatas">
                        <label class="mb-2 orderhead">Enter Address</label>
                        <textarea name="useraddress" placeholder="Enter your full address" class="form-control"> </textarea>
                        <br>
                        Cash on Delivery <input type="radio" name="paymentSystem" value="Cash On Delivery">
                        <br>
                        Digital Payment <input type="radio" name="paymentSystem" value="Digital Payment">
                    </div>
                </div>
                
                <div class="col-xl-12" style="display:none">
                    <div class=" mb-3">
                    <label class="mb-2 orderhead">Contact Number</label>
                    <input type="text" placeholder="Enter your contact number" id="finalTotal" name="finalTotal" value="" class="form-control" />
                    </div>
                </div>

                <div class="col-xl-12 ">
                    <div class="border bd-light rounded p-4 orderdatas d-flex flex-column align-items-center totalbox">
                        <h5>Grand Total:</h5>
                        <h3 class="text-center orderdatas" id="gtotal" name="finalTotal"></h3>
                        <br>
                        <button type="submit" name="submitButton" class="orderButton" onclick="">Confirm Order</button>
                    </div>
                </div>
            </form>

        </div>


    </div>

    <?php
    include "footer.php";
    ?>



    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        var gt = 0;
        var iprice = document.getElementsByClassName('iprice');
        var iquantity = document.getElementsByClassName('iquantity');
        var itotal = document.getElementsByClassName('itotal');
        var gtotal = document.getElementById('gtotal');

        function subTotal() {


            gt = 0;
            for (i = 0; i < iprice.length; i++) {
                itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
                gt = gt + (iprice[i].value) * (iquantity[i].value);
            }
            gtotal.innerText = gt;
            var finalTotal = document.getElementById('gtotal').innerHTML;
            document.getElementById('finalTotal').value = finalTotal;
            console.log(finalTotal);



        }


        subTotal();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>









</html>