<?php
if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "DELETE FROM category WHERE category_id = '$category_id' "; 
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