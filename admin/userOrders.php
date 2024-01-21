<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
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
                                All Users Orders
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-body p-4" style="border-radius: 4px;">
                                <input type="text" name="userOrderSearch" id="userOrderSearch" placeholder="Search Order by User ID" autocomplete="off" class="form-control mb-4">
                                <div class="table-responsive" id="userOrder">

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
                    order: 'userOrder'
                },
                success: function(userOrderResponse) {
                    $('#userOrder').html(userOrderResponse);
                },
                error: function() {
                    alert("Error...");
                }
            });

            // ------------------ Searching ------------------


            $('#userOrderSearch').on('keyup', function() {

                var searchTerm = $('#userOrderSearch').val();

                if (searchTerm != "") {
                    $.ajax({
                        url: 'hand.php',
                        type: 'POST',
                        data: {
                            searchOrder: searchTerm
                        },
                        success: function(orderSearchRespone) {
                            $('#userOrder').html(orderSearchRespone);
                        },
                        error: function() {
                            alert("Error");
                        }
                    });
                } else
                    location.reload();
            });

            // ------------------ Update Order Status ------------------

            $(document).on('change', '#orderStatus', function() {

                var selectedOption = $(this).find('option:selected');

                var value = selectedOption.val();

                var orderID = selectedOption.data('odrid');

                var userID = selectedOption.data('usid');

                var dataToSend = {
                    changeStatus: value,
                    id: orderID,
                    userid: userID
                };

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: dataToSend,
                    success: function(updateStatusResponse) {

                        var stringToRemove = "0";

                        var modifiedString = updateStatusResponse.replace(stringToRemove, "");

                        if (modifiedString == "done")
                            location.reload();
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            });


        });
    </script>

</body>

</html>