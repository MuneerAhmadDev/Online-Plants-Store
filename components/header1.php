<div class="container-fluid">
    <div class="row bg-light shadow">

        <div class="col-md-4 d-flex justify-content-center h4 align-items-center">
            <a href="index.php" class="nav-link link-opacity-75-hover">
                <div class="d-flex justify-content-center align-items-center p-2">
                    <?php
                    include_once 'admin/include/classes/siteSettingClass.php';

                    $showLogo = new SiteSetting();

                    echo '<img src="admin/' . $showLogo->getSiteLogo() . '" class="w-100">';

                    ?>
                </div>
            </a>
        </div>

        <div class="col-md-5 pt-4 pb-4">

            <form action="search.php" method="GET" class="d-flex">
                <input type="text" name="searchBar" id="searchBar" placeholder="Search" autocomplete="off" class="form-control w-100">
                <button type="submit" class="btn btn-success" style="border-radius: 0px;"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div class="col-md-3 d-flex justify-content-center align-items-center">
            <div class="row">

                <?php

                session_start();

                if (!isset($_SESSION['User_ID'])) {

                    $menu = '<div class="col p-2 d-flex justify-content-end align-items-center">
                                <a href="login.php" class="btn btn-light shadow-sm">Login</a>
                                <a href="signUp.php" class="btn btn-primary ms-3">Signup</a>
                            </div>';
                    echo $menu;
                } else {

                    include_once 'users.php';

                    include_once 'admin/include/classes/cartItems.php';

                    include_once 'admin/include/classes/userCart.php';

                    $cart = new UserCart();

                    $cartItems = new CartItems();

                    $obj = new Users();

                    $res;

                    if (!empty($obj->getImage($_SESSION['User_ID'])))
                        $res = "" . $obj->getImage($_SESSION['User_ID']);
                    else
                        $res = "admin/assets/images/avatar.png";

                    $after = '<div class="col p-2 d-flex justify-content-end align-items-center">

                                   <div class="d-flex me-5 align-items-end position-relative">
                                        <a href="cart.php" class="fs-3"><i class="bi bi-cart text-primary"></i></a>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            ' . $cartItems->getCartTotalItems($cart->getCartID($_SESSION['User_ID'])) . '
                                        </span>
                                    </div>

                                    <div class="">  
                                        <div class="dropdown">

                                                <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                                    <img src="' . $res . '" width="40px" height="40px" style="border-radius: 2px;"/>
                                                </a>

                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="userProfile.php"><i class="bi bi-person-circle me-3"></i>Profile</a></li>
                                                <li><a class="dropdown-item" href="cart.php"><i class="bi bi-cart-fill text-success me-3"></i>Cart</a></li>
                                                <li><a class="dropdown-item" href="myOrder.php"><i class="bi bi-bag-fill text-primary me-3"></i>Order</a></li>
                                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-3"></i>Logout</a></li>
                                            </ul>

                                        </div>
                                    </div>
                        
                                
                             </div>';
                    echo $after;
                }

                ?>
            </div>
        </div>

    </div>
</div>