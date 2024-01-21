<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Child Category</title>
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
                                Add New Child Category
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="childCategory.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row bg-body shadow-sm mt-3" style="border-radius: 4px;">
                            <div class="col-md-12 p-3 d-flex justify-content-center" style="border-radius: 2px;">
                                <div class="card" style="width: 30rem;">
                                    <div class="card-body">
                                        <form id="childCatForm">
                                            <input type="text" name="childCatName" id="childCatName" placeholder="Name" autocomplete="off" class="form-control mb-4" required>
                                            <select class="form-select livesearch mb-4" data-placeholder="Select Parent Category" name="parentCategory" required>
                                                <option></option>
                                                <?php

                                                include_once 'include/classes/categoryClass.php';

                                                $obj = new Category();

                                                foreach ($obj->fetchData() as $val) {
                                                    echo '<option value="' . $val['CategoryName'] . '">' . $val['CategoryName'] . '</option>';
                                                }

                                                ?>
                                            </select>
                                            <textarea class="form-control mb-4 mt-4" name="childCatDescription" required placeholder="Description" rows="3"></textarea>
                                            <input type="submit" value="Add Category" class="btn btn-primary">
                                            <input type="reset" value="Reset Form" class="ms-2 btn btn-warning">
                                        </form>
                                    </div>
                                </div>
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

            // ------------------ dropdown Menu Search ------------------

            $('.livesearch').chosen({
                width: "100%",
                no_results_text: "Oops, nothing found!"
            });


            // --------------------------- Insert Child Category ---------------------------

            $('#childCatForm').on('submit', function(e) {

                e.preventDefault();

                var childCatFormData = new FormData(this);

                childCatFormData.append('child', 'ChildCategory');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: childCatFormData,
                    contentType: false,
                    processData: false,
                    success: function(childCatResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = childCatResponse.replace(stringToRemove, "");

                        $('#childCatForm').trigger('reset');

                        alert(modifiedString);

                    },
                    error: function() {
                        alert("Child Category Ajax conn Error");
                    }
                });

            });


        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>

</html>