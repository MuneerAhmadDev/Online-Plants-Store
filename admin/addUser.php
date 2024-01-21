<?php include_once 'session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Add User</title>
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
                                Add New User
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="users.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row bg-body shadow-sm mt-3" style="border-radius: 4px;">
                            <div class="col-md-12 p-4" style="border-radius: 2px;">
                                <form id="addUser">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="userPic" class="form-label text-secondary">User Picture <span class="text-danger h4">*</span></label>
                                            <input type="file" name="userPic" id="userPic" class="form-control" required>
                                            <p class="text-danger" style="font-size: 14px;">The format for Picture must be (jpg, png, jpeg).</p>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="userName" class="form-label text-secondary">User Name <span class="text-danger h4">*</span></label>
                                            <input type="text" name="userName" id="userName" placeholder="User Name" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="userEmail" class="form-label text-secondary">User Email <span class="text-danger h4">*</span></label>
                                            <input type="email" name="userEmail" id="userEmail" placeholder="abc@gmail.com" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="userPass" class="form-label text-secondary">User Password <span class="text-danger h4">*</span></label>
                                            <input type="password" name="userPass" id="userPass" placeholder="User Password" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="userMobile" class="form-label text-secondary">User Mobile Number<span class="text-danger h4">*</span></label>
                                            <input type="number" name="userMobile" id="userMobile" placeholder="03012345678" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="userAddress" class="form-label text-secondary">User Address <span class="text-danger h4">*</span></label>
                                            <textarea class="form-control" id="userAddress" name="userAddress" placeholder="User Address" rows="3" required></textarea>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <input type="submit" value="Add User" class="btn btn-primary">
                                            <input type="reset" value="Reset Form" class="ms-2 btn btn-warning">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== Page Content -> Actual Content ========== -->



            <!-- ==================== Page Content ==================== -->
            <?php include_once 'components/footer.php'; ?>

        </div>
    </div>


    <?php include_once "jsLinks.php"; ?>
    <script>
        $(document).ready(function() {

            // --------------------- Add User ---------------------

            $('#addUser').on('submit', function(e) {

                e.preventDefault();

                var addNewUser = new FormData(this);

                addNewUser.append('AddNewU', "New User");

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: addNewUser,
                    processData: false,
                    contentType: false,
                    success: function(addUserResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = addUserResponse.replace(stringToRemove, "");

                        alert(modifiedString);

                    },
                    error: function() {
                        alert("Error....");
                    }

                });

            });

        });
    </script>
</body>

</html>