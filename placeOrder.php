<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Place Order</title>
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
        <div class="row bg-body shadow">
            <div class="col-md-12 p-4">

                <h4 class="text-center text-uppercase">Order Details</h4>

                <form id="placeOrder">
                    <div class="row mt-5">

                        <!-- Personal Info Section -->

                        <div class="col-md-4">

                            <div class="card">

                                <div class="card-header">
                                    Personal Info
                                </div>

                                <div class="card-body">

                                    <label for="userID" class="form-label text-secondary">User ID:</label>
                                    <input type="text" name="userID" id="userID" class="form-control text-uppercase mb-3" value="<?php echo $_SESSION['User_ID']; ?>" readonly autocomplete="off" style="border: 1px solid green;">


                                    <label for="userName" class="form-label text-secondary">User Name:</label>
                                    <input type="text" name="userName" id="userName" class="form-control mb-3" value="<?php echo $obj->getName($_SESSION['User_ID']); ?>" readonly autocomplete="off" style="border: 1px solid green;">


                                    <label for="userMobile" class="form-label text-secondary">User Mobile Number:</label>
                                    <input type="number" name="userMobile" id="userMobile" class="form-control mb-3" value="<?php echo $obj->getMobileNum($_SESSION['User_ID']); ?>" readonly autocomplete="off" style="border: 1px solid green;">



                                    <label for="userAddress" class="form-label text-secondary">User Address:</label>
                                    <textarea class="form-control mb-3" id="userAddress" name="userAddress" rows="1" style="border: 1px solid green;"><?php echo html_entity_decode($obj->getAddress($_SESSION['User_ID'])); ?></textarea>


                                    <label for="shippingAddress" class="form-label text-secondary">Shipping Address:</label>
                                    <textarea class="form-control mb-3" id="shippingAddress" name="shippingAddress" placeholder="Plase Enter Shipping Address" rows="3" style="border: 1px solid green;" required></textarea>

                                </div>
                            </div>
                        </div>

                        <!-- Order Details -->

                        <div class="col-md-8">

                            <div class="table-responsive">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Product ID:</th>
                                            <th scope="col">Product Name:</th>
                                            <th scope="col">Quantity:</th>
                                            <th scope="col">Price:</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php

                                        include_once 'admin/include/classes/database.php';

                                        include_once 'admin/include/classes/productClass.php';

                                        $product = new Product();

                                        $db = new Database();

                                        $userid = $_SESSION['User_ID'];

                                        $db->select("ops_usercart", "*", " ops_cartitems ON ops_usercart.CartID = ops_cartitems.CartID", "ops_usercart.UserID = '$userid'");

                                        $data = " ";

                                        foreach ($db->getResult() as $value) {


                                            $data .= ' <tr>
                                                            <td><img src="admin/' . $product->getPicture($value['ProductID']) . '" width="40px" height="40px" /></td>
                                                            <td class="text-uppercase">' . $value['ProductID'] . '</td>
                                                            <td>' . $product->getName($value['ProductID']) . '</td>
                                                            <td>' . $value['ProductQuantity'] . '</td>
                                                            <td>Rs. ' . $value['ProductPrice'] . '</td>
                                                        </tr>';
                                        }

                                        echo $data;

                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <label for="totalPrice" class="form-label mt-3 text-secondary">Total Price:</label>

                            <?php

                            $userid = $_SESSION['User_ID'];

                            $db->select("ops_usercart", "ProductPrice", " ops_cartitems ON ops_usercart.CartID = ops_cartitems.CartID", "ops_usercart.UserID = '$userid'");

                            $sum = 0;

                            foreach ($db->getResult() as $value)
                                foreach ($value as $val)
                                    $sum = $sum + $val;


                            echo '<input type="number" name="totalPrice" id="totalPrice" value="' . $sum . '" class="form-control mb-3">';

                            ?>

                            <?php

                            include_once 'admin/include/classes/userOrderClass.php';

                            $check = new UserOrders();

                            if ($check->getUserID($_SESSION['User_ID']) == $_SESSION['User_ID']) {

                                echo '<input type="submit" value="Place Order" class="btn disabled btn-success mt-3">';

                                echo '<div class="alert alert-warning mt-3" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill text-danger"></i> Already have process Order.
                                      </div>';
                            } else
                                echo '<input type="submit" value="Place Order" class="btn btn-success mt-3">';

                            ?>


                            <div id="showMessage" class="mt-3">

                            </div>

                            <div class="alert alert-warning mt-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill text-danger"></i> If you want to increase or decrease product quantity, then change in product cart before placing order.
                            </div>
                        </div>
                    </div>
                </form>
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

            // --------------------------- Placing Order ---------------------------

            $('#placeOrder').on('submit', function(e) {

                e.preventDefault();

                var placeOrder = new FormData(this);

                placeOrder.append("PlaceOrder", "Placing");

                $.ajax({

                    url: 'ajaxHandler.php',

                    type: 'POST',

                    data: placeOrder,

                    contentType: false,

                    processData: false,

                    success: function(placeOrderResponse) {

                        $('#showMessage').html(placeOrderResponse);

                        setInterval(function() {
                            window.location.href = "myOrder.php";
                        }, 2000);
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