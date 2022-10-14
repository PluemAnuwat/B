<?php
if (isset($_GET['partner_id']) && !empty($_GET['partner_id'])) {
    $partner_id = $_GET['partner_id'];
    // $sql = "DELETE FROM product a left join product_price b on a.employee_id = b.employee_id 
    // join product_quantity c on a.employee_id = c.employee_id WHERE a.employee_id = '$employee_id' "; 

    $sql = "DELETE partner_detail , partner FROM partner,partner_detail  WHERE (partner_id = '$partner_id') AND (partner1_id = '$partner_id') ";


    if (mysqli_query($con, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบข้อมูลสำเร็จ !!");';
        $alert .= 'window.location.href = "?page=suppiles";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}
?>