<?php

// helper functions

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }
    else{
        $msg = "";
    }
}

function display_message(){
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function redirect($location){
    header("Location: $location ");
}

function query($sql){
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

//Prevents sql injections
function escape_string($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){
    return mysqli_fetch_array($result);
}

function get_coffees($type_ref = 2){
    $query = query(" SELECT * FROM coffee INNER JOIN size ON coffee.coffee_id = size.coffee_id WHERE size.type_ref = " . $type_ref);
    confirm($query);

    while($row = fetch_array($query)){
        $coffee = <<<DELIMITER
<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="{$row['coffee_image']}" alt="" class="d-none d-sm-block" style="width: 150px; height: 150px">
                            <div class="caption">
                                <h4 class="pull-right">{$row['cost']}TL</h4>
                                <h4 class="d-inline-block text-truncate" style="max-width: 150px"><a href="item.php?id={$row['coffee_id']}">{$row['coffee_name']}</a>
                                </h4>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                            <div class="col text-center caption" style="height: auto">
                                <a class="btn btn-primary" target="_blank" href="cart.php?size={$type_ref}&&add={$row['coffee_id']}">Buy</a>
                            </div>
                        </div>
                    </div>
DELIMITER;
echo $coffee;
    }
}

function button($type_ref, $id){
    $query = query(" SELECT * FROM coffee INNER JOIN size ON coffee.coffee_id = size.coffee_id WHERE size.type_ref = " . $type_ref);
    confirm($query);
    $coffee = <<<DELIMITER
<form action="">
        <div class="col text-center caption" style="height: auto">
         <a class="btn btn-primary" target="_blank" href="cart.php?size={$type_ref}&&add={$id}">Add To Cart</a>
        </div>
    </form>
DELIMITER;
echo $coffee;
}

function get_specials(){
    $query = query("SELECT * FROM coffee");
    confirm($query);

    while($row = fetch_array($query)){
        if($row['special']){
            echo "<a href='specials.php?id={$row['coffee_id']}' class='list-group-item'>{$row['coffee_name']}</a>";
        }
    }
}

function get_special_coffees($type_ref = 2){
    $query = query(" SELECT * FROM coffee INNER JOIN size ON coffee.coffee_id = size.coffee_id WHERE size.type_ref = " . $type_ref);
    confirm($query);

    while($row = fetch_array($query)){
        if($row['special'] == 1){
        $coffee = <<<DELIMITER
<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="{$row['coffee_image']}" alt="" class="d-none d-sm-block" style="width: 150px; height: 150px">
                            <div class="caption">
                                <h4 class="pull-right">{$row['cost']}TL</h4>
                                <h4 class="d-inline-block text-truncate" style="max-width: 150px"><a href="item.php?id={$row['coffee_id']}">{$row['coffee_name']}</a>
                                </h4>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                            <div class="col text-center caption" style="height: auto">
                                <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['coffee_id']}">Buy</a>
                            </div>
                        </div>
                    </div>
DELIMITER;
        echo $coffee;
        }
    }
}

function login_user(){
    if(isset($_POST['submit'])){
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM customer WHERE username = '{$username}' and password = '{$password}'");
        confirm($query);

        if(mysqli_num_rows($query) == 0){
            echo "<script>
                alert('Your Username or Password are wrong.');
                window.location.href='login.php';
                </script>";
        }

        else{
            $_SESSION['username'] = $username;
            while($row = fetch_array($query)) {
                $_SESSION['customer_id'] = $row['customer_id'];
                if ($row['employee']) {
                    $_SESSION['employee'] = $row['employee'];
                    redirect("admin");
                } else {
                    redirect("index.php");
                }
            }
        }
    }
}

function validate_password($password){
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return 0;
    }
    else{
        return 1;
    }
}

function submit_user(){
    if(isset($_POST['submit'])){
        $firstname = escape_string($_POST['firstname']);
        $lastname = escape_string($_POST['lastname']);
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);
        if(!validate_password($password)){
            echo "<script>
                alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
                window.location.href='signIn.php';
                </script>";
            return;
        }
        $address = escape_string($_POST['address']);
        $town = escape_string($_POST['town']);
        $postcode = escape_string($_POST['postcode']);
        $email = escape_string($_POST['email']);

        $query = query("INSERT INTO customer(username, password, first_name, last_name, street_address, town, post_code, e_mail)  VALUES('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$address}', '{$town}', '{$postcode}', '{$email}')");
        confirm($query);

        echo "<script>
                alert('Account created successfully');
                window.location.href='login.php';
                </script>";

    }
}

function send_message(){
    if(isset($_POST['submit'])){
        $to = "apollocoffee@apollo.com";
        $name =  escape_string($_POST['name']);
        $email =  escape_string($_POST['email']);
        $phone =  escape_string($_POST['subject']);
        $message =  escape_string($_POST['message']);

        $headers = "From: {$name} {$email}";
        mail($to, $name, $message, $headers);

        $query = query("INSERT INTO comments(commentor_name, commentor_email, commentor_phone, commentor_message) VALUES('{$name}', '{$email}', '{$phone}', '{$message}')");
        confirm($query);

        echo "<script>
                alert('Your comment will be into the consideration. Thank you for choosing us!');
                window.location.href='contact.php';
                </script>";
    }

}

function display_orders(){
    $query = query("SELECT * FROM customerorder INNER JOIN orderitem ON customerorder.order_id = orderitem.order_id INNER JOIN coffee on orderitem.coffee_id = coffee.coffee_id ORDER BY date DESC");
    confirm($query);

    while($row = fetch_array($query)){
        $orders = <<<DELIMITER
<tr>
            <td>{$row['customer_id']}</td>
            <td>{$row['coffee_name']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['type']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['date']}</td>
           <td>Completed</td>
        </tr>
DELIMITER;
        echo $orders;

    }
}

