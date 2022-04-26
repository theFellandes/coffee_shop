<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
    <!-- Page Content -->
    <div class="container">

        <header>
            <h1 class="text-center">Sign In</h1>
            <div class="col-sm-4 col-sm-offset-5">
                <form class="" action="" method="post" enctype="multipart/form-data">
                    <?php submit_user(); ?>
                    <div class="form-group"><label for="firstname">
                            First Name<input type="text" name="firstname" class="form-control"></label>
                    </div>

                    <div class="form-group"><label for="lastname">
                            Last Name<input type="text" name="lastname" class="form-control"></label>
                    </div>

                    <div class="form-group"><label for="">
                            Username<input type="text" name="username" class="form-control"></label>
                    </div>

                    <div class="form-group"><label for="password">
                            Password<input type="password" name="password" class="form-control"></label>
                    </div>

                    <div class="form-group"><label for="address">
                            Address<input type="text" name="address" class="form-control"></label>
                    </div>

                    <div class="form-group"><label for="town">
                            Town<input type="text" name="town" class="form-control"></label>
                    </div>

                    <div class="form-group"><label for="postcode">
                            Post Code<input type="text" name="postcode" class="form-control"></label>
                    </div>

                    <div class="form-group"><label for="email">
                            E Mail<input type="email" name="email" class="form-control"></label>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" >
                    </div>
                </form>
            </div>


        </header>


    </div>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>