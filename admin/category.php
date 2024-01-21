<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Category</title>
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
                        <div class="row mb-4">
                            <div class="col-md-12 p-3 bg-body" style="border-radius: 4px;">
                                <a href="addCategory.php" class="btn btn-primary">Add Category</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-body p-4" style="border-radius: 4px;">
                                <h5 class="mb-3">All Categories</h5>
                                <input type="text" name="parentCategorySearch" id="parentCategorySearch" placeholder="Search" class="form-control mb-4" autocomplete="off">
                                <div class="table-responsive" id="parentCategoryTableData">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--==========Page Content -> Actual Content ========== -->

                <!-- Info Model -->

                <div class="modal fade" id="info" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Category Info</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body showInfoData">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <?php include_once 'components/footer.php'; ?>

        </div>

        <!-- ==================== Page Content ==================== -->

    </div>
    <?php include_once "jsLinks.php"; ?>

    <script>
        $(document).ready(function() {


            // ------------------ Load Table ------------------

            function loadTable() {

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: {
                        loadParentCategoryData: 'Load Parent Category'
                    },

                    success: function(res) {
                        $('#parentCategoryTableData').html(res);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            }

            loadTable();

            // ------------------ Searching ------------------

            $('#parentCategorySearch').keyup(function() {

                var searchText = $(this).val().toLowerCase();

                var Rows = $('#categoryTable tbody tr');

                for (var i = 0; i < Rows.length; i++) {

                    var column = $(Rows[i]).text().toLowerCase();

                    if (column.indexOf(searchText) === -1) {
                        $(Rows[i]).fadeOut();
                    } else {
                        $(Rows[i]).fadeIn();
                    }
                }
            });


            // ------------------ Load Info Data ------------------

            $(document).on('click', '.infobx', function() {

                var catID = $(this).data('iid');

                $.ajax({
                    url: 'hand.php',
                    data: {
                        iid: catID
                    },
                    type: 'POST',
                    success: function(resu) {
                        $('.showInfoData').html(resu);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });
            });

            // ------------------ Delete ------------------

            $(document).on('click', '.del', function() {

                if (confirm("Do you really want to delete this record ?")) {

                    var catID = $(this).data('id');

                    var element = this;

                    $.ajax({
                        url: 'hand.php',
                        data: {
                            id: catID
                        },
                        type: 'POST',
                        success: function(result) {
                            if (result != 1) {
                                $(element).closest('tr').fadeOut();
                                loadTable();
                            }
                        },
                        error: function() {
                            alert("Error....");
                        }
                    });

                }
            });

        });
    </script>

</body>

</html>