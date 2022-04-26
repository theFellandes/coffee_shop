<?php require_once("../resources/config.php"); ?>
<?php require_once("cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<div class="container">
    <h1 class="text-center">Thank You For Choosing Us!</h1>
    <h1 class="text-center">Order ID: <?php echo $_SESSION['order_id']?></h1>
</div>
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>