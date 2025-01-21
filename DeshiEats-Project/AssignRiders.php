<?php

session_start();

include("connect.php");
include("functions.php");

$sql = 'SELECT * FROM orderlist o JOIN cartlist c ON o.OrderID=c.OrderID JOIN item i ON c.ItemName = i.ItemName JOIN chef ch ON i.OwnerID = ch.ChefID JOIN customer cus ON cus.CustID=o.CustomerID WHERE  c.CartStatus="Deliver"';
$result = mysqli_query($link, $sql);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // echo $_POST["id"]." ".$_POST["riderName"];
    $ID = $_POST["id"];
    $name = $_POST["riderName"];
    $sql = "INSERT INTO `assignedrider`(`CartID`, `Rider Name`) VALUES ('$ID','$name')";
    mysqli_query($link,$sql);
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
    <link type="text/css" rel="stylesheet" href="css/DeStylesheet2.css" />

    <title>DeshiEats_AssignRider</title>

</head>

<body>

    <?php
    include "header.php";
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left">
                <div class="title">
                    <h1 id="t1">Assign Riders</h1>
                </div>
            </div>
            <div class="col-xl-12">
                <table class="table table-bordered ordertable">
                    <thead>
                        <tr class="text-align-center">
                            <th scope="col" class="orderhead">Chef Name</th>
                            <th scope="col" class="orderhead">Chef Address</th>
                            <th scope="col" class="orderhead">Customer Name</th>
                            <th scope="col" class="orderhead">Order Address</th>
                            <th scope="col" class="orderhead">Order Price</th>
                            <th scope="col" class="orderhead">Payment Type</th>
                            <th scope="col" class="orderhead">Customer Contact Number</th>
                            <th scope="col" class="orderhead">Assign Rider</th>
                            <th scope="col" class="orderhead">Update</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        while ($rowItem = mysqli_fetch_assoc($result)) { 
                            $checkAssign = "SELECT * FROM assignedrider WHERE CartID = ".$rowItem['ID'];
                            if(mysqli_num_rows(mysqli_query($link,$checkAssign))==0){
                                ?>                          
                            <tr>
                                <td class='orderdatas'><?php echo $rowItem['ChefName']; ?></td>
                                <td class='orderdatas'><?php echo $rowItem['ChefAddress']; ?></td>
                                <td class='orderdatas'><?php echo $rowItem['CustName']; ?></td>
                                <td class='orderdatas'><?php echo $rowItem['OrderAddress']; ?></td>
                                <td class='orderdatas'><?php echo $rowItem['OrderPrice']; ?></td>
                                <td class='orderdatas'><?php echo $rowItem['DeliveryInstruction']; ?></td>
                                <td class='orderdatas'><?php echo $rowItem['CustContactNumber']; ?></td>
                                <form action='AssignRiders.php' method='POST'>
                                    <td class='orderdatas'><input type="text" name="riderName"/></td>
                                    <td>
                                        <button type="submit" name='Remove_Item' class='plusMinusButton'> Update </button>
                                        <input hidden name="id" value="<?php echo $rowItem['ID']?>"/>
                                </form>
                                </td>
                            </tr>
                        <?php
                        }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>