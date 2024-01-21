<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Update Category</title>
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
                                Update Category
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="category.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row bg-body shadow-sm mt-3" style="border-radius: 4px;">
                            <div class="col-md-12 p-3 d-flex justify-content-center" style="border-radius: 2px;">
                                <div class="card" style="width: 30rem;">
                                    <div class="card-body">
                                        <form id="updateCategoryForm">
                                            <?php

                                            include_once 'include/classes/categoryClass.php';

                                            $obj = new Category();

                                            foreach ($obj->fetchDataOnCondition($_GET['id']) as $val) {

                                                echo '<label for="catid" class="form-label text-secondary">Category ID:</label>';

                                                echo "<input type='text' name='catid' id='catid' value='{$val['CategoryID']}' class='form-control text-uppercase mb-4' readonly>";

                                                echo '<label for="categoryName" class="form-label text-secondary">Category Name:</label>';

                                                echo "<input type='text' name='categoryName' id='categoryName' placeholder='Name' value='{$val['CategoryName']}' autocomplete='off' required class='form-control mb-4'>";

                                                echo '<label for="categoryDescription" class="form-label text-secondary">Category Description:</label>';

                                                echo "<textarea class='form-control mb-4' placeholder='Description' name='categoryDescription' id='categoryDescription' rows='3'>{$val['CategoryDescription']}</textarea>";

                                                echo "<input type='submit' value='Update' class='btn btn-primary mt-4'>";
                                            }

                                            ?>
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
    </div>

    <!-- ==================== Page Content ==================== -->

    <?php include_once "jsLinks.php"; ?>
    <script>
        $(document).ready(function() {


            // -------------------------- Update Category --------------------------

            $('#updateCategoryForm').on('submit', function(e) {

                e.preventDefault();

                var fetchRestData = new FormData(this);

                fetchRestData.append('updateData', 'categorUpdate');

                $.ajax({
                    url: 'hand.php',
                    type: "POST",
                    data: fetchRestData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res != 1)
                            alert('Category Updated');
                        else
                            alert('Category Not Updated ......');
                    },
                    error: function() {
                        alert('error');
                    }
                });

            });

        });
    </script>
</body>

</html>