<footer>
    <div class="container-fluid mt-5">
        <div class="row bg-success">
            <?php include_once 'admin/include/classes/siteSettingClass.php';
            $siteSetting = new SiteSetting(); ?>
            <div class="col-md-8 d-flex justify-content-end align-items-center fs-5 p-3">
                © 2023 <?php echo $siteSetting->getName(); ?> - All rights reserved.
            </div>
            <div class="col-md-4 p-2">
                <div class="d-flex justify-content-end">
                    <a href="<?php echo $siteSetting->getFacbook(); ?>" target="_blank" class="text-decoration-none fs-4 me-3 icon d-flex justify-content-center align-items-center fb"><i class="bi bi-facebook"></i></a>
                    <a href="<?php echo $siteSetting->getWhatsapp(); ?>" target="_blank" class="text-decoration-none fs-4 me-3 icon d-flex justify-content-center align-items-center wp"><i class="bi bi-whatsapp"></i></a>
                    <a href="<?php echo $siteSetting->getInstagram(); ?>" target="_blank" class="text-decoration-none fs-4 me-3 icon d-flex justify-content-center align-items-center insta"><i class="bi bi-instagram"></i></a>
                    <a href="<?php echo $siteSetting->getTwitter(); ?>" target="_blank" class="text-decoration-none fs-4 me-3 icon d-flex justify-content-center align-items-center tw"><i class="bi bi-twitter"></i></a>
                    <a href="<?php echo $siteSetting->getYouTube(); ?>" target="_blank" class="text-decoration-none fs-4 me-3 icon d-flex justify-content-center align-items-center yt"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>