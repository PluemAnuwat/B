<?php
if (isset($_GET['po_RefNo']) && !empty($_GET['po_RefNo'])) {
    $po_RefNo = $_GET['po_RefNo'];
    $sql = "UPDATE  view_po_show SET po_status = 'ยกเลิกการสั่งซื้อ' WHERE po_RefNo = '$po_RefNo' ";
    $query = mysqli_query($con, $sql);
    $date = date("Y-m-d H:i:s");

    $sql2 = "INSERT INTO po_status (	po_status , status_create ,  	po_RefNo ) VALUES ('ยกเลิกการสั่งซื้อ','$date','$po_RefNo')";
    if (mysqli_query($con, $sql2)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ยกเลิกการสั่งซื้อสำเร็จ !!");';
        $alert .= 'window.location.href = "?page=po";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}
