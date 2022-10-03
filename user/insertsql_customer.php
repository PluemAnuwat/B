<?php
if (isset($_POST) && !empty($_POST)) {
    $customer_name = $_POST['customer_name'];
    $customer_last = $_POST['customer_last'];
    $customer_phone = $_POST['customer_phone'];
    $customer_drug = $_POST['customer_drug'];
    $sqlp = "INSERT INTO customer ( customer_last  ,customer_drug,customer_phone,customer_name) 
VALUES ( '$customer_last'  ,'$customer_drug','$customer_phone','$customer_name')";

    if (mysqli_query($con, $sqlp)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
        $alert .= 'window.location.href = "?page=customer";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sqlp . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}
