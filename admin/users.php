<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Users</title>
</head>

<body>
    <div class="d-flex" id="wrapper">

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
                                <a href="addUser.php" class="btn btn-primary">Add User</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-body p-4" style="border-radius: 4px;">
                                <h5 class="mb-3">All Users</h5>
                                <input type="text" name="userSearch" id="userSearch" placeholder="Search" autocomplete="off" class="form-control mb-4">
                                <div class="table-responsive" id="usersTable">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== Page Content -> Actual Content ========== -->


            <!-- Users Details Model -->

            <div class="modal fade" id="userDet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Users Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="showUsers">
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

        <!-- ==================== Page Content ==================== -->

    </div>


    <?php include_once "jsLinks.php"; ?>
    <script>
        $(document).ready(function() {

            // ---------------------- load User Data ----------------------

            function loadUsersTable() {

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: {
                        loadUsersTableData: 'loadUsers'
                    },

                    success: function(res) {
                        $('#usersTable').html(res);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            }

            loadUsersTable();

            // ------------------ Show User Details info Modal ------------------

            $(document).on('click', '.userDetails', function() {

                var uID = $(this).data('detus');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: {
                        userID: uID
                    },
                    success: function(response) {
                        $('#showUsers').html(response);
                    },
                    error: function() {
                        alert("Error...");
                    }
                });

            });

            // ------------------ Delete User ------------------

            $(document).on('click', '.deleteUser', function() {

                var userID = $(this).data('usid');

                var element = this;

                if (confirm("Are you sure you want to delete this user?")) {

                    $.ajax({
                        url: 'hand.php',
                        type: 'POST',
                        data: {
                            delUser: userID
                        },
                        success: function(delUserResponse) {

                            if ('deluserResponse' != 1) {

                                $(element).closest('tr').fadeOut();

                                loadUsersTable();
                            }

                        }
                    });

                }

            });


            // ------------------ Searching ------------------

            $('#userSearch').keyup(function() {

                var searchText = $(this).val().toLowerCase();

                var Rows = $('#usersTable tbody tr');

                for (var i = 0; i < Rows.length; i++) {

                    var column = $(Rows[i]).text().toLowerCase();

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