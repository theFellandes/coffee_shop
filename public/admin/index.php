<?php require_once("../../resources/config.php")?>
<?php include(TEMPLATE_BACK . "/header.php") ?>
<?php
if(!isset($_SESSION['username'])){
    redirect("../../public");
}
if(!isset($_SESSION['employee'])){
    redirect("../../public");
}
?>
        <div id="page-wrapper">

            <div class="container-fluid">



                <?php
                if($_SERVER['REQUEST_URI'] == "/WebMidterm/public/admin/" || $_SERVER['REQUEST_URI'] == "/WebMidterm/public/admin/index.php"){
                    include(TEMPLATE_BACK . "/admin_content.php");
                }

                if(isset($_GET['coffees'])){
                    include(TEMPLATE_BACK . "/coffees.php");
                }
                if(isset($_GET['add_coffee'])){
                    include(TEMPLATE_BACK . "/add_coffee.php");
                }
                if(isset($_GET['edit_coffee'])){
                    include(TEMPLATE_BACK . "/edit_coffee.php");
                }
                if(isset($_GET['orders'])){
                    include(TEMPLATE_BACK . "/orders.php");
                }
                if(isset($_GET['current_orders'])){
                    include(TEMPLATE_BACK . "/current_orders.php");
                }
                if(isset($_GET['users'])){
                    include(TEMPLATE_BACK . "/users.php");
                }
                ?>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK . "/footer.php") ?>