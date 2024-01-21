<?php include_once 'session.php';
require_once '../users.php';

$user = new Users();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Update Users</title>
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
                        <div class="row bg-body shadow-sm" style="border-radius: 4px;">
                            <div class="col-6 p-3 text-uppercase d-flex justify-content-start align-items-center">
                                Update User Data
                            </div>
                            <div class="col-6 p-3 d-flex justify-content-end align-items-center">
                                <a href="users.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="row mt-3 shadow-sm bg-body" style="border-radius: 4px;">
                            <div class="col-md-4 p-4 bg-light">
                                <span class="text-primary h6 d-flex justify-content-center mb-4">Update User Picture</span>
                                <form id="updateUserPic" class="mb-5"> <!-- User Picture Update -->
                                    <input type="text" name="userPicID" id="userPicID" class="form-control mb-3 text-uppercase" value="<?php echo $_GET['id']; ?>" readonly>
                                    <input type="file" name="updateUserPicture" id="updateUserPicture" autocomplete="off" class="form-control mb-5" required>
                                    <input type="submit" value="Update" class="btn btn-primary btn-sm">
                                </form>

                                <hr>

                                <span class="text-primary mt-5 h6 d-flex justify-content-center mb-4">Update User Password</span>

                                <form id="updateUserPass"> <!-- User Password Update -->
                                    <input type="text" name="userPassID" id="userPassID" class="form-control mb-3 text-uppercase" value="<?php echo $_GET['id']; ?>" readonly>

                                    <label for="userPass" class="form-label text-secondary">User Password:</label>
                                    <input type="password" name="userPass" id="userPass" autocomplete="off" class="form-control mb-3" required>

                                    <label for="userConfirmPass" class="form-label text-secondary">Confirm Password:</label>
                                    <input type="password" name="userConfirmPass" id="userConfirmPass" autocomplete="off" class="form-control mb-3" required>

                                    <input type="submit" value="Update" class="btn btn-primary btn-sm">
                                </form>
                            </div>
                            <div class="col-md-8 p-4"> <!-- User Details Update -->
                                <span class="text-primary h6 d-flex justify-content-center mb-4">Update User Details</span>
                                <form id="updateUserDetails">
                                    <input type="text" name="userDetailsID" id="userDetailsID" class="form-control mb-3 text-uppercase" value="<?php echo $_GET["id"] ?>" readonly>



                                    <label for="userName" class="form-label text-secondary">User Name:</label>
                                    <input type="text" name="userName" id="userName" autocomplete="off" value="<?php echo $user->getName($_GET['id']);  ?>" class="form-control mb-3" required>

                                    <label for="userEmail" class="form-label text-secondary">User Email:</label>
                                    <input type="email" name="userEmail" id="userEmail" value="<?php echo $user->getEmail($_GET['id']);  ?>" autocomplete="off" class="form-control mb-3" required>

                                    <label for="userMobile" class="form-label text-secondary">User Mobile Number:</label>
                                    <input type="number" name="userMobile" value="<?php echo $user->getMobileNum($_GET['id']);  ?>" id="userMobile" autocomplete="off" class="form-control mb-3" required>

                                    <label for="userAddress" class="form-label text-secondary">User Address</label>
                                    <textarea class="form-control mb-3" name="userAddress" id="userAddress" rows="3"><?php echo $user->getAddress($_GET['id']);  ?></textarea>

                                    <input type="submit" value="Update" class="btn btn-primary btn-sm">
                                </form>
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

            // ---------------------------- Update User Image ----------------------------

            $('#updateUserPic').on('submit', function(e) {

                e.preventDefault();

                var updateUserPicture = new FormData(this);

                updateUserPicture.append("updateUserImage", 'updating');

                $.ajax({
                    url: 'hand.php',
                    data: updateUserPicture,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(updateUserPicResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = updateUserPicResponse.replace(stringToRemove, "");

                        $('#updateUserPic').trigger('reset');

                        alert(modifiedString);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            });

            // ---------------------------- Update User Details ----------------------------

            $('#updateUserDetails').on('submit', function(e) {

                e.preventDefault();

                var updateUserDetailsF = new FormData(this);

                updateUserDetailsF.append("updateUserD", 'updating');

                $.ajax({
                    url: 'hand.php',
                    data: updateUserDetailsF,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(udpateUserDResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = udpateUserDResponse.replace(stringToRemove, "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            });

            // ---------------------------- Update User Password ----------------------------

            $('#updateUserPass').on('submit', function(e) {

                e.preventDefault();

                var updateUserPass = new FormData(this);

                updateUserPass.append("updateUserPassword", 'updating');

                $.ajax({
                    url: 'hand.php',
                    data: updateUserPass,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(updateUserPassResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = updateUserPassResponse.replace(stringToRemove, "");

                        $('#updateUserPass').trigger('reset');

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