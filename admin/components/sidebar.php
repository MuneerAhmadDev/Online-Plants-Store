<asside id="sidebar-wrapper">
    <!-- ========== Sidebar -> Brand Identity ========== -->

    <div class="sidebar-heading text-center py-4">
        <?php

        include_once 'include/classes/siteSettingClass.php';

        $name = new SiteSetting();

        echo '<span class="fw-bold d-flex align-items-center justify-content-center">' . $name->getName() . '</span>';

        ?>
    </div>

    <!-- ========== Sidebar -> Lists Group ========== -->

    <ul class="list-group mt-3">

        <li class="list-group-item text-start">

            <a href="dashboard.php" class="text-decoration-none">
                <i class="bi bi-house-door-fill me-3"></i>Dashboard
            </a>

        </li>

        <div class="accordion accordion-flush mt-3" id="accordionFlushExample">

            <!-- User Management -->

            <li class="list-group-item">


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                            <i class="bi bi-people-fill me-3"></i> Users
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="users.php">All Users</a></li>
                                <li class="nav-item"><a class="nav-link" href="addUser.php">Add User</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


            </li>

            <!-- Product Management -->

            <li class="list-group-item">


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="false" aria-controls="flush-collapseOne">
                            <i class="bi bi-box-fill me-3"></i> <span>Products</span>
                        </button>
                    </h2>
                    <div id="product" class="accordion-collapse collapse" data-bs-parent="#product">
                        <div class="accordion-body bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="product.php">All Products</a></li>
                                <li class="nav-item"><a class="nav-link" href="addProduct.php">Add Product</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </li>

            <!-- Parent Category -->


            <li class="list-group-item">


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" aria-controls="flush-collapseOne">
                            <i class="bi bi-bookmarks-fill me-3"></i> <span>Parent Category</span>
                        </button>
                    </h2>
                    <div id="category" class="accordion-collapse collapse" data-bs-parent="#category">
                        <div class="accordion-body bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="category.php">All Parent Categories</a></li>
                                <li class="nav-item"><a class="nav-link" href="addCategory.php">Add Parent Category</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </li>

            <!-- Child Category -->

            <li class="list-group-item">


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#childcategory" aria-expanded="false" aria-controls="flush-collapseOne">
                            <i class="bi bi-bookmarks me-3"></i> <span>Child Category</span>
                        </button>
                    </h2>
                    <div id="childcategory" class="accordion-collapse collapse" data-bs-parent="#childcategory">
                        <div class="accordion-body bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="childCategory.php">All Child Categories</a></li>
                                <li class="nav-item"><a class="nav-link" href="addChildCategory.php">Add Child Category</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </li>

        </div>


        <li class="list-group-item mt-3">
            <a href="userCart.php" class="text-decoration-none">
                <i class="bi bi-cart-fill me-3"></i>User Cart
            </a>
        </li>

        <li class="list-group-item mt-4">
            <a href="userOrders.php" class="text-decoration-none">
                <i class="bi bi-bag-fill me-3"></i>User Order
            </a>
        </li>



    </ul>

</asside>