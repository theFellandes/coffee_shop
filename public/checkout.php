<?php require_once("../resources/config.php"); ?>
<?php require_once("cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
    <!-- Page Content -->
    <div class="container">

<!-- /.row --> 

<div class="row">

      <h1>Checkout</h1>

<form action="">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart(); ?>
        </tbody>
    </table>
    <div class="form-group">
        <input type="submit" name="buy" class="btn btn-primary" >
    </div>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php echo isset($_SESSION['total_items']) ? $_SESSION['total_items'] : "0"?></span></td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount"><?php echo isset($_SESSION['total']) ? $_SESSION['total'] . " TL" : "0 TL"?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->
        <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
