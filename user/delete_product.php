<?php
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // $sql = "DELETE FROM product a left join product_price b on a.product_id = b.product_id 
    // join product_quantity c on a.product_id = c.product_id WHERE a.product_id = '$product_id' "; 

    $sql = "DELETE tb1 , tb2 , tb3 FROM product as tb1 , product_price as tb2 , product_quantity as tb3 
    WHERE tb1.product_id = tb2.product_id AND tb1.product_id = tb3.product_id AND tb1.product_id = '$product_id'";

    if (mysqli_query($con, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบข้อมูลสำเร็จ !!");';
        $alert .= 'window.location.href = "?page=product";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}
?>