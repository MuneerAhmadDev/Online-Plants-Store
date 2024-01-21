<div class="container-fluid" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-12 bg-body p-2 d-flex justify-content-center align-items-center">
            © 2023 &nbsp; <?php include_once 'include/classes/siteSettingClass.php';
                            $obj = new SiteSetting();
                            echo '<span class="text-success fw-bold"> ' . $obj->getName() . ' </span>' ?>. &nbsp; All rights reserved.
        </div>
    </div>
</div>