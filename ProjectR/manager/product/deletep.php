<?php

$connect = mysqli_connect("localhost", "root", "akom2006", "project");

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "DELETE tb1 , tb2 , tb3 , tb4 FROM product as tb1 , product_price as tb2 , product_quantity as tb3  , product_reorder as tb4
    WHERE tb1.product_id = tb2.product_id AND tb1.product_id = tb3.product_id AND tb1.product_id = tb4.product_id AND tb1.product_id = '$product_id'";

    if (mysqli_query($connect, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบข้อมูลสำเร็จ !!");';
        $alert .= 'window.location.href = "?page=product";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
    mysqli_close($connect);
}
?>