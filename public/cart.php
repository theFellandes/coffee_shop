<?php require_once("../resources/config.php"); ?>
<?php

if (isset($_GET['add'])) {

        if(empty($_GET['size'])){
            foreach ($_SESSION as $name => $value) {
                if ($value > 0) {
                    $length = strlen($name);
                    $id = substr($name, 14, $length);
                    $size = substr($name, 5, 1);
                }
            }
            $type_ref = $size;
        }
    else{
        $type_ref = escape_string($_GET['size']);
    }
    $add = escape_string($_GET['add']);
    $query = query(" SELECT * FROM coffee INNER JOIN size ON " . "coffee.coffee_id = " . $add . " AND size.coffee_id = coffee.coffee_id WHERE size.type_ref = " . $type_ref);
    confirm($query);
    while ($row = fetch_array($query)) {
        if(empty($_GET['size'])){
            foreach ($_SESSION as $name => $value) {
                if ($value > 0) {
                    $length = strlen($name);
                    $id = substr($name, 14, $length);
                    $size = substr($name, 5, 1);
                }
            }
            $_SESSION['size_' . $size . '/'  . 'coffee_' . $_GET['add']] += 1;
            redirect("checkout.php");
        }
        else{
            $_SESSION['size_' . $_GET['size'] . '/'  . 'coffee_' . $_GET['add']] += 1;
            redirect("checkout.php");
        }
    }
}

if (isset($_GET['remove'])) {

        $_SESSION['size_' . $_GET['size'] . '/'  . 'coffee_' . $_GET['remove']]--;

        if ($_SESSION['size_' . $_GET['size'] . '/'  . 'coffee_' . $_GET['remove']] < 1) {
            redirect("index.php");
            unset($_SESSION['total_items']);
            unset($_SESSION['total']);
        } else {
            redirect("checkout.php");
        }
}

if (isset($_GET['delete'])) {

    if(empty($_GET['size'])){
        foreach ($_SESSION as $name => $value) {
            $length = strlen($name);
            $id = substr($name, 14, $length);
            if ($id == $_GET['delete']) {
                $size = substr($name, 5, 1);
            }
        }

        $_SESSION['size_' . $size . '/'  . 'coffee_' . $_GET['delete']] = 0;
        unset($_SESSION['total_items']);
        unset($_SESSION['total']);
        redirect("index.php");
    }

    else{
        $_SESSION['size_' . $_GET['size'] . '/'  . 'coffee_' . $_GET['delete']] = 0;
        unset($_SESSION['total_items']);
        unset($_SESSION['total']);
        redirect("index.php");
    }
}

function cart()
{
    $total = 0;
    $total_items = 0;
    foreach ($_SESSION as $name => $value) {
        if ($value > 0) {
            $id = substr($name, 14);
            $size = substr($name, 5, 1);
            if (substr($name, 7, 7) == "coffee_") {
                $query = query(" SELECT * FROM coffee INNER JOIN size ON " . "coffee.coffee_id = " . escape_string($id) . " AND size.coffee_id = coffee.coffee_id WHERE size.type_ref = " . escape_string($size));
                confirm($query);

                while ($row = fetch_array($query)) {
                    $sub = $row['cost'] * $value;
                    $coffee = <<<DELIMITER
<tr>
<td>{$row['coffee_name']}</td>
<td>{$row['cost']} TL</td>
<td>$value</td>
<td>$sub TL</td>
<td>
<a class='btn btn-warning' href="cart.php?size={$row['type_ref']}&&remove={$row['coffee_id']}"><span class="glyphicon glyphicon-minus"></span></a>
<a class='btn btn-success' href="cart.php?size={$row['type_ref']}&&add={$row['coffee_id']}"><span class="glyphicon glyphicon-plus"></span></a>
<a class='btn btn-danger' href="cart.php?size={$row['type_ref']}&&delete={$row['coffee_id']}"><span class="glyphicon glyphicon-remove"></span></a>
</td>
</tr>
<input type="hidden" name="coffee_id" value="{$row['coffee_id']}">
<input type="hidden" name="coffee_name" value="{$row['coffee_name']}">
<input type="hidden" name="coffee_type" value="{$row['type_ref']}"
<input type="hidden" name="cost" value="{$sub}">
<input type="hidden" name="amount" value="{$value}">
DELIMITER;
                    echo $coffee;
                }
$_SESSION['total'] = $total += $sub;
$_SESSION['total_items'] = $total_items += $value;
            }
        }
    }

    if(isset($_GET['buy'])){
        $coffee_id = $_GET['coffee_id'];
        $quantity = $_GET['amount'];
        $type_ref = $_GET['coffee_type'];
        $customer_id = $_SESSION['customer_id'];
        if($type_ref == 1){
            $type = "Tall";
        }
        elseif ($type_ref == 2){
            $type = "Grande";
        }
        else{
            $type = "Venti";
        }

        $query = query("INSERT INTO customerorder(customer_id) VALUES('$customer_id')");
        confirm($query);

        $query = query("SELECT order_id FROM customerorder WHERE customer_id = ('$customer_id') AND date = CURRENT_TIMESTAMP ");
        confirm($query);

        while ($row = fetch_array($query)) {
            $order_id = $row['order_id'];
            $_SESSION['order_id'] = $order_id;
            $query2 = query("INSERT INTO orderitem (coffee_id, order_id, quantity, type) VALUES('$coffee_id', '$order_id', '$quantity', '$type')");
            confirm($query2);
        }

        redirect('thank_you.php');



    }

}

?>

