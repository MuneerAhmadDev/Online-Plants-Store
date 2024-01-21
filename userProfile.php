<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Profile</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->


    <?php


    if (!isset($_SESSION['User_ID'])) {
        header("Location: index.php");
    }

    include_once 'users.php';

    $obj = new Users();

    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 p-5">
                <div class="row shadow" style="border-radius: 4px;">
                    <div class="col-md-4 p-3 bg-light">
                        <div class="row">
                            <div class="col-md-12 p-3">
                                <span class="d-flex justify-content-center text-uppercase h6 mb-3">Profile Picture</span>
                                <div id="loadImage" class="text-center">
                                    <?php
                                    if ($obj->getImage($_SESSION['User_ID']) != "")
                                        echo '<img src="' . $obj->getImage($_SESSION["User_ID"]) . '" alt="userProfileImage" width="160px" height="160px">';
                                    else
                                        echo '<img src="admin/assets/images/avatar.png" alt="userProfileImage" width="160px" height="160px">';
                                    ?>
                                </div>
                                <form id="updateUserProfilePic" class="mt-4">
                                    <input type="text" name="userPicID" id="userPicID" class="form-control text-uppercase mb-4" value="<?php echo $_SESSION['User_ID']; ?>" readonly>
                                    <input type="file" name="userProfilePic" id="userProfilePic" class="form-control mb-2" required>
                                    <p class="text-danger" style="font-size: 14px;">The format for Picture must be (jpg, png, jpeg).</p>
                                    <input type="submit" value="Update" class="btn btn-primary mt-3">
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 p-3">
                                <span class="d-flex justify-content-center text-uppercase h6 mb-3">User Password</span>

                                <form id="updateUserPass">
                                    <label for="userID" class="form-label text-secondary">User ID:</label>
                                    <input type="text" name="userPassID" id="userID" class="form-control mb-3 text-uppercase" value="<?php echo $_SESSION['User_ID'] ?>" readonly>

                                    <input type="password" name="uoldPass" id="oldPass" placeholder="Enter Old Password" class="form-control mb-3" autocomplete="off" required>

                                    <input type="password" name="unewPass" id="newPass" placeholder="Enter New Password" class="form-control mb-3" autocapitalize="off" required>

                                    <input type="password" name="uconfirmNewPass" id="confirmNewPass" placeholder="Confirm Password" class="form-control mb-4" autocapitalize="off" required>

                                    <input type="submit" value="Update" class="btn btn-primary">
                                    <input type="reset" value="Rest" class="btn btn-dark">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 p-5">
                        <span class="d-flex justify-content-center text-uppercase h6 mb-3">Profile Details</span>

                        <form id="updateProfileDetails">
                            <label for="userDID" class="form-label text-secondary">User ID:</label>
                            <input type="text" name="userDID" id="userDID" class="form-control mb-4 text-uppercase" value="<?php echo $_SESSION['User_ID'] ?>" readonly>

                            <label for="userName" class="form-label text-secondary">User Name:</label>
                            <input type="text" name="userName" id="userName" value="<?php echo $obj->getName($_SESSION['User_ID']); ?>" class="form-control mb-4" autocomplete="off" required>


                            <label for="userEmail" class="form-label text-secondary">User Email:</label>
                            <input type="email" name="userEmail" id="userEmail" value="<?php echo $obj->getEmail($_SESSION['User_ID']); ?>" class="form-control mb-4" autocomplete="off" required>

                            <label for="userMobile" class="form-label text-secondary">User Mobile:</label>
                            <input type="number" name="userMobile" id="userMobile" value="<?php echo $obj->getMobileNum($_SESSION['User_ID']); ?>" class="form-control mb-4" autocomplete="off" required>

                            <label for="userAddress" class="form-label text-secondary">User Address:</label>
                            <textarea class="form-control mb-4" name="userAddress" id="userAddress" rows="3"><?php echo html_entity_decode($obj->getAddress($_SESSION['User_ID'])); ?></textarea>

                            <input type="submit" value="Update" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ==================== Footer Section ==================== -->

    <?php include 'components/footer.php'; ?>

    <!-- ==================== Footer Section ==================== -->


    <?php include_once "javaScriptLinks.php" ?>
    <script>
        $(document).ready(function() {


            // ----------------------------- load Navbar -----------------------------


            loadNavbar();


            // ----------------------------- update User Profile Pic -----------------------------


            $('#updateUserProfilePic').on('submit', function() {

                var updateProfilePic = new FormData(this);

                updateProfilePic.append("updatePic", 'updating');

                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: updateProfilePic,
                    contentType: false,
                    processData: false,
                    success: function(updateProfilePicResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = updateProfilePicResponse.replace(stringToRemove, "");

                        alert(modifiedString);

                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            });


            // ----------------------------- update User Profile Details -----------------------------


            $('#updateProfileDetails').on('submit', function() {

                var updateProfileD = new FormData(this);

                updateProfileD.append('updateProfileDe', "updating");

                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: updateProfileD,
                    processData: false,
                    contentType: false,
                    success: function(updateProfileDetailResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = updateProfileDetailResponse.replace(stringToRemove, "");

                        alert(modifiedString);

                    },
                    error: function() {
                        alert("Error....");
                    }
                });

            });


            // ----------------------------- update User Password -----------------------------

            $('#updateUserPass').on('submit', function(e) {

                e.preventDefault();

                var userPassword = new FormData(this);

                userPassword.append('updateUserPass', 'updating');

                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: userPassword,
                    contentType: false,
                    processData: false,
                    success: function(updateUserPassResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = updateUserPassResponse.replace(stringToRemove, "");

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