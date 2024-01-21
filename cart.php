<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Cart</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->


    <?php
    session_status();
    if (!isset($_SESSION['User_ID'])) {
        header("Location: index.php");
    }

    include_once 'users.php';

    $obj = new Users();

    ?>

    <div class="container mt-5">
        <div class="row bg-body shadow rounded">
            <div class="col-md-12 p-3">

                <!-- Show message  -->

                <div class="showMessage">

                </div>

                <div class="table-responsive">
                    <table class="table text-center table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="text-uppercase border-bottom"><?php echo $_SESSION['User_ID'] . "(" . $obj->getName($_SESSION['User_ID']) . ")"; ?></th>
                            </tr>
                            <tr class="border-bottom">
                                <th scope="col">Description</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Update Quantity</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $data = "";

                            include_once 'admin/include/classes/userCart.php';

                            include_once 'admin/include/classes/productClass.php';

                            include_once 'admin/include/classes/database.php';

                            $db = new Database();

                            $product = new Product();

                            $userCart = new UserCart();

                            $userid = $_SESSION['User_ID'];

                            $db->select("ops_usercart", "*", " ops_cartitems ON ops_usercart.CartID = ops_cartitems.CartID", "ops_usercart.UserID = '$userid'");

                            foreach ($db->getResult() as $value)
                                $data .= '<tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <img src="admin/' . $product->getPicture($value['ProductID']) . '" width="50px" height="50px" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        ' . $product->getName($value['ProductID']) . '
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-uppercase">' . $value['ProductID'] . '</td>
                                            <td class="d-flex justify-content-center"><input type="number" name="prodQuantity" id="prodQuantity" value="' . $value['ProductQuantity'] . '" class="form-control w-25"></td>
                                            <td>Rs. ' . $value['ProductPrice'] . '</td>
                                            <td><i class="bi bi-pencil-square text-success fs-3" style="cursor: pointer;" id="updateCartQuantity" data-prdid="' . $value['ProductID'] . '"></i></td>
                                            <td><i class="bi bi-x-circle text-danger fs-3" style="cursor: pointer;" id="removeCartItem" data-pid="' . $value['ProductID'] . '"></i></td>
                                        </tr>';
                            echo $data;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Proceed to checkout -->

        <div class="row mt-4 bg-body shadow">
            <div class="col-md-6 d-flex justify-content-start align-items-center fw-bold text-danger p-3">
                Note: the quantity of product should not be negative.
            </div>
            <div class="col-md-6 d-flex justify-content-end p-3">

                <?php

                $db->select("ops_usercart", "count(*)", " ops_cartitems ON ops_usercart.CartID = ops_cartitems.CartID", "ops_usercart.UserID = '$userid'");

                $res = 0;

                foreach ($db->getResult() as $value)
                    foreach ($value as $val)
                        $res = $val;

                if ($res > 0)
                    echo '<a href="placeOrder.php" class="btn btn-primary">Buy Product</a>';
                else
                    echo '<a href="placeOrder.php" class="btn disabled btn-primary">Buy Product</a>';
                ?>

            </div>
        </div>
    </div>



    <!-- ==================== Footer Section ==================== -->

    <?php include 'components/footer.php'; ?>

    <!-- ==================== Footer Section ==================== -->


    <?php include_once "javaScriptLinks.php" ?>
    <script>
        $(document).ready(function() {


            // ----------------------------- load Navbar -----------------------------


            loadNavbar();


            // ----------------------------- Remove Cart Item -----------------------------

            $(document).on('click', '#removeCartItem', function() {

                var productID = $(this).data('pid');

                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: {
                        id: productID
                    },
                    success: function(delCartResponse) {
                        $('.showMessage').html(delCartResponse);
                        setTimeout(function() {
                            location.reload();
                        }, 1600);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            });

            // ----------------------------- Update Cart Item Quantity -----------------------------

            $(document).on('click', '#updateCartQuantity', function() {

                var prodID = $(this).data('prdid');

                var quantity = $(this).closest('tr').find('#prodQuantity').val();

                $.ajax({
                    url: 'ajaxHandler.php',
                    data: {
                        uid: prodID,
                        quant: quantity
                    },
                    type: 'POST',
                    success: function(updateCartResponse) {

                        $('.showMessage').html(updateCartResponse);

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            });

        });
    </script>

</body>

</html>