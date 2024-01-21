<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Add Category</title>
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
                                Add New Category
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="category.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row bg-body shadow-sm mt-3" style="border-radius: 4px;">
                            <div class="col-md-12 p-3 d-flex justify-content-center" style="border-radius: 2px;">
                                <div class="card" style="width: 30rem;">
                                    <div class="card-body">
                                        <form id="parentCategoryForm">
                                            <div class="row">
                                                <div class="col-md-12 p-4 bg-body" style="border-radius: 4px;">
                                                    <input type="text" name="parentCatName" id="parentCatName" placeholder="Name" autocomplete="off" class="form-control mb-4" required>
                                                    <textarea class="form-control mb-4" name="parentCatDescription" placeholder="Description" rows="3"></textarea>
                                                    <input type="submit" value="Add Category" class="btn btn-primary">
                                                    <input type="reset" value="Reset Form" class="ms-2 btn btn-warning">
                                                </div>
                                            </div>
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


            // ------------------ Insert Data ------------------

            $('#parentCategoryForm').on('submit', function(e) {

                e.preventDefault();

                var insertCatData = new FormData(this);

                insertCatData.append("insertParentCat", "Inserting");

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: insertCatData,
                    contentType: false,
                    processData: false,
                    success: function(insertCatResponse) {

                        $('#parentCategoryForm').trigger('reset');

                        loadTable();

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = insertCatResponse.replace(stringToRemove, "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert("Inserting Category Ajax conn Error");
                    }
                });

            });
        });
    </script>

</body>

</html>