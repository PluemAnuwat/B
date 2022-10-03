<?php
if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    // $sql = "DELETE FROM product a left join product_price b on a.customer_id = b.customer_id 
    // join product_quantity c on a.customer_id = c.customer_id WHERE a.customer_id = '$customer_id' "; 

    $sql = "DELETE FROM customer WHERE customer_id = '$customer_id'";

    if (mysqli_query($con, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบข้อมูลสำเร็จ !!");';
        $alert .= 'window.location.href = "?page=customer";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}
?>