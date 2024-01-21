<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Product</title>
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

            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="row bg-body shadow-sm" style="border-radius: 4px;">
                            <div class="col-6 p-3 text-uppercase d-flex justify-content-start align-items-center">
                                Add New Product
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="product.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row bg-body shadow-sm mt-3" style="border-radius: 4px;">
                            <div class="col-md-12 p-3" style="border-radius: 2px;">
                                <form id="insertProduct">
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="productPicture" class="form-label text-secondary">Product Picture:<span class="text-danger h4">*</span></label>
                                            <input type="file" name="productPicture" id="productPicture" class="form-control" required>
                                            <p class="text-danger" style="font-size: 14px;">The format for Picture must be (jpg, png, jpeg).</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="productName" class="form-label text-secondary">Product Name:<span class="text-danger h4">*</span></label>
                                            <input type="text" name="productName" id="productName" placeholder="Name" autocomplete="off" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="productCategory" class="form-label text-secondary">Product Category:<span class="text-danger h4">*</span></label>
                                            <select class="form-select livesearch" data-placeholder="Select Category" id="productCategory" name="productCategory" required>
                                                <option selected>Select Category</option>

                                                <?php

                                                include_once 'include/classes/childCategoryClass.php';

                                                $obj = new ChidCategory();

                                                foreach ($obj->fetchData() as $val) {
                                                    echo '<option value="' . $val['SubCategoryName'] . '">' . $val['SubCategoryName'] . '</option>';
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="productDescription" class="form-label text-secondary">Product Description:<span class="text-danger h4">*</span></label>
                                            <textarea class="form-control" name="productDescription" id="productDescription" placeholder="Description" rows="3" required></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="productStock" class="form-label text-secondary">Product Stock:<span class="text-danger h4">*</span></label>
                                            <input type="number" name="productStock" id="productStock" placeholder="Stock" class="form-control mb-4" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="productPrice" class="form-label text-secondary">Product Price:<span class="text-danger h4">*</span></label>
                                            <input type="number" name="productPrice" id="productPrice" placeholder="Price" class="form-control mb-4" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <input type="submit" value="Add Product" class="btn btn-primary">
                                    <input type="reset" value="Reset Form" class="ms-2 btn btn-warning">
                                </form>
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

            // ------------------------ Chosen ------------------------

            $('.livesearch').chosen({
                width: "100%",
                no_results_text: "Oops, nothing found!"
            });


            // ------------------- Insert Product -------------------

            $('#insertProduct').on('submit', function(e) {

                e.preventDefault();

                var insertProductData = new FormData(this);

                insertProductData.append("insertPdocut", "insertingProduct");

                $.ajax({

                    url: 'hand.php',
                    type: 'POST',
                    data: insertProductData,
                    contentType: false,
                    processData: false,
                    success: function(insertProductResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = insertProductResponse.replace(stringToRemove, "");

                        alert(modifiedString);

                        loadTable();

                    },
                    error: function() {
                        alert("Insert Product Ajax Error");
                    }

                });

            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>