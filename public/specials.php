<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer text-center">
            <h1>A Warm Welcome!</h1>
            <img src="https://cdn.vox-cdn.com/thumbor/UozmYTAbBizAx-B1tWQ0_t5Ulcs=/1400x0/filters:no_upscale()/cdn.vox-cdn.com/uploads/chorus_asset/file/13371227/Starbucks_Holiday_2018_Cups_1.jpg" class="img-fluid img-thumbnail" alt="seasonal_cups" style="width: 75%">
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Our Specials</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php get_special_coffees(); ?>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
