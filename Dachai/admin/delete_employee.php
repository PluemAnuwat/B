<?php
if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];
    // $sql = "DELETE FROM product a left join product_price b on a.employee_id = b.employee_id 
    // join product_quantity c on a.employee_id = c.employee_id WHERE a.employee_id = '$employee_id' "; 

    $sql = "DELETE FROM employee WHERE employee_id = '$employee_id'";

    if (mysqli_query($con, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบข้อมูลสำเร็จ !!");';
        $alert .= 'window.location.href = "?page=employee";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}
?>