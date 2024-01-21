<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/*

==================================================================
||
||          User Ajax handling Code
||
==================================================================
||
|| It hold the code related to user(customer) of the Website.
||

*/

// ============================================= Create New User Account =============================================

if (isset($_POST['userSignup'])) {

    include 'users.php';

    $newUser = new Users();

    $userName = $_POST['userName'];

    $userEmail = strtolower($_POST['userEmail']);

    $userMobile = $_POST['userMobile'];

    $userPassword = $_POST['userPassword'];

    $confirmPassword = $_POST['userConfirmPass'];

    if ($newUser->userExist($userEmail) == $userEmail)
        echo "Users Account Already Exist";
    else {
        if ($userPassword == $confirmPassword) {
            if ($newUser->newUser($userName, $userEmail, $userMobile, $userPassword)) {
                echo "Account Created. Please click on Login Button to Login.";
            }
        } else
            echo "Confirm Password not match.";
    }
}

// ============================================= User / Admin  Login =============================================


if (isset($_POST['LoginForm'])) {

    $userLoginEmail = strtolower($_POST['userLoginEmail']);

    $userLoginPass = $_POST['userLoginPassword'];

    if (filter_var($userLoginEmail, FILTER_VALIDATE_EMAIL)) {

        include 'users.php';

        include_once 'admin/include/classes/adminClass.php';

        $adminLogin = new Admin();

        $userLogin = new Users();

        if (empty($adminLogin->getEmail())) {

            //  If Admin not set then set admin.

            echo 11;
        } else {

            // Login process for user and admin

            // Admin Login Checking

            if ($adminLogin->adminLogin($userLoginEmail, $userLoginPass)) {

                session_start();

                $_SESSION['AdminEmail'] = "Admin";


                echo 1;
            } else {

                // User Login Checking

                if ($userLogin->userLogin($userLoginEmail, $userLoginPass)) {

                    session_start();

                    $_SESSION['User_ID'] = $userLogin->getUserLoginID($userLoginEmail);

                    echo 0;
                } else {
                    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                 Wrong Email or Password
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            }
        }
    } else
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Invalid Email Address
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
}


// ============================================= Set Admin =============================================

if (isset($_POST['set'])) {

    //     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    //     <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';



    $pass = $_POST['adminPass'];

    $confirmPass = $_POST['confirmPass'];

    include_once 'admin/include/classes/adminClass.php';

    $setAdmin = new Admin();

    if ($pass == $confirmPass) {
        if ($setAdmin->updateProfile($_POST['adminName'], strtolower($_POST['adminEmail']), "", "")) {

            if ($setAdmin->setPassword($pass)) {

                echo "done";
            } else
                echo "Admin Set Error";
        }
    } else
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Confirm Password not match
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
}



// ============================================= User / Admin  Password Recoover =============================================


if (isset($_POST['Rest'])) {

    $restPassEmail = strtolower($_POST['resetPassEmail']);


    // echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    //             <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //         </div>';



    include_once 'admin/include/classes/adminClass.php';

    include_once 'admin/include/classes/siteSettingClass.php';

    include_once 'users.php';


    $adminRestPass = new Admin();

    $userRestPass = new Users();

    $siteSetting = new SiteSetting();

    if (filter_var($restPassEmail, FILTER_VALIDATE_EMAIL)) {


        // Checking Admin Email

        if ($adminRestPass->getEmail() == $restPassEmail) {

            // Recovering Admin Password


            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';

            //Create an instance; passing `true` enables exceptions

            $mail = new PHPMailer(true);

            try {

                //Server settings

                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $siteSetting->getRecoveryEmail();                     //SMTP username
                $mail->Password   = $siteSetting->getRecoveryEmailPass();                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients


                $mail->setFrom($siteSetting->getRecoveryEmail(), $siteSetting->getName());
                $mail->addAddress($restPassEmail);     //Add a recipient //Name is optional
                $mail->addReplyTo($siteSetting->getRecoveryEmail(), $siteSetting->getName());


                //Content

                $link = "http://localhost/OnlinePlantsStore/newPass.php?userID=1&Role=1";

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Recovery';
                $mail->Body    = $link;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if ($mail->send())
                    echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else if ($userRestPass->userExist($restPassEmail)) {

            // Checking User Email

            // Recovering user Password

            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';

            //Create an instance; passing `true` enables exceptions

            $mail = new PHPMailer(true);

            try {

                //Server settings

                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $siteSetting->getRecoveryEmail();                     //SMTP username
                $mail->Password   = $siteSetting->getRecoveryEmailPass();                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients


                $mail->setFrom($siteSetting->getRecoveryEmail(), $siteSetting->getName());
                $mail->addAddress($restPassEmail);     //Add a recipient //Name is optional
                $mail->addReplyTo($siteSetting->getRecoveryEmail(), $siteSetting->getName());


                //Content

                $link = "http://localhost/OnlinePlantsStore/newPass.php?userID=" . $userRestPass->getUserLoginID($restPassEmail) . "&Role=0";

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Recovery';
                $mail->Body    = $link;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if ($mail->send())
                    echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {

            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Email dos not register 
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    } else
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Invalid Email
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
}

// ============================================= Add New Forgoten Pass =============================================

if (isset($_POST['newPass'])) {

    $newPassSet = $_POST['newPassSet'];
    $confirmPassSet = $_POST['confirmPassSet'];
    $Role = $_POST['role'];
    $userID = $_POST['userID'];

    if ($newPassSet == $confirmPassSet) {

        if ($Role == 0) {

            include_once 'users.php';

            $newP = new Users();

            if ($newP->setPassword($userID, $newPassSet))
                echo "Password Reset";
        } else {

            include_once 'admin/include/classes/adminClass.php';

            $setAdminPass = new Admin();

            if ($setAdminPass->setForgotPassword($userID, $newPassSet))
                echo "Password Reset";
        }
    } else
        echo "Conform Password not match";
}



// ============================================= Update User Profile Pic =============================================

if (isset($_POST['updatePic'])) {

    $fileName = $_FILES['userProfilePic']['name'];

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    $validExtensions = array('jpg', 'jpeg', 'png');

    if (in_array($extension, $validExtensions)) {

        $newName = rand() . "." . $extension;

        $path = "admin/assets/images/userProfile/" . $newName;

        if (move_uploaded_file($_FILES['userProfilePic']['tmp_name'], $path)) {

            include_once 'users.php';

            $updatePic = new Users();

            if ($updatePic->updateProfilePic($path, $_POST['userPicID']))
                echo "Profile Picture Updated.";
            else
                echo "Profile Picture not Updated....";
        }
    } else
        echo "Invalid Picture type, Please Select (png, jpg, jpeg)";
}


// ============================================= Update User Profile Details =============================================

if (isset($_POST['updateProfileDe'])) {

    if (filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {

        include_once 'users.php';

        $updateDetails = new Users();

        if ($updateDetails->updateProfileDetails($_POST['userName'], strtolower($_POST['userEmail']), htmlentities($_POST['userAddress']), $_POST['userMobile'], $_POST['userDID']))
            echo "Profile Details Updated.";
        else
            echo "Profile Details not Updated.";
    } else {
        echo "Invalid Email Address, Please Check...";
    }
}


// ============================================= Update User Password =============================================

if (isset($_POST['updateUserPass'])) {

    $oldPassword = $_POST['uoldPass'];
    $newPassword = $_POST['unewPass'];
    $confirmNewPassword = $_POST['uconfirmNewPass'];

    if ($newPassword == $confirmNewPassword) {

        include_once 'users.php';

        $updateUserPass = new Users();

        if (password_verify($oldPassword, $updateUserPass->getPassword($_POST['userPassID']))) {

            if ($updateUserPass->updatePassword($newPassword, $_POST['userPassID']))
                echo "Password Updated.";
            else
                echo "Password not Updated.";
        } else
            echo "Old password not match.";
    } else
        echo "Confirm password not match.";
}



/*

==================================================================
||
||          Frontend Ajax handling Code
||        
||          Showing Product on index.html
||
==================================================================
||
|| It hold the code related to showing data on the frontend.
||

*/
// ============================================= Show Indoor Plants on Frontend (index.php) =============================================

if (isset($_POST['loadIndoorPlantData'])) {

    include 'admin/include/classes/database.php';

    $indoorPObj = new Database();

    $indoorPObj->select("ops_product", "*", null, "ProductCategory = 'Indoor Plants'", null, "8");

    $indoorPlantsData = "<h5>Indoor Plants</h5>";

    foreach ($indoorPObj->getResult() as $value) {

        $stockMess = ($value['ProductStock'] != 0) ? "<span class='badge rounded-pill text-bg-success'>Available</span>" : "<span class='badge rounded-pill text-bg-danger'>Out of Stock</span>";

        $indoorPlantsData .= '<div class="col-md-3 p-3">
                                <a href="prodD.php?id=' . $value['ProductID'] . '&cate=' . $value['ProductCategory'] . '" class="nav-link">
                                    <div class="card shadow text-center">
                                        
                                            <img src="http://localhost/OnlinePlantsStore/admin/' . $value['ProductPic'] . '" class="card-img-top" width="100px" height="200px">
                                        
                                        <div class="card-body">
                                            <h5 class="card-title text-secondary">' . $value['ProductName'] . '</h5>
                                            <p class="card-text fs-4 text-success fw-bold">Rs. ' . $value['ProductPrice'] . '</p>
                                            <p class="card-text" id="text-trun">' . $value['ProductDescription'] . '</p>
                                            <p class="card-text fst-italic fw-bold" id="text-trun">Category: ' . $value['ProductCategory'] . '</p>
                                                ' . $stockMess . ' <BR><BR>
                                        </div>
                                    </div>
                                </a>
                              </div>
                             ';
    }

    echo $indoorPlantsData;
}


// ============================================= Show Seeds on Frontend (index.php) =============================================

if (isset($_POST['loadSeedsPlantData'])) {

    include 'admin/include/classes/database.php';

    $indoorPObj = new Database();

    $indoorPObj->select("ops_product", "*", null, "ProductCategory = 'Seeds'", null, "8");

    $toolsData = "<h5>Seeds</h5>";

    foreach ($indoorPObj->getResult() as $value) {

        $stockMess = ($value['ProductStock'] != 0) ? "<span class='badge rounded-pill text-bg-success'>Available</span>" : "<span class='badge rounded-pill text-bg-danger'>Out of Stock</span>";

        $toolsData .= '<div class="col-md-3 p-3">
                                <a href="prodD.php?id=' . $value['ProductID'] . '&cate=' . $value['ProductCategory'] . '" class="nav-link">
                                    <div class="card shadow text-center">
                                        
                                            <img src="http://localhost/OnlinePlantsStore/admin/' . $value['ProductPic'] . '" class="card-img-top" width="100px" height="200px">
                                        
                                        <div class="card-body">
                                            <h5 class="card-title text-secondary">' . $value['ProductName'] . '</h5>
                                            <p class="card-text fs-4 text-success fw-bold">Rs. ' . $value['ProductPrice'] . '</p>
                                            <p class="card-text" id="text-trun">' . $value['ProductDescription'] . '</p>
                                            <p class="card-text fst-italic fw-bold" id="text-trun">Category: ' . $value['ProductCategory'] . '</p>
                                                ' . $stockMess . ' <BR><BR>
                                        </div>
                                    </div>
                                </a>
                              </div>
                             ';
    }

    echo $toolsData;
}



// ============================================= Show IndoorFlower on Frontend (index.php) =============================================

if (isset($_POST['loadIndoorFlowerData'])) {

    include 'admin/include/classes/database.php';

    $indoorPObj = new Database();

    $indoorPObj->select("ops_product", "*", null, "ProductCategory = 'Indoor Flowers'", null, "8");

    $toolsData = "<h5>Indoor Flower</h5>";

    foreach ($indoorPObj->getResult() as $value) {

        $stockMess = ($value['ProductStock'] != 0) ? "<span class='badge rounded-pill text-bg-success'>Available</span>" : "<span class='badge rounded-pill text-bg-danger'>Out of Stock</span>";

        $toolsData .= '<div class="col-md-3 p-3">
                                <a href="prodD.php?id=' . $value['ProductID'] . '&cate=' . $value['ProductCategory'] . '" class="nav-link">
                                    <div class="card shadow text-center">
                                        
                                            <img src="http://localhost/OnlinePlantsStore/admin/' . $value['ProductPic'] . '" class="card-img-top" width="100px" height="200px">
                                        
                                        <div class="card-body">
                                            <h5 class="card-title text-secondary">' . $value['ProductName'] . '</h5>
                                            <p class="card-text fs-4 text-success fw-bold">Rs. ' . $value['ProductPrice'] . '</p>
                                            <p class="card-text" id="text-trun">' . $value['ProductDescription'] . '</p>
                                            <p class="card-text fst-italic fw-bold" id="text-trun">Category: ' . $value['ProductCategory'] . '</p>
                                                ' . $stockMess . ' <BR><BR>
                                        </div>
                                    </div>
                                </a>
                              </div>
                             ';
    }

    echo $toolsData;
}


/*

==================================================================
||        
||          Showing Categories on index.html (navbar)
||
==================================================================
||
|| It hold the code related to showing data on the frontend.
||

*/

// ============================================= Show Categories on navabr on Frontend (index.php) =============================================

if (isset($_POST['loadNavbarData'])) {

    include 'database.php';

    $mainCat = new Database();

    $mainCat->select("ops_category", "CategoryName", null, null, null, null);

    $subCat = new Database();

    $menu = "<ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item me-4'><a href='index.php' class='nav-link'>Home</a></li>";


    foreach ($mainCat->getResult() as $value) {

        foreach ($value as $val) {

            $menu .= "<li class='nav-item dropdown'>";

            $menu .= '<a class="nav-link dropdown-toggle me-4" href="#" role="button" data-bs-toggle="dropdown">' . $val . '</a>';

            $subCat->select("ops_subcategory", "SubCategoryName", null, "ParentCategory = '$val'", null, null); // get subcategory based on parent

            $menu .= "<ul class='dropdown-menu'>";

            foreach ($subCat->getResult() as $items) { // concatenating subcategory with parent

                foreach ($items as $item) {

                    $menu .= "<li><a class='nav-link ps-3' href='navSearch.php?name=" . $item . "'>" . $item . "</a></li>";
                }
            }

            $menu .= "   </ul>
                      </li>";
        }
    }


    $menu .= "</ul>";

    echo $menu;
}



/*

==================================================================
||        
||          Session Checking & Adding Cart Items
||
==================================================================
||
|| if the session not set the user redirect to login page. 
|| if the session is set then product is added in the db.

*/

// ============================================= Adding Item =============================================

if (isset($_POST['sessionChk']) && isset($_POST['prodQuantity'])) {

    include_once 'admin/include/classes/userCart.php';

    include_once 'admin/include/classes/productClass.php';

    include_once 'admin/include/classes/cartItems.php';

    include_once 'admin/include/classes/database.php';

    $db = new Database();

    $cartItem = new CartItems();

    $cart = new UserCart();

    $product = new Product();

    $productID =  $_POST['sessionChk'];

    session_start();

    if (!isset($_SESSION['User_ID']))
        echo "Please Login to add items in cart.";
    else {

        // Checking out of stock product.

        if ($product->getStock($productID) >= 1) {

            // Adding item in the existing cart.

            if ($cart->getUserID($_SESSION['User_ID']) == $_SESSION['User_ID']) {

                // Checking product is already in the cart or not.

                $userid = $_SESSION['User_ID'];

                $db->select("ops_usercart", "*", " ops_cartitems ON ops_usercart.CartID = ops_cartitems.CartID", "ops_usercart.UserID = '$userid'");

                $cout = 0;

                foreach ($db->getResult() as $value)
                    if ($value['ProductID'] == $productID)
                        $cout++;

                if ($cout > 0) {

                    echo "Product is already added in your Cart.";
                } else {

                    // Checking quantity must be greater than 0

                    if ($_POST['prodQuantity'] > 0) {

                        if ($cartItem->addItems($cart->getCartID($_SESSION['User_ID']), $productID, ($product->getPrice($productID) * $_POST['prodQuantity']), $_POST['prodQuantity']))
                            echo "Product Added into your Cart";
                    } else
                        echo "Product Quantity must be greater than zero.";
                }
            } else {

                // If cart not exist then create cart and add items.

                if ($cart->addCart($_SESSION['User_ID'], $productID, $_POST['prodQuantity'], $_POST['prodQuantity'] * $product->getPrice($productID)))
                    echo "Product Added into your Cart.";
            }
        } else
            echo "Product is out of Stock.";
    }
}


// ============================================= Deleting User Cart Item =============================================

if (isset($_POST['id'])) {

    include_once 'admin/include/classes/cartItems.php';

    include_once 'admin/include/classes/userCart.php';

    $delCart = new UserCart();

    $delCarItem = new CartItems();

    session_start();

    if ($delCarItem->removeItem($delCart->getCartID($_SESSION['User_ID']), $_POST['id']))
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Cart Items Remove Successfully.
               <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    else
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Something went wrong.
               <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
}

// ============================================= Updating User Cart Item Quantyity =============================================

if (isset($_POST['uid']) && isset($_POST['quant'])) {

    include_once 'admin/include/classes/cartItems.php';

    include_once 'admin/include/classes/userCart.php';

    include_once 'admin/include/classes/productClass.php';

    $pro = new Product();

    $updateQuantityCart = new UserCart();

    $updateQuantityItem = new CartItems();

    session_start();

    if ($_POST['quant'] > 0) {

        // updating product quantity

        if ($updateQuantityItem->updateProductQuantity($updateQuantityCart->getCartID($_SESSION['User_ID']), $_POST['uid'], $_POST['quant'])) {

            // updating product price with quantity

            if ($updateQuantityItem->updatePrice($updateQuantityCart->getCartID($_SESSION['User_ID']), $_POST['uid'], $_POST['quant'] * $pro->getPrice($_POST['uid'])))
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Product Quantity updated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>';
        } else
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Something went wrong.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>';
    } else
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> Product Quantity Must be greater than zero.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>';
}



/*

==================================================================
||        
||          Place Order
||
==================================================================
||

*/

// ============================================= Add Data in Order Table =============================================

if (isset($_POST['PlaceOrder'])) {

    include_once 'admin/include/classes/userOrderClass.php';

    include_once 'admin/include/classes/orderItems.php';

    include_once 'admin/include/classes/database.php';

    include_once 'admin/include/classes/userCart.php';

    include_once 'admin/include/classes/productClass.php';

    session_start();

    $userCart = new UserCart();

    $obj = new Database();

    $order = new UserOrders();

    $orderItems = new OrderItems();

    $prodStockDec = new Product();

    // Add data in Order Table

    if ($order->addData($_SESSION['User_ID'], htmlentities($_POST['shippingAddress']), $_POST['totalPrice'])) {

        $userid = $_SESSION['User_ID'];

        $obj->select("ops_usercart", "*", " ops_cartitems ON ops_usercart.CartID = ops_cartitems.CartID", "ops_usercart.UserID = '$userid'");

        $count = 0;

        // print_r($obj->getResult());

        foreach ($obj->getResult() as $value) {

            // Add data in the Order Items Table

            if ($orderItems->addData($order->getOrderID($_SESSION['User_ID']), $value['ProductID'], $value['ProductQuantity'], $value['ProductPrice'])) {

                // Delete Cart

                $userCart->deleteCart($_SESSION['User_ID']);

                if ($prodStockDec->productDrecease($value['ProductID'], $value['ProductQuantity']))
                    $count++;
            }
        }

        if ($count > 0)
            echo '<div class="alert alert-success" role="alert">
                    Order Placed
                  </div>';
        else
            echo '<div class="alert alert-danger" role="alert">
                   Error
                  </div>';
    }
}
