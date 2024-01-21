<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Search</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->


    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12 p-5">
                <div class="row">
                    <?php

                    $serch_terms = $_GET['searchBar'];

                    if (!empty($serch_terms)) {

                        include_once 'admin/include/classes/database.php';

                        $obj = new Database();

                        $obj->select("ops_product", "*", null, "ProductName like '%$serch_terms%' OR ProductCategory like '%$serch_terms%'", null, null);


                        foreach ($obj->getResult() as $value) {


                            $stockMess = ($value['ProductStock'] != 0) ? "<span class='badge rounded-pill text-bg-success'>Available</span>" : "<span class='badge rounded-pill text-bg-danger'>Out of Stock</span>";

                            echo '<div class="col-md-3 p-3">
                                        <a href="prodD.php?id=' . $value['ProductID'] . '&cate=' . $value['ProductCategory'] . '" class="nav-link">
                                            <div class="card shadow text-center">
                                                
                                                    <img src="http://localhost/OnlinePlantsStore/admin/' . $value['ProductPic'] . '" class="card-img-top" width="100px" height="200px">
                                                
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
                    } else
                        echo '<div class="alert alert-warning" role="alert">
                                <i class="bi bi-exclamation-triangle-fill"></i> Search field is empty.  
                              </div>';


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



        });
    </script>
</body>

</html>