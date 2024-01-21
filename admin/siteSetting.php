<?php include_once 'session.php';
include_once 'include/classes/siteSettingClass.php';
$socialMedia = new SiteSetting();
$siteLogoName = new SiteSetting();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include_once "cssLinks.php"; ?>
    <title>Site Setting</title>
</head>

<body>
    <div id="wrapper">

        <!-- ==================== Sidebar ==================== -->

        <?php include_once 'components/sidebar.php' ?>

        <!-- ==================== Sidebar ==================== -->



        <!-- ==================== Page Content ==================== -->

        <div id="page-content-wrapper">


            <!-- ========== Page Content -> Navbar ========== -->

            <?php include_once 'components/navbar.php' ?>

            <!-- ========== Page Content -> Navbar ========== -->




            <!-- ========== Page Content -> Actual Content ========== -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="row bg-body shadow-sm" style="border-radius: 4px;">
                            <div class="col-12 p-3 text-uppercase d-flex justify-content-start align-items-center">
                                <i class="bi bi-gear-fill text-success fw-bold me-2"></i> General Setting
                            </div>
                        </div>
                        <div class="row bg-body shadow-sm mt-3" style="border-radius: 4px;">
                            <div class="col-md-12 p-5" style="border-radius: 2px;">

                                <!-- Add Social Media -->

                                <div class="card">
                                    <div class="card-body">
                                        <form class="row" id="socialMediaLinks">
                                            <p class="text-success fw-bold">Add Social Media Links</p>

                                            <div class="col-md-6 mb-3">
                                                <label for="fb" class="form-label text-secondary"><i class="bi bi-facebook text-primary me-2"></i>Facebook</label>
                                                <input type="text" name="fb" id="fb" class="form-control" value="<?php if (!empty($socialMedia->getFacbook()))
                                                                                                                        echo $socialMedia->getFacbook();
                                                                                                                    else
                                                                                                                        echo "https://www.facebook.com"; ?>" autocomplete="off">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="wapp" class="form-label text-secondary"><i class="bi bi-whatsapp text-success me-2"></i>WhatsApp</label>
                                                <input type="text" name="wapp" id="wapp" class="form-control" value="<?php if (!empty($socialMedia->getWhatsapp()))
                                                                                                                            echo $socialMedia->getWhatsapp();
                                                                                                                        else
                                                                                                                            echo "https://web.whatsapp.com"; ?>" autocomplete="off">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="instagram" class="form-label text-secondary"><i class="bi bi-instagram text-primary me-2"></i>Instagram</label>
                                                <input type="text" name="instagram" id="instagram" class="form-control" value="<?php if (!empty($socialMedia->getInstagram()))
                                                                                                                                    echo $socialMedia->getInstagram();
                                                                                                                                else
                                                                                                                                    echo "https://www.instagram.com"; ?>" autocomplete="off">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="twitter" class="form-label text-secondary"><i class="bi bi-twitter text-primary me-2"></i>Twitter</label>
                                                <input type="text" name="twitter" id="twitter" class="form-control" value="<?php if (!empty($socialMedia->getTwitter()))
                                                                                                                                echo $socialMedia->getTwitter();
                                                                                                                            else
                                                                                                                                echo "https://twitter.com/i/flow/login?redirect_after_login=%2F"; ?>" autocomplete="off">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="youtube" class="form-label text-secondary"><i class="bi bi-youtube text-danger me-2"></i>YouTube</label>
                                                <input type="text" name="youtube" id="youtube" class="form-control" value="<?php if (!empty($socialMedia->getYouTube()))
                                                                                                                                echo $socialMedia->getYouTube();
                                                                                                                            else
                                                                                                                                echo "https://www.youtube.com"; ?>" autocomplete="off">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Add Website About -->

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <form class="row" id="updateAboutus">
                                            <p class="text-success fw-bold">Add Website About</p>

                                            <div class="col-md-12 mb-3">
                                                <label for="siteAbout" class="form-label text-secondary"><i class="bi bi-info-circle-fill text-primary me-2"></i>About</label>
                                                <textarea class="form-control" id="siteAbout" name="siteAbout" rows="10"><?php if (!empty($socialMedia->getAboutUs()))
                                                                                                                                echo html_entity_decode($socialMedia->getAboutUs());
                                                                                                                            else
                                                                                                                                echo "No record found"; ?></textarea>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Website Logo/Name -->

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <form class="row" id="updateSiteLogo">
                                            <p class="text-success fw-bold">Website Logo/Name</p>

                                            <div class="col-md-6 mb-4">
                                                <img src="<?php echo $siteLogoName->getSiteLogo(); ?>" alt="Site Logo" class="w-50">
                                            </div>

                                            <div class="col-md-6 d-flex align-items-end">
                                                <p class="text-primary" style="font-size: 14px;">Note: You must add logo
                                                    and name both.</p>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="sitePic" class="form-label text-secondary">Website
                                                    Logo</label>
                                                <input type="file" name="sitePic" id="sitePic" class="form-control" autocomplete="off" required>
                                                <p class="text-danger mt-2" style="font-size: 14px;">Site logo should be
                                                    in (jpeg, jpg, png) format.</p>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="siteName" class="form-label text-secondary">Website
                                                    Name</label>
                                                <input type="text" name="siteName" id="siteName" class="form-control" value="<?php echo $siteLogoName->getName(); ?>" autocomplete="off" required>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Website Banner  -->

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <form class="row" id="addBanner">

                                            <p class="text-success fw-bold">Add site Banner/Hero Images</p>

                                            <div class="content">

                                                <label for="bannerTitle" class="form-label text-secondary">Banner
                                                    Title:</label>

                                                <input type="text" name="bannerTitle" id="bannerTitle" class="form-control mb-4" autocomplete="off" required>

                                                <label for="bannerDescription" class="form-label text-secondary">Banner
                                                    Description:</label>

                                                <textarea class="form-control mb-4" name="bannerDescription" id="bannerDescription" rows="3" required></textarea>

                                                <label for="siteBanner" class="form-label text-secondary">Banner
                                                    Image:</label>

                                                <input type="file" name="siteBanner" id="siteBanner" class="form-control mb-4" required>

                                                <input type="submit" value="Add" class="btn btn-success">

                                                <input type="reset" value="Reset Form" class="btn btn-primary">
                                            </div>

                                        </form>
                                    </div>
                                </div>


                                <!-- Password Recovery Email -->

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <form class="row" id="passRecoveryEmailForm">

                                            <p class="text-success fw-bold">Password Recovery Eamil</p>

                                            <div class="content">

                                                <label for="prEmail" class="form-label text-secondary">Enter
                                                    Email</label>

                                                <input type="email" name="prEmail" id="prEmail" class="form-control mb-4" value="<?php echo $socialMedia->getRecoveryEmail(); ?>" autocomplete="off" required>

                                                <label for="appPassword" class="form-label text-secondary">App
                                                    Password</label>

                                                <input type="text" name="appPassword" id="appPassword" value="<?php echo $socialMedia->getRecoveryEmailPass(); ?>" class="form-control mb-4" required>

                                                <input type="submit" value="Add" class="btn btn-success">

                                            </div>

                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ========== Page Content -> Actual Content ========== -->
            <?php include_once 'components/footer.php'; ?>

        </div>

        <!-- ==================== Page Content ==================== -->

    </div>


    <?php include_once "jsLinks.php"; ?>

    <script>
        $(document).ready(function() {

            // --------------------------- Update Social Meida links ---------------------------

            $('#socialMediaLinks').on('submit', function(e) {

                var sociaMedia = new FormData(this);

                sociaMedia.append('links', 'updateLinks');

                $.ajax({

                    url: 'hand.php',
                    type: 'POST',
                    data: sociaMedia,
                    contentType: false,
                    processData: false,
                    success: function(socialMediaLinksResponse) {
                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = socialMediaLinksResponse.replace(stringToRemove,
                            "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert('Error....');
                    }

                });

            });


            // --------------------------- Update About us links ---------------------------

            $('#updateAboutus').on('submit', function(e) {

                var aboutUs = new FormData(this);

                aboutUs.append('about', 'updateAbout');

                $.ajax({

                    url: 'hand.php',
                    type: 'POST',
                    data: aboutUs,
                    contentType: false,
                    processData: false,
                    success: function(aboutUsResponse) {
                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = aboutUsResponse.replace(stringToRemove, "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert('Error....');
                    }

                });

            });

            // --------------------------- Update Site Logo links ---------------------------


            $('#updateSiteLogo').on('submit', function() {


                var siteLogo = new FormData(this);

                siteLogo.append('siteLogoName', 'updating');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: siteLogo,
                    contentType: false,
                    processData: false,
                    success: function(siteLogoResponse) {
                        var stringToRemove = "<!-- hslkj -->";

                        var modifiedString = siteLogoResponse.replace(stringToRemove, "");

                        alert(modifiedString);
                    },
                    error: function() {
                        alert("Error....");
                    }
                });


            });

            // --------------------------- Add Site Banner ---------------------------

            $('#addBanner').on('submit', function(e) {

                e.preventDefault();

                var addBanner = new FormData(this);

                addBanner.append("addBan", 'banner');

                $.ajax({
                    url: 'hand.php',
                    type: 'POST',
                    data: addBanner,
                    contentType: false,
                    processData: false,
                    success: function(addBannerResponse) {
                        alert(addBannerResponse);
                    },
                    error: function() {
                        alert("Error");
                    }
                });

            });

            // --------------------------- Password Recovery Email ---------------------------

            $('#passRecoveryEmailForm').on('submit', function(e) {

                e.preventDefault();

                var passRecoveryEmail = new FormData(this);

                passRecoveryEmail.append("recovery", "pass");

                $.ajax({

                    url: 'hand.php',

                    type: 'POST',

                    data: passRecoveryEmail,

                    contentType: false,

                    processData: false,

                    success: function(passRecoveryEmailResponse) {
                        alert(passRecoveryEmailResponse);
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