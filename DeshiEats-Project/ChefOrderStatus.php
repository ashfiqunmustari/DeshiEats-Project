<?php
session_start();
include("connect.php");
include("functions.php");
if (isset($_SESSION['ID'])) {
    $user_id = $_SESSION['ID'];
    $namesql = "SELECT * FROM Chef WHERE ChefID= " . $user_id;
    $nameresult = mysqli_query($link, $namesql);
    $nameUser = mysqli_fetch_assoc($nameresult);
} else {
    echo "<script>
            alert('User needs to log in');
            window.location.href='Menu.php';
            </script>";
}
$tablesql = "SELECT * FROM orderlist o JOIN cartlist c ON o.OrderID=c.OrderID JOIN item i ON c.ItemName = i.ItemName JOIN chef ch ON i.OwnerID = ch.ChefID WHERE ch.ChefID = " . $_SESSION["ID"];
$tableresult = mysqli_query($link, $tablesql);

if (isset($_GET["approveid"])) {
    $item = $_GET["approveid"];
    if (setApprove($link, $item)) {

?>
        <script type="text/javascript">
            alert("Order Approved.");
            window.location.href = 'ChefOrderStatus.php'
        </script>
    <?php

    } else {
    ?>
        <script type="text/javascript">
            alert("Error!Order not approved check the approved function");
            window.location.href = 'ChefOrderStatus.php'
        </script>
    <?php
    }
}
if (isset($_GET["cancelid"])) {
    $item = $_GET["cancelid"];
    if (setCancel($link, $item)) {

    ?>
        <script type="text/javascript">
            alert("Order Cancelled.");
            window.location.href = 'ChefOrderStatus.php'
        </script>
    <?php

    } else {
    ?>
        <script type="text/javascript">
            alert("Error!Order not canclled check the cancel function");
            window.location.href = 'ChefOrderStatus.php'
        </script>
<?php
    }
}

if (isset($_GET["deliverid"])) {
    $item = $_GET["deliverid"];
    if (setDeliver($link, $item)) {

    ?>
        <script type="text/javascript">
            alert("Ready to deliver.");
            window.location.href = 'ChefOrderStatus.php'
        </script>
    <?php

    } else {
    ?>
        <script type="text/javascript">
            alert("Error!Order not deliver check the deliver function");
            window.location.href = 'ChefOrderStatus.php'
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

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/DeStylesheet.css" />
    <link type="text/css" rel="stylesheet" href="css/DeStylesheet2.css" />


    <title>Desh-eats_Chef, Your Orders!!!</title>

</head>

<body>



    <?php

    include "header.php";

    ?>



    <div class="contents">
        <div class="container userprofileform">

            <div class="row userprofileformrow">
                <!--image container div-->

                <div class="col-11 userprofiledit ">
                    <div class="userprofileheading mt-4">
                        <p class="userprofileheadinguser"><?php echo $nameUser["ChefName"] ?>, Your Pending Orders:</p>
                    </div>
                </div>
                <div class="col-xl-12">
                    <table class="table table-bordered ordertable">
                        <thead>
                            <tr class="text-align-center">
                                <!-- <th scope="col" class="orderhead">Order No.</th> -->
                                <th scope="col" class="orderhead">Item Name</th>
                                <th scope="col" class="orderhead">Delivery Date</th>
                                <th scope="col" class="orderhead">Price</th>
                                <th scope="col" class="orderhead">Status</th>
                                <th scope="col" class="orderhead" colspan="2">Cancel/Approve</th>
                                <th scope="col" class="orderhead">Approve Delivery</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            while ($tableRow = mysqli_fetch_assoc($tableresult)) {
                            ?>
                                <tr>
                                    <td class='orderdatas'><?php echo $tableRow["ItemName"] ?></td>
                                    <td class='orderdatas'><?php echo $tableRow["DeliveryDate"] ?></td>
                                    <td class='orderdatas'><?php echo $tableRow["TotalPrice"] ?></td>
                                    <td class='orderdatas'><?php echo $tableRow["CartStatus"] ?></td>
                                    <!-- <td class='orderdatas'>Delivered</td> -->
                                   
                                        <?php if ($tableRow["CartStatus"] == "Pending") { ?>
                                            <td>
                                            <button name="OrderApproved" class="cartButton" onclick="location.href='ChefOrderStatus.php?approveid=<?php echo $tableRow['ID'] ?>'">Approve</button>
                                            </td>
                                            <td>
                                            <button name="OrderCancel" class="cartButton" onclick="location.href='ChefOrderStatus.php?cancelid=<?php echo $tableRow['ID'] ?>'">Cancel</button>
                                            </td>
                                        <?php }else{?>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                        <?php
                                        }
                                        if($tableRow["CartStatus"] == "Approved"){ ?>
                                            <td>
                                            <button name="OrderDeliver" class="cartButton" onclick="location.href='ChefOrderStatus.php?deliverid=<?php echo $tableRow['ID'] ?>'">Ready to deliver</button>
                                            </td>
                                        <?php
                                        } ?>

                                    
                                </tr>
                            <?php
                            }
                            ?>

                            <!-- <tr>
                                    <td class='orderdatas'>2</td>
                                    <td class='orderdatas'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, porro quibusdam. Doloribus cupiditate vitae similique numquam accusamus quam, odit est repudiandae itaque aliquid saepe amet iure deserunt harum odio beatae.</td>
                                    <td class='orderdatas'>1</td>
                                    <td class='orderdatas'>10</td>
                                    <td class='orderdatas'>Pending</td>
                                </tr>
                                <tr>
                                    <td class='orderdatas'>2</td>
                                    <td class='orderdatas'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, porro quibusdam. Doloribus cupiditate vitae similique numquam accusamus quam, odit est repudiandae itaque aliquid saepe amet iure deserunt harum odio beatae.</td>
                                    <td class='orderdatas'>1</td>
                                    <td class='orderdatas'>10</td>
                                    <td class='orderdatas'>Received</td>
                                </tr> -->
                            <?php

                            //********Backend e help lagle php code rakhis naile delete korish********
                            // if (isset($_SESSION['cart'])) {
                            //     foreach ($_SESSION['cart'] as $key => $value) {
                            //         $serial = $key + 1;

                            //         //print_r($key);
                            //         echo "
                            // <tr>
                            // <td class='orderdatas'></td>
                            // <td class='orderdatas'></td>
                            // <td class='orderdatas'></td>
                            // <td class='orderdatas'></td>
                            // <td class='orderdatas'></td>
                            // </tr> 
                            // ";
                            //     }
                            // }
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