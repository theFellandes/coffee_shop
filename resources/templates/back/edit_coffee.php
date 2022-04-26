<div class="col-md-12">

    <div class="row">
        <h1 class="page-header">
            Edit Coffee
            <?php edit_coffee();?>
        </h1>
    </div>



    <form action="" method="post" enctype="multipart/form-data">


        <div class="col-md-8">

            <div class="form-group">
                <label for="coffee_name">Coffee Title </label>
                <input type="text" name="coffee_name" class="form-control">

            </div>


            <div class="form-group">
                <label for="coffee_description">Coffee Description</label>
                <textarea name="coffee_description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>



            <div class="form-group row">

                <div class="col-xs-3">
                    <label for="coffee_price">Coffee Price</label>
                    <input type="number" name="coffee_price" class="form-control" size="60">
                </div>
            </div>

            <div class="form-group row">

                <div class="col-xs-3">
                    <label for="coffee_size">Coffee Size</label>
                    <input type="text" name="coffee_size" class="form-control" size="60">
                </div>
            </div>

            <div class="form-group row">

                <div class="col-xs-3">
                    <label for="coffee_id">Coffee Id</label>
                    <input type="number" name="coffee_id" class="form-control" size="60">
                </div>
            </div>



        </div><!--Main Content-->


        <!-- SIDEBAR-->


        <aside id="admin_sidebar" class="col-md-6">

            <!-- Product Image -->
            <div class="form-group">
                <label for="product-title">Coffee Image</label>
                <input type="file" name="file">

            </div>

            <div class="form-group">
                <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
            </div>


            <!-- Product Categories-->


</div>


</aside><!--SIDEBAR-->



</form>




