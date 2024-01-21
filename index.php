<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "cssLinks.php" ?>
    <style>
        .carousel-item {
            height: 32rem;
            position: relative;
        }

        .carousel-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .carousel-item .carousel-caption {
            z-index: 1;
        }
    </style>
    <title>Home</title>
</head>

<body>


    <!-- ==================== Header Section ==================== -->

    <!-- ================== Header 1 ================== -->

    <?php include 'components/header1.php'; ?>


    <!-- ================== Navbar ================== -->

    <?php include 'components/navbar.php'; ?>


    <!-- ==================== Header Section ==================== -->

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php

                        include_once 'admin/include/classes/database.php';

                        $db = new Database();

                        $db->select("ops_sitebanner");

                        $firstItem = true;

                        $data = "";

                        foreach ($db->getResult() as $value) {

                            $activeClass = $firstItem ? 'active' : '';

                            $firstItem = false;

                            $data .= '  <div class="carousel-item ' . $activeClass . '" data-bs-interval="3000">

                                            <img src="admin/' . $value['BannerImages'] . '" class="d-block w-100">

                                            <div class="overlay"></div>
                            
                                            <div class="carousel-caption fs-4 d-none d-md-block">
                            
                                                <h5>' . $value['BannerTitle'] . '</h5>
                                
                                                <p>' . html_entity_decode($value['BannerDescription']) . '</p>
                                
                                            </div>
                                
                                          </div>';
                        }

                        echo $data;

                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Indoor Plants -->

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 p-5">
                <div class="row" id="indoorPlants">
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Seeds -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-5 py-3">
                <div class="row" id="seeds">
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Indoor Flowers -->

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 px-5 py-3">
                <div class="row" id="indoorFlower">
                    <?php

                    ?>
                </div>
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

            // ----------------------------- load Indoor Plants -----------------------------

            function loadIndoorPlants() {
                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: {
                        loadIndoorPlantData: "loading"
                    },
                    success: function(indPResponse) {
                        $('#indoorPlants').html(indPResponse);
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }

            loadIndoorPlants();

            // ----------------------------- load seeds -----------------------------

            function loadSeedsPlants() {
                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: {
                        loadSeedsPlantData: "seeds"
                    },
                    success: function(seedsPResponse) {
                        $('#seeds').html(seedsPResponse);
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }

            loadSeedsPlants();

            // ----------------------------- load Indoor Flower -----------------------------

            function loadIndoorFlowers() {
                $.ajax({
                    url: 'ajaxHandler.php',
                    type: 'POST',
                    data: {
                        loadIndoorFlowerData: "loading"
                    },
                    success: function(indPResponse) {
                        $('#indoorFlower').html(indPResponse);
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }

            loadIndoorFlowers();

        });
    </script>
</body>

</html>