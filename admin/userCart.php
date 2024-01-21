<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
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

            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="row mb-4">
                            <div class="col-md-12 text-uppercase p-3 bg-body" style="border-radius: 4px;">
                                All Users Cart
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-body p-4" style="border-radius: 4px;">
                                <input type="text" name="userCartSearch" id="userCartSearch" placeholder="Search Cart by User ID" autocomplete="off" class="form-control mb-4">
                                <div class="table-responsive" id="usersCart">

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

            // --------------------- Show User Cart ---------------------

            $.ajax({
                url: 'hand.php',
                type: 'POST',
                data: {
                    cart: 'usercart'
                },
                success: function(userCartResponse) {
                    $('#usersCart').html(userCartResponse);
                },
                error: function() {
                    alert("Error...");
                }
            });


            // ------------------ Searching ------------------

            $('#userCartSearch').on('keyup', function() {

                var searchTerm = $('#userCartSearch').val();

                if (searchTerm != "") {
                    $.ajax({
                        url: 'hand.php',
                        type: 'POST',
                        data: {
                            searchCart: searchTerm
                        },
                        success: function(cartSearchRespone) {
                            $('#usersCart').html(cartSearchRespone);
                        },
                        error: function() {
                            alert("Error");
                        }
                    });
                } else
                    location.reload();
            });



        });
    </script>

</body>

</html>