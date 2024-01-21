<?php

include_once 'admin/include/classes/adminClass.php';

$admin = new Admin();

if (!empty($admin->getEmail())) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Set Admin</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 p-5 rounded bg-body shadow">

                <div class="alertMessage">

                </div>

                <h4 class="text-center mb-4">Set Admin</h4>

                <form id="setAdmin">

                    <div class="mb-3">

                        <label for="adminName" class="form-label">Admin Name:</label>

                        <input type="text" class="form-control" name="adminName" value="Admin" id="adminName" autocomplete="off" required>

                    </div>

                    <div class="mb-3">

                        <label for="adminEmail" class="form-label">Admin Email:</label>

                        <input type="email" class="form-control" name="adminEmail" id="adminEmail" placeholder="abc@mail.com" autocomplete="off" required>

                    </div>

                    <div class="mb-3">

                        <label for="adminPass" class="form-label">Password</label>

                        <input type="password" class="form-control" name="adminPass" id="adminPass" required>

                    </div>

                    <div class="mb-3">

                        <label for="confirmPass" class="form-label">Confirm Password</label>

                        <input type="password" class="form-control" name="confirmPass" id="confirmPass" required>

                    </div>

                    <input type="submit" value="Set Admin" class="btn btn-success mt-4">

                </form>

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


            // ----------------------------- Set Admin -----------------------------

            $('#setAdmin').on('submit', function(e) {

                e.preventDefault();

                var setAdmin = new FormData(this);

                setAdmin.append("set", 'admin');

                $.ajax({

                    url: 'ajaxHandler.php',

                    type: 'POST',

                    data: setAdmin,

                    contentType: false,

                    processData: false,

                    success: function(setAdminResponse) {

                        if (setAdminResponse == 'done')
                            location.reload();

                        $('.alertMessage').html(setAdminResponse);

                    },

                    error: function() {
                        alert("Erro");
                    }

                });

            });


        });
    </script>
</body>

</html>