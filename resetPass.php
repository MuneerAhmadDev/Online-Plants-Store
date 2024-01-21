<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Recover Password</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->




    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 bg-body shadow rounded p-5">

                <div class="alertMessage">

                </div>

                <h4 class="text-center mb-4">Recover Password</h4>

                <form id="resetPass">

                    <div class="mb-3">
                        <label for="resetPassEmail" class="form-label">Email</label>
                        <input type="email" name="resetPassEmail" id="resetPassEmail" class="form-control" autocomplete="off" required>
                    </div>

                    <input type="submit" value="Send Reset Password Link" class="btn btn-success mt-3">
                    <p class="text-danger mt-4">Note: Enter Email on which account is created.</p>

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


            // ----------------------------- Recover Password -----------------------------

            $('#resetPass').on('submit', function(e) {

                var resetPass = new FormData(this);

                resetPass.append("Rest", "Pass");

                $.ajax({

                    url: 'ajaxHandler.php',

                    type: 'POST',

                    data: resetPass,

                    contentType: false,

                    processData: false,

                    success: function(resetPassResponse) {
                        $('.alertMessage').html(resetPassResponse);
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