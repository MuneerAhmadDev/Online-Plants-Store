<?php


if ((!isset($_GET['userID'])) && (!isset($_GET['Role'])))
    header("Location: index.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Set New Password</title>
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
            <div class="col-md-12 rounded p-5 bg-body shadow">

                <h4 class="text-center mb-5">Set New Password</h4>

                <form id="newPassForm">

                    <div class="mb-3">

                        <input type="hidden" class="form-control" name="role" id="role" value="<?php echo $_GET['Role'] ?>">

                    </div>

                    <div class="mb-3">

                        <input type="hidden" class="form-control" name="userID" id="userID" value="<?php echo $_GET['userID'] ?>">

                    </div>

                    <div class="mb-3">

                        <label for="newPass" class="form-label">Password</label>

                        <input type="password" class="form-control" name="newPassSet" id="newPass" autocomplete="off" required>

                    </div>

                    <div class="mb-3">

                        <label for="confirmPass" class="form-label">Confirm Password</label>

                        <input type="password" class="form-control" name="confirmPassSet" id="confirmPass" autocomplete="off" required>
                    </div>

                    <input type="submit" value="Reset Password" class="btn btn-success mt-3">

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


            // ----------------------------- Add new forgoten pass -----------------------------


            $('#newPassForm').on('submit', function(e) {

                e.preventDefault();

                var addNewPass = new FormData(this);

                addNewPass.append('newPass', 'adding');

                $.ajax({

                    url: 'ajaxHandler.php',

                    type: 'POST',

                    data: addNewPass,

                    contentType: false,

                    processData: false,

                    success: function(addNewPassResponse) {
                        alert(addNewPassResponse);
                        $('#newPassForm').trigger('reset');
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