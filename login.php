<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <title>Login</title>
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
            <div class="col-md-12 d-flex justify-content-center align-items-center p-5">
                <div class="card p-3 shadow-sm" style="width: 30rem;">
                    <div id="alert">

                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <h5 class="d-flex justify-content-center text-uppercase p-3 mb-5">Login Form</h5>
                            <input type="email" name="userLoginEmail" id="userEmail" placeholder="User Email" class="form-control mb-4" autocomplete="off" required>
                            <input type="password" name="userLoginPassword" id="userPassword" placeholder="User Password" class="form-control mb-4" autocomplete="off" required>
                            <div class="d-flex justify-content-between">
                                <input type="submit" value="Login" class="btn btn-primary mb-3 w-50">
                                <a href="resetPass.php" class="link-danger link-offset-3  link-underline-opacity-25 link-underline-opacity-100-hover">Forgot Password?</a>

                            </div>
                            <hr>
                            <p class="mt-4">
                                <span class="text-secondary">No Account?</span>
                                <a href="signUp.php" class="mt-3 w-100">Signup</a>
                            </p>
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

            // ----------------------------- Login -----------------------------


            $('#loginForm').on('submit', function(e) {

                e.preventDefault();

                var loginForm = new FormData(this);

                loginForm.append('LoginForm', 'userLogin');



                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: loginForm,
                    processData: false,
                    contentType: false,
                    success: function(loginResponse) {

                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = loginResponse.replace(stringToRemove, "");

                        if (loginResponse == 1) {

                            window.location.href = "admin/dashboard.php";

                        }

                        if (loginResponse == 0) {


                            window.location.href = "index.php";

                        }

                        if (loginResponse == 11)
                            window.location.href = "setAdmin.php";

                        if (loginResponse != 1 && loginResponse != 0)
                            $('#alert').html(loginResponse);


                    },
                    error: function() {
                        alert("Login Ajax conn Error");
                    }
                });

            });

        });
    </script>

</body>

</html>