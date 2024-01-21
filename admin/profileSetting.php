<?php

include_once 'session.php';

include_once 'include/classes/adminClass.php';

$obj = new Admin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Profile</title>
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
                        <div class="row">
                            <div class="col-md-12 bg-body p-3 rounded">

                                <ul class="nav nav-pills nav-fill mb-4" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pic" type="button" role="tab">Profile Picture</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab">Personal Info</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab">Password</button>
                                    </li>

                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pic" role="tabpanel" tabindex="0">
                                        <div class="row">
                                            <div class="col-md-12 p-3 bg-body">
                                                <!-- Profile Picture -->
                                                <form id="profilePicForm">
                                                    <div class="row bg-body" style="border-radius: 4px;">
                                                        <div class="col-md-3 d-flex justify-content-center align-items-center p-4">
                                                            <?php

                                                            echo '<img src="' . $obj->getImage() . '" alt="Profile Picture" width="120px" height="120px" style="border-radius: 4px; cursor: pointer;"  data-bs-toggle="modal" data-bs-target="#adminProfilePic">';

                                                            ?>
                                                        </div>
                                                        <div class="col-md-6 d-flex justify-content-center align-items-center p-4">
                                                            <input type="file" name="profilePicture" id="profilePic" class="form-control">
                                                        </div>
                                                        <div class="col-md-3 p-4 d-flex justify-content-start align-items-center">
                                                            <input type="submit" value="Save" id="saveProfilePic" class="btn btn-primary">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="info" role="tabpanel" tabindex="0">
                                        <div class="row">
                                            <div class="col-md-12 p-4 bg-body">
                                                <h4 class="mb-4">Personal Information</h4>
                                                <?php
                                                $remData = new Admin();
                                                ?>
                                                <form id="remData">

                                                    <label for="name" class="form-label text-secondary">Admin Name:</label>
                                                    <input type="text" name="name" id="name" value="<?php echo $remData->getName(); ?>" placeholder="Name" class="form-control mb-4" autocomplete="off" required>


                                                    <label for="email" class="form-label text-secondary">Admin Email:</label>
                                                    <input type="email" name="email" id="email" value="<?php echo $remData->getEmail(); ?>" placeholder="Email" class="form-control mb-4" autocomplete="off" required>

                                                    <label for="mobile" class="form-label text-secondary">Admin Mobile Number:</label>
                                                    <input type="number" name="mobile" id="mobile" value="<?php echo $remData->getMobileNumber(); ?>" placeholder="Mobile Number" class="form-control mb-4" autocomplete="off" required>

                                                    <label for="address" class="form-label text-secondary">Admin Address:</label>
                                                    <textarea class="form-control mb-4" name="address" id="address" rows="2" placeholder="Address"><?php echo $remData->getAddress(); ?></textarea>


                                                    <input type="submit" value="Save" id="saveRemData" class="btn btn-primary">


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel" tabindex="0">
                                        <div class="row">
                                            <div class="col-12 p-4 bg-body">
                                                <h4 class="mb-4">Change Password</h4>
                                                <form id="passUpdate">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="password" name="oldPass" id="oldPass" placeholder="Old Password" autocomplete="off" class="form-control mb-4" required>
                                                            <input type="password" name="newPass" id="newPass" placeholder="New Password" autocomplete="off" class="form-control mb-4" required>
                                                            <input type="password" name="cfrmPass" id="cfrmPass" placeholder="Confirm Password" autocomplete="off" class="form-control mb-4" required>
                                                            <input type="submit" value="Save" id="savePass" class="btn btn-primary">
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
                </div>
            </div>

            <!-- ========== Page Content -> Actual Content ========== -->
            <?php include_once 'components/footer.php'; ?>

        </div>

        <!-- ==================== Page Content ==================== -->
    </div>

    <!-- Profile Picture Modal -->

    <div class="modal fade" id="adminProfilePic" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adminProfilePicLabel">Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <?php

                    include_once 'include/classes/adminClass.php';

                    $obj = new Admin();

                    echo '<img src="' . $obj->getImage() . '" alt="Profile Picture" width="300px" height="300px" style="border-radius: 4px;">';

                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </div>


    <?php include_once "jsLinks.php"; ?>

    <script>
        $(document).ready(function() {

            // --------------------- Profile Picture Update ---------------------

            $('#profilePicForm').on('submit', function(e) {

                var picFormData = new FormData(this);

                picFormData.append('type', 'profilePic');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: picFormData,
                    contentType: false,
                    processData: false,
                    success: function(picResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = picResponse.replace(stringToRemove, "");

                        alert(modifiedString);

                    },
                    error: function() {
                        alert('Profile Pic ajax con Error');
                    }
                });

            });

            // --------------------- Profile Data Update ---------------------

            $('#remData').on('submit', function(e) {

                var remFormData = new FormData(this);

                remFormData.append('restData', 'RemainingData');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: remFormData,
                    contentType: false,
                    processData: false,
                    success: function(remResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = remResponse.replace(stringToRemove, "");

                        alert(modifiedString);

                    },
                    error: function() {
                        alert('Profile Remaining Data ajax con Error');
                    }
                });

            });

            // --------------------- Password Update ---------------------

            $('#passUpdate').on('submit', function(e) {

                e.preventDefault();

                var passFormData = new FormData(this);

                passFormData.append('pass', 'passUpdateData');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: passFormData,
                    contentType: false,
                    processData: false,
                    success: function(passResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = passResponse.replace(stringToRemove, "");

                        alert(modifiedString);

                        $('#passUpdate').trigger('reset');

                    },
                    error: function() {
                        alert('Password Data ajax con Error');
                    }
                });

            });

        });
    </script>

</body>

</html>