<?php include_once 'session.php';

include_once 'include/classes/childCategoryClass.php';

include_once 'include/classes/categoryClass.php';

$parent = new Category();

$updateChildCat = new ChidCategory();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Update Child Category</title>
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
                                Update Chid Category Data
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="childCategory.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row mt-3 shadow-sm bg-body" style="border-radius: 4px;">
                            <div class="col-md-4 p-3 bg-light"> <!-- Update Parent Category -->
                                <form id="updateParentCat">
                                    <span class="text-primary h6 d-flex justify-content-center mb-5">Update Parent Category</span>
                                    <input type="text" name="childIDP" id="childIDP" value="<?php echo $_GET['id']; ?>" class="form-control text-uppercase mb-4" readonly>
                                    <label for="currentParentCat" class="form-label text-secondary">Current Parent Category</label>
                                    <?php
                                    foreach ($updateChildCat->fetchDataOnCondition($_GET['id']) as $val) {
                                        echo '<input type="text" name="currentParentCat" id="currentParentCat" value="' . $val['ParentCategory'] . '" class="form-control" readonly>';
                                    }
                                    ?>
                                    <label for="change" class="form-label text-secondary mt-4">Change Parent Category</label>
                                    <?php
                                    echo '<select class="form-select livesearch mb-4" data-placeholder="Select Parent Category" id="change" name="updateParentCate">
                                          <option></option>';
                                    foreach ($parent->fetchData() as $parentValue) {

                                        echo '<option value="' . $parentValue['CategoryName'] . '">' . $parentValue['CategoryName'] . '</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                    <input type="submit" value="Update" class="btn btn-primary mt-5">
                                </form>
                            </div>

                            <div class="col-md-7 p-3 bg-body" style="border-radius: 4px;">
                                <form id="updateChildCategoryForm">

                                    <span class="text-primary h6 d-flex justify-content-center mb-4">Update Child Category</span>

                                    <?php

                                    foreach ($updateChildCat->fetchDataOnCondition($_GET['id']) as $val) {

                                        echo '<label for="updateChdID" class="form-label text-secondary">Category ID:</label>';

                                        echo "<input type='text' name='updateChdID' id='updateChdID' value='{$val['SubCategoryID']}' class='form-control mb-4 text-uppercase' readonly>";

                                        echo '<label for="updateChdName" class="form-label text-secondary">Category Name:</label>';

                                        echo "<input type='text' name='updateChdName' id='updateChdName' placeholder='Name' value='{$val['SubCategoryName']}' autocomplete='off' required class='form-control mb-4'>";

                                        echo '<label for="desc" class="form-label text-secondary">Category Description:</label>';

                                        echo "<textarea class='form-control mb-5' placeholder='Description' name='desc' id='desc' rows='3'>{$val['SubCategoryDescription']}</textarea>";

                                        echo "<input type='submit' value='Update' class='btn btn-primary'>";
                                    }

                                    ?>
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

            // ------------------ dropdown Menu Search ------------------

            $('.livesearch').chosen({
                width: "100%",
                no_results_text: "Oops, nothing found!"
            });

            // ---------------------- Update Child Category ----------------------

            $('#updateChildCategoryForm').on('submit', function(e) {

                e.preventDefault();

                var updateChildData = new FormData(this);

                updateChildData.append('updateChildCatData', 'childCatUpdate');

                $.ajax({
                    url: 'hand.php',
                    type: "POST",
                    data: updateChildData,
                    processData: false,
                    contentType: false,
                    success: function(reslt) {
                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = reslt.replace(stringToRemove, "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert('error');
                    }
                });

            });

            // ---------------------- Update Parent Category for Child ----------------------

            $('#updateParentCat').on('submit', function(e) {

                e.preventDefault();

                var updateParentCatFourChild = new FormData(this);

                updateParentCatFourChild.append("updateParentFChild", 'update');

                $.ajax({
                    url: 'hand.php',
                    type: "POST",
                    data: updateParentCatFourChild,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = res.replace(stringToRemove, "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert('error');
                    }
                });
            });

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>