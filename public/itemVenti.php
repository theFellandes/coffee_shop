<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<!-- Page Content -->
<div class="container">

    <!-- Side Navigation -->
    <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
    <?php
    $type_ref = 3;
    $id = $_GET['id'];
    $query = query(" SELECT * FROM coffee INNER JOIN size ON coffee.coffee_id = size.coffee_id WHERE size.type_ref = 3 AND coffee.coffee_id=" . escape_string($_GET['id']) . " ");
    confirm($query);
    while($row = fetch_array($query)):


    ?>
    <div class="col-md-9">

        <!--Row For Image and Short Description-->

        <div class="row">

            <div class="col-md-7">
                <img class="img-responsive" src="<?php echo $row['coffee_image']?>" alt="">

            </div>

            <div class="col-md-5">

                <form class="thumbnail">


                    <div class="caption-full">
                        <h4><a href="#"><?php echo $row['coffee_name']?></a> </h4>
                        <hr>
                        <h4 class=""><?php echo $row['cost']?> TL</h4>


                        <form method="post" action="../resources/functions.php">
                            <!-- Default radio -->
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="radio"
                                    id="flexRadioDefault1"
                                    value="1"
                                    onclick="location.href='itemTall.php?id=<?php echo $id?>'"
                                />
                                <label class="form-check-label" for="flexRadioDefault1"> Tall </label>
                            </div>

                            <!-- Default checked radio -->
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="radio"
                                    id="flexRadioDefault2"
                                    value="2"
                                    onclick="location.href='item.php?id=<?php echo $id?>'"
                                />
                                <label class="form-check-label" for="flexRadioDefault2"> Grande </label>
                            </div>

                            <!-- Default radio -->
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="radio"
                                    id="flexRadioDefault1"
                                    value="3"
                                    checked
                                />
                                <label class="form-check-label" for="flexRadioDefault1"> Venti </label>
                            </div>
                        </form>

                        <div class="ratings">

                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                4.0 stars
                            </p>
                        </div>

                        <p><?php echo $row['coffee_description']?></p>
                        <?php button($type_ref, $id); ?>
                    </div>

            </div>

        </div>


    </div><!--Row For Image and Short Description-->


    <hr>


    <!--Row for Tab Panel-->

    <div class="row">

        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">

                    <p></p>

                    <p><?php echo $row['coffee_description']?></p>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">

                    <div class="col-md-6">

                        <h3>3 Reviews From </h3>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">10 days ago</span>
                                <p>This coffee was delicious! I would definitely buy another!</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">12 days ago</span>
                                <p>I've alredy ordered another one!</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">15 days ago</span>
                                <p>I've seen some taste better than this, but not at this. I definitely recommend this coffee.</p>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-6">
                        <h3>Add A review</h3>

                        <form action="" class="form-inline">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="test" class="form-control">
                            </div>

                            <div>
                                <h3>Your Rating</h3>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            </div>

                            <br>

                            <div class="form-group">
                                <textarea name="" id="" cols="60" rows="10" class="form-control"></textarea>
                            </div>

                            <br>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="SUBMIT">
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>


    </div><!--Row for Tab Panel-->




</div> <!-- col-md-9 ends here-->
<?php endwhile; ?>

</div>
<!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
