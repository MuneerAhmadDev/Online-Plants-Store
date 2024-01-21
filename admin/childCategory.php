<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Child Category</title>
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
                                <a href="addChildCategory.php" class="btn btn-primary">Add Child Category</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row d-flex justify-content-around">
                                <div class="col-md-12 bg-body p-4 mb-4" style="border-radius: 4px;">
                                    <input type="text" name="childCategorySearch" id="childCategorySearch" placeholder="Search" class="form-control mb-4" autocomplete="off">
                                    <div class="table-responsive" id="childCategoryTableData">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========== Page Content -> Actual Content ========== -->

            </div>

            <!-- ==================== Page Content ==================== -->

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
            <?php include_once 'components/footer.php'; ?>

        </div>
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
                        loadChildCategoryData: 'Load Child Category'
                    },

                    success: function(res) {
                        $('#childCategoryTableData').html(res);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            }

            loadTable();


            // ------------------ Load Info Data ------------------

            $(document).on('click', '.chinfobx', function() {

                var chcatID = $(this).data('chiid');

                $.ajax({
                    url: 'hand.php',
                    data: {
                        chiidbx: chcatID
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

            $(document).on('click', '.chddel', function() {

                if (confirm("Do you really want to delete this record ?")) {

                    var chcatID = $(this).data('chdelid');

                    var element = this;

                    $.ajax({
                        url: 'hand.php',
                        data: {
                            chdel: chcatID
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

            // ------------------ Searching ------------------

            $('#childCategorySearch').keyup(function() {

                var searchText = $(this).val().toLowerCase();

                var Rows = $('#categoryTable tbody tr');

                // console.log(Rows)

                for (var i = 0; i < Rows.length; i++) {

                    var column = $(Rows[i]).text().toLowerCase();

                    // console.log(column)

                    if (column.indexOf(searchText) === -1) {
                        $(Rows[i]).fadeOut();
                    } else {
                        $(Rows[i]).fadeIn();
                    }
                }
            });


        });
    </script>

</body>

</html>