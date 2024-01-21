<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>My Orders</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->


    <?php


    if (!isset($_SESSION['User_ID'])) {

        header("Location: index.php");
    }

    ?>




    <div class="container">
        <div class="row">
            <div class="col-md-12 p-4 shadow rounded mt-5 bg-body">
                <div class="card">
                    <div class="card-header text-center fs-4">
                        My Orders
                    </div>

                    <div class="card-body p-4">

                        <div class="table-responsive">

                            <?php

                            include_once 'admin/include/classes/database.php';

                            include_once 'admin/include/classes/productClass.php';

                            $product = new Product();

                            $db = new Database();

                            $userID = $_SESSION['User_ID'];

                            $db->select("ops_userorders", '*', null, "UserID = '$userID'", null, null);

                            $orderData = '<table class="table text-center table-bordered" id="userCart">
                                              <thead>
                                                  <tr>
                                                      <th scope="col">Order ID:</th>
                                                      <th scope="col">User ID:</th>
                                                      <th scope="col">Order Status:</th>
                                                      <th scope="col">Shiping Address:</th>
                                                      <th scope="col">Order Products:</th>
                                                      <th scope="col">Total Price:</th>
                                                  </tr>
                                              </thead>
                                              <tbody>';

                            foreach ($db->getResult() as $value) {

                                $orderData .= '
                                                  <tr>
                                                      <td class="text-uppercase">' . $value['OrderID'] . '</td>
                                                      <td class="text-uppercase">' . $_SESSION['User_ID'] . '</td>
                                                      <td>' . $value['OrderStatus'] . '</td>
                                                      <td>' . html_entity_decode($value['ShippingAddress']) . '</td>
                                                      <td>
                                                          <div class="table-responsive">
                                                              <table class="table">
                                                                  <thead>
                                                                      <tr>
                                                                          <th></th>
                                                                          <th scope="col">Product ID:</th>
                                                                          <th scope="col">Product Price:</th>
                                                                          <th scope="col">Product Quantity:</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody>';

                                $orderID = $value['OrderID'];

                                $db->select("ops_orderitems", "*", null, "OrderID = '$orderID'", null, null);

                                foreach ($db->getResult() as $val) {

                                    $orderData .= '
                                                                      <tr>
                                                                          <td><img src="admin/' . $product->getPicture($val['ProductID']) . '" width="40px" height="40px"/></td>
                                                                          <td class="text-uppercase">' . $val['ProductID'] . '</td>
                                                                          <td>' . $val['ProductPrice'] . '</td>
                                                                          <td>' . $val['ProductQuantity'] . '</td>
                                                                      </tr>';
                                }

                                $orderData .= ' 
                                                                 </tbody>
                                                              </table>
                                                          </div>
                                                      </td>
                                                      <td>Rs. ' . $value['TotalPrice'] . '</td>
                                                  </tr>
                                          ';
                            }

                            $orderData .= '   </tbody>
                                            </table>';

                            echo $orderData;

                            ?>
                        </div>
                    </div>
                </div>
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


        });
    </script>
</body>

</html>