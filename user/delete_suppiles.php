<?php
if (isset($_GET['partner_id']) && !empty($_GET['partner_id'])) {
    $partner_id = $_GET['partner_id'];
    $sql = "DELETE a.* , b.* FROM partner a INNER JOIN partner_detail b on a.partner_id = b.partner1_id WHERE a.partner_id = '$partner_id' "; 
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