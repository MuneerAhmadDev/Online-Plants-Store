<div class="container-fluid" id="navbar">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center px-5 bg-body p-2">

            <div><i class="bi bi-list fs-2 me-3" id="menu-toggle"></i></div>

            <div>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <?php

                            include_once 'include/classes/adminClass.php';

                            $obj = new Admin();

                            echo "<img src='{$obj->getImage()}' width='30px' height='30px' style='border-radius: 4px;'/>";

                            echo '<span class="ms-3">' . $obj->getName() . '</span>';

                            ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end px-4">
                            <li>
                                <h5 class="dropdown-header mb-0 d-flex justify-content-center align-items-center">
                                    Administrator
                                </h5>
                            </li>
                            <li><a class="dropdown-item mt-2 p-2" href="profileSetting.php"><i class="bi bi-person-circle me-3"></i>Profile Setting</a></li>
                            <li><a class="dropdown-item mt-2 p-2" href="siteSetting.php"><i class="bi bi-gear me-3"></i>General Setting</a></li>
                            <li><a class="dropdown-item text-danger fw-bold mt-2 p-2 mb-2" href="logout.php"><i class="bi bi-box-arrow-right me-3"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>