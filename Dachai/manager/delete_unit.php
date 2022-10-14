<?php
if (isset($_GET['unit_id']) && !empty($_GET['unit_id'])) {
    $unit_id = $_GET['unit_id'];
    $sql = "DELETE FROM unit WHERE unit_id = '$unit_id' "; 
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