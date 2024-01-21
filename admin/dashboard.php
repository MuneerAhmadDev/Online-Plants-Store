<?php include_once 'session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include_once "cssLinks.php"; ?>

</head>

<body>
    <div id="wrapper">

        <!-- ==================== Sidebar ==================== -->

        <?php include_once 'components/sidebar.php' ?>

        <!-- ==================== Sidebar ==================== -->

        <!-- ==================== Page Content ==================== -->

        <div id="page-content-wrapper">


            <!-- ========== Page Content -> Navbar ========== -->

            <?php include_once 'components/navbar.php' ?>

            <!-- ========== Page Content -> Navbar ========== -->




            <!-- ========== Page Content -> Actual Content ========== -->

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-3">
                                    <?php
                                    include 'include/classes/productClass.php';

                                    $totalP = new Product();

                                    echo $totalP->totalProducts();
                                    ?>
                                </h3>
                                <p class="fs-5">Products</p>
                            </div>
                            <a href="product.php"><i class="bi bi-gift-fill fs-1"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-3">
                                    <?php
                                    include 'include/classes/categoryClass.php';

                                    $totalC = new Category();

                                    echo $totalC->totalCategories();
                                    ?>
                                </h3>
                                <p class="fs-5">Parent Category</p>
                            </div>
                            <a href="category.php"><i class="bi bi-tags-fill fs-1"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-3">
                                    <?php
                                    include 'include/classes/childCategoryClass.php';

                                    $totalCh = new ChidCategory();

                                    echo $totalCh->totalCategories();
                                    ?>
                                </h3>
                                <p class="fs-5">Child Category</p>
                            </div>
                            <a href="childCategory.php"><i class="bi bi-tags-fill fs-1"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-3" id="totalUsers">

                                </h3>
                                <p class="fs-5">Users</p>
                            </div>
                            <a href="users.php"><i class="bi bi-people-fill fs-1"></i></a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- =============== Outof Stock Products =============== -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="row">
                            <div class="col-md-12 bg-body p-4" style="border-radius: 4px;">
                                <h4 class="text-danger mb-4">Out of Stock Products</h4>
                                <div class="table-responsive" id="prodTable">

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 bg-body p-4" style="border-radius: 4px;">
                                <h4 class="text-warning mb-4">Low Stock Products</h4>
                                <div class="table-responsive" id="lowProdTable">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- ========== Page Content -> Actual Content ========== -->

            <?php include_once 'components/footer.php'; ?>

        </div>
    </div>
    <!-- ==================== Page Content ==================== -->


    <?php include_once "jsLinks.php"; ?>
    <script>
        $(document).ready(function() {

            // ---------------- load Total Users ----------------

            function loadTotalUsers() {

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: {
                        loadUsers: "load"
                    },
                    success: function(res) {
                        $('#totalUsers').html(res);
                    },
                    error: function() {
                        alert("Error...");
                    }
                });

            }

            loadTotalUsers();

            // ---------------- load Zero Stock Product Table ----------------

            function loadProdTable() {

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: {
                        prodTable: "load"
                    },
                    success: function(res) {
                        $('#prodTable').html(res);
                    },
                    error: function() {
                        alert("Error...");
                    }
                });

            }

            loadProdTable();

            // ---------------- load Low Product Table ----------------

            function loadlowProdTable() {

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: {
                        lowProdTableData: "loading"
                    },
                    success: function(fet) {
                        $('#lowProdTable').html(fet);
                    },
                    error: function() {
                        alert("Error...");
                    }
                });

            }

            loadlowProdTable();


        });
    </script>
</body>

</html>