<?php include_once 'session.php';

include_once 'include/classes/productClass.php';

include_once 'include/classes/childCategoryClass.php';

$updateProd = new Product();

$showCat = new ChidCategory();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Update Product</title>
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
                                Update Product Data
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="product.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row mt-3 shadow-sm bg-body" style="border-radius: 4px;">
                            <div class="col-md-4 p-3 bg-light"> <!-- Update Product Picture -->
                                <form id="updateProdPic">
                                    <span class="text-primary h6 d-flex justify-content-center mb-4">Update Product Picture</span>
                                    <label for="prodIDPic" class="form-label text-secondary">Product ID:</label>
                                    <input type="text" name="prodIDPic" id="prodIDPic" value="<?php echo $_GET['id'] ?>" class="form-control text-uppercase mb-4" readonly>
                                    <input type="file" name="updateProdPicture" id="updateProdPicture" class="form-control mt-4 mb-4" required>
                                    <p class="text-danger" style="font-size: 14px;">The format for Picture must be (jpg, png, jpeg).</p>
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </form>
                            </div>

                            <div class="col-md-7 p-3 bg-body" style="border-radius: 4px;">
                                <form id="updateProdDetails">
                                    <span class="text-primary h6 d-flex justify-content-center mb-4">Update Product Details</span>

                                    <label for="prodID" class="form-label text-secondary">Product ID:</label>
                                    <input type="text" name="prodID" id="prodID" value="<?php echo $_GET["id"] ?>" class="form-control text-uppercase mb-3" readonly>

                                    <label for="updateProdName" class="form-label text-secondary">Product Name:</label>
                                    <input type="text" name="updateProdName" id="updateProdName" value="<?php echo $updateProd->getName($_GET['id']); ?>" class="form-control mb-3" autocomplete="off" required>

                                    <label for="updateProdCategory" class="form-label text-secondary">Product Category:</label>
                                    <select class="form-select mb-3 livesearch" data-placeholder="Select Category" id="updateProdCategory" name="updateProdCategory">

                                        <?php

                                        foreach ($updateProd->fetchDataOnCondition($_GET['id']) as $val) {
                                            echo '<option selected">' . $val['ProductCategory'] . '</option>';

                                            foreach ($showCat->fetchData() as $value) {
                                                echo '<option value="' . $value['SubCategoryName'] . '">' . $value['SubCategoryName'] . '</option>';
                                            }
                                        }

                                        ?>
                                    </select>

                                    <label for="updateProdDescription" class="form-label text-secondary mt-4">Product Description</label>
                                    <textarea class="form-control mb-3" id="updateProdDescription" name="updateProdDescription" rows="4"><?php echo $updateProd->getDescription($_GET['id']); ?></textarea>

                                    <label for="updateProdPrice" class="form-label text-secondary">Product Price</label>
                                    <input type="number" name="updateProdPrice" id="updateProdPrice" value="<?php echo $updateProd->getPrice($_GET['id']); ?>" autocomplete="off" class="form-control mb-3" required>

                                    <label for="updateProductStock" class="form-label text-secondary">Product Stock</label>
                                    <input type="number" name="updateProductStock" id="updateProductStock" value="<?php echo $updateProd->getStock($_GET['id']); ?>" class="form-control mb-4" autocomplete="off" required>

                                    <input type="submit" value="Update" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== Page Content -> Actual Content ========== -->
            <?php include_once 'components/footer.php'; ?>

        </div>

        <!-- ==================== Page Content ==================== -->

    </div>


    <?php include_once "jsLinks.php"; ?>
    <script>
        $(document).ready(function() {

            // ------------------------ Chosen ------------------------

            $('.livesearch').chosen({
                width: "100%",
                no_results_text: "Oops, nothing found!"
            });


            // ------------------------ Pic Update ------------------------

            $('#updateProdPic').on('submit', function(e) {

                e.preventDefault();

                var updateProductP = new FormData(this);

                updateProductP.append('updateProPicture', 'updating');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: updateProductP,
                    processData: false,
                    contentType: false,
                    success: function(updateProdPResponse) {
                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = updateProdPResponse.replace(stringToRemove, "");

                        $('#updateProdPic').trigger('reset');

                        alert(modifiedString);
                    },
                    error: function() {
                        alert("Update Product Pic Ajax conn Error");
                    }
                });

            });

            // ------------------------ Product Update ------------------------

            $('#updateProdDetails').on('submit', function(e) {

                e.preventDefault();

                var updateProdDetails = new FormData(this);

                updateProdDetails.append('updatePDetails', 'updateingD');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: updateProdDetails,
                    processData: false,
                    contentType: false,
                    success: function(updatePDetailsResponse) {
                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = updatePDetailsResponse.replace(stringToRemove, "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert("Update Product Details Ajax conn Error");
                    }
                });

            });

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>

</html>