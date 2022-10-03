<?php
if (isset($_GET['symp_id']) && !empty($_GET['symp_id'])) {
    $symp_id = $_GET['symp_id'];
    $sql = "DELETE FROM sympton WHERE symp_id = '$symp_id' "; 
            if (mysqli_query($con, $sql)) {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("ลบข้อมูลสำเร็จ !!");';
                $alert .= 'window.location.href = "?page=type";';
                $alert .= '</script>';
                echo $alert;
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            mysqli_close($con);
}