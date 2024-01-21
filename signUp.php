<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Signup</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>

    <!-- ================== Header 1 ================== -->

    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>

    <!-- ================== Navbar ================== -->

    <!-- ==================== Header Section ==================== -->



    <!-- ==================== Form Section ==================== -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center p-4">
                <div class="card p-3 shadow-sm" style="width: 30rem;">
                    <div class="card-body">
                        <form id="signupForm">
                            <h6 class="d-flex justify-content-center align-items-center p-3 mb-5" style="border-radius: 4px;">Registration Form</h6>
                            <input type="text" name="userName" id="userName" placeholder="User Name" class="form-control mb-4" autocomplete="off" required>
                            <input type="email" name="userEmail" id="userEmail" placeholder="abc@gmail.com" class="form-control mb-4" autocomplete="off" required>
                            <input type="number" name="userMobile" id="userMobile" placeholder="03012345678" class="form-control mb-4" autocomplete="off" required>
                            <input type="password" name="userPassword" id="userPassword" placeholder="User Password" class="form-control mb-4" required>
                            <input type="password" name="userConfirmPass" id="userConfirmPass" placeholder="Confirm Password" class="form-control mb-5" required>
                            <div class="d-flex justify-content-around align-items-center">
                                <input type="submit" value="Signup" class="btn btn-primary mb-3 w-50">
                                <input type="reset" value="Reset Form" class="mb-3 w-25 btn btn-warning">
                            </div>
                            <hr>
                            <a href="login.php" class="btn btn-secondary mt-3 w-100">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Form Section ==================== -->



    <!-- ==================== Footer Section ==================== -->

    <?php include 'components/footer.php'; ?>

    <!-- ==================== Footer Section ==================== -->


    <?php include_once "javaScriptLinks.php" ?>

    <script>
        $(document).ready(function() {

            // ----------------------------- load Navbar -----------------------------


            loadNavbar();


            // ----------------------------- Signin -----------------------------


            $('#signupForm').on('submit', function(e) {

                e.preventDefault();

                var signUP = new FormData(this);

                signUP.append('userSignup', 'new User');

                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: signUP,
                    processData: false,
                    contentType: false,
                    success: function(signUpResponse) {
                        var stringToRemove = "<!-- hslkj -->";
                        var modifiedString = signUpResponse.replace(stringToRemove, "");
                        alert(modifiedString);
                    },
                    error: function() {
                        alert("Signup Ajax conn Error");
                    }
                });

            });

        });
    </script>

</body>

</html>