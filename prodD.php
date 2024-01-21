<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Product Detaills</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->


    <!-- Show Details -->


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 p-4">
                <div class="row">
                    <div class="col-md-12 p-5 rounded shadow">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <?php
                                include_once 'admin/include/classes/productClass.php';

                                $obj = new Product();

                                ?>
                                <img src="admin/<?php echo $obj->getPicture($_GET['id']); ?>" class="img-fluid" style="width: 50%;" />
                            </div>
                            <div class="col-md-6">
                                <span class="fs-5"><?php echo $obj->getName($_GET['id']); ?></span>
                                <p class="fs-3 fw-bold text-success mt-3">Rs. <?php echo $obj->getPrice($_GET['id']); ?>
                                </p>
                                <p><?php echo $obj->getDescription($_GET['id']); ?></p>
                                <p>
                                    <?php

                                    if ($obj->getStock($_GET['id']) != 0)
                                        echo "<span class='badge rounded-pill text-bg-success'>Available</span>";
                                    else
                                        echo "<span class='badge rounded-pill text-bg-danger'>Out of Stock</span>";

                                    ?>
                                </p>
                                <p><b>Category:</b> <?php echo $obj->getCategory($_GET['id']); ?></p>
                                <form id="prodIDForm">
                                    <input type="number" name="productQuantity" id="productQuantity" class="form-control mb-3 w-25" value="1">
                                    <input type="hidden" name="prodID" id="prodID" value="<?php echo $_GET['id']; ?>">
                                </form>
                                <div class="d-flex justify-content-start">
                                    <a href="#" class="btn btn-success text-center w-100" id="cartbtn">Add to Cart</a>
                                </div>
                                <p class="text-danger mt-2" style="font-size: 14px;">Note: you must Login to buy or add
                                    product in the cart.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Related Products -->

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12 p-5">
                <p class="display-6 fw-bold">Related Products</p>
                <div class="row">
                    <?php

                    $relatedProd = $_GET['cate'];



                    include_once 'admin/include/classes/database.php';

                    $obj = new Database();

                    $obj->select("ops_product", "*", null, "ProductCategory = '$relatedProd'", null, "4");


                    foreach ($obj->getResult() as $value) {


                        $stockMess = ($value['ProductStock'] != 0) ? "<span class='badge rounded-pill text-bg-success'>Available</span>" : "<span class='badge rounded-pill text-bg-danger'>Out of Stock</span>";

                        echo '<div class="col-md-3 p-3">
                                    <a href="prodD.php?id=' . $value['ProductID'] . '&cate=' . $value['ProductCategory'] . '" class="nav-link">
                                        <div class="card shadow text-center">
                                            
                                                <img src="http://localhost/OnlinePlantsStore/admin/' . $value['ProductPic'] . '" class="card-img-top" width="100px" height="200px"/>
                                            
                                            <div class="card-body">
                                                <h5 class="card-title text-secondary">' . $value['ProductName'] . '</h5>
                                                <p class="card-text fs-4 text-success fw-bold">Rs. ' . $value['ProductPrice'] . '</p>
                                                <p class="card-text" id="text-trun">' . $value['ProductDescription'] . '</p>
                                                <p class="card-text fst-italic fw-bold" id="text-trun">Category: ' . $value['ProductCategory'] . '</p>
                                                    ' . $stockMess . ' <BR><BR>
                                            </div>
                                        </div>
                                    </a>
                                </div>';
                    }

                    ?>
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


            // ----------------------------- Session Checking -----------------------------

            $('#cartbtn').on('click', function() {

                var id = $('#prodID').val();

                var quantity = $('#productQuantity').val();

                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: {
                        sessionChk: id,
                        prodQuantity: quantity
                    },
                    success: function(sessionCheckRespoonse) {
                        alert(sessionCheckRespoonse);
                        location.reload();
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