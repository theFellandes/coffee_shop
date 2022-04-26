<?php require_once("../../resources/config.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $size = $_GET['size'];
    echo $id;
    echo $size;

    $query = query("DELETE FROM coffee INNER JOIN size ON size.type_ref = " . escape_string($size) . " WHERE coffee_id = " . escape_string($id));
    confirm($query);

    echo "<script>
                alert('Item deleted.');
                window.location.href='index.php';
                </script>";
}