function display_current_orders(){
    $query = query("SELECT * FROM customerorder INNER JOIN orderitem ON customerorder.order_id = orderitem.order_id INNER JOIN coffee on orderitem.coffee_id = coffee.coffee_id ORDER BY date DESC LIMIT 10");
    confirm($query);

    while($row = fetch_array($query)){
        $orders = <<<DELIMITER
<tr>
            <td>{$row['customer_id']}</td>
            <td>{$row['coffee_name']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['type']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['date']}</td>
            <td>Completed</td>
        </tr>
DELIMITER;
        echo $orders;

    }
}

function get_coffees_in_admin(){
    $query = query(" SELECT * FROM coffee INNER JOIN size ON coffee.coffee_id = size.coffee_id ORDER BY coffee.coffee_id, type_ref");
    confirm($query);

    while($row = fetch_array($query)){
        $coffee = <<<DELIMITER
            <tr>
            <td>{$row['coffee_id']}</td>
            <td>{$row['coffee_name']}<br>
              <a href="index.php?edit_coffee&id={$row['coffee_id']}&size={$row['type_ref']}"><img src="{$row['coffee_image']}" alt="" style="max-width: 62px; max-height: 62px;"></a>
            </td>
            <td>{$row['type']}</td>
            <td>{$row['cost']} TL</td>
            <td><a class="btn btn-danger" href="delete_coffee.php"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMITER;
        echo $coffee;
    }
}


function add_coffee(){
    if(isset($_POST['publish'])){
        $coffee_name = escape_string($_POST['coffee_name']);
        $coffee_description = escape_string($_POST['coffee_description']);
        $coffee_price = escape_string($_POST['coffee_price']);
        $coffee_size = escape_string($_POST['coffee_size']);
        $coffee_image = escape_string($_FILES['file']['name']);
        $image_temp_location = escape_string($_FILES['file']['tmp_name']);
        $coffee_image = "localhost/WebMidterm/resources/images/" . $coffee_image;

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $coffee_image);

        $query2 = query("SELECT * FROM coffee WHERE coffee_name = '$coffee_name' ORDER BY coffee_id DESC");
        confirm($query2);
        if(mysqli_num_rows($query2) == 0){
            $query = query("INSERT INTO coffee (coffee_name, coffee_description, coffee_image) VALUES ('$coffee_name', '$coffee_description', '$coffee_image')");
            confirm($query);
        }

        $query2 = query("SELECT * FROM coffee WHERE coffee_name = '$coffee_name' ORDER BY coffee_id DESC");
        confirm($query2);

        while($row = fetch_array($query2)){
            $type_ref = 2;
            if(strcasecmp($coffee_size, "tall") == 0){
                $type_ref = 1;
            }
            elseif(strcasecmp($coffee_size, "venti") == 0){
                $type_ref = 3;
            }
            $coffee_id = $row['coffee_id'];
            $query = query("INSERT INTO size (coffee_id, cost, type, type_ref) VALUES ('$coffee_id', '$coffee_price', '$coffee_size', '$type_ref')");
            confirm($query);

        }

            echo "<script>
                alert('Coffee Added Successfully');
                window.location.href='index.php?coffees';
                </script>";



    }
}

function edit_coffee(){
    if(isset($_POST['publish'])){
        $coffee_name = escape_string($_POST['coffee_name']);
        $coffee_description = escape_string($_POST['coffee_description']);
        $coffee_price = escape_string($_POST['coffee_price']);
        $coffee_size = escape_string($_POST['coffee_size']);
        $coffee_id = escape_string($_POST['coffee_id']);
        $coffee_image = escape_string($_FILES['file']['name']);
        $image_temp_location = escape_string($_FILES['file']['tmp_name']);
        $coffee_image = "localhost/WebMidterm/resources/images/" . $coffee_image;

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $coffee_image);

        if('$coffee_name' != ""){
            $query = query("UPDATE coffee SET coffee_name = '$coffee_name', coffee_description = '$coffee_description' WHERE coffee_id = '$coffee_id'");
            confirm($query);
        }

        elseif('$coffee_name' == ""){
            $query = query("UPDATE coffee SET coffee_description = '$coffee_description' WHERE coffee_id = '$coffee_id'");
            confirm($query);
        }

        if('$coffee_description' != ""){
            $query = query("UPDATE coffee SET coffee_description = '$coffee_description' WHERE coffee_id = '$coffee_id'");
            confirm($query);
        }

        $type_ref = 2;
        if($coffee_size == "Tall"){
            $type_ref = 1;
        }
        elseif($coffee_size == "Venti"){
            $type_ref = 3;
        }
        $query = query("UPDATE size SET cost = '$coffee_price', type = '$coffee_size', type_ref = '$type_ref' WHERE coffee_id = '$coffee_id'");
        confirm($query);


        echo "<script>
                alert('Coffee Updated Successfully');
                window.location.href='index.php?coffees';
                </script>";



    }
}

function admin_users(){
    $user_query = query("SELECT * FROM customer");
    confirm($user_query);

    while($row = fetch_array($user_query)){
        $customer_id = $row['customer_id'];
        $username = $row['username'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $post_code = $row['post_code'];
        $user = <<<DELIMITER
<tr>
<td>{$customer_id}</td>
<td>{$username}</td>
<td>{$first_name}</td>
<td>{$last_name}</td>
<td>{$post_code}</td>
<td><a class="btn btn-danger" href="delete_coffee.php"><span class="glyphicon glyphicon-remove"></span></a></td>
DELIMITER;
echo $user;
    }
}

?>