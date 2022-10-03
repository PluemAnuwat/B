<?php
if (isset($_POST) && !empty($_POST)) {
    $partner_name = $_POST['partner_name'];
    $partner_phone = $_POST['partner_phone'];
    $partner_email = $_POST['partner_email'];

    $sql = "INSERT INTO partner(partner_name,partner_phone,partner_email) 
    VALUES ('$partner_name','$partner_phone','$partner_email')";
    $query = mysqli_query($con,$sql);

    $new_partner_id = mysqli_insert_id($con);
    $partnerd_add = $_POST['partnerd_add'];
    $partnerd_pro = $_POST['partnerd_pro'];
    $partnerd_amp = $_POST['partnerd_amp'];
    $partnerd_geo = $_POST['partnerd_geo'];
    $partnerd_dis = $_POST['partnerd_dis'];
//    $partner_id = $_POST['partner_id'];

    $sql2 = "INSERT INTO partner_detail(partner1_id , partnerd_add,partnerd_pro,partnerd_geo,partnerd_amp,partnerd_dis) 
    VALUES ('$new_partner_id','$partnerd_add','$partnerd_pro','$partnerd_geo','$partnerd_amp','$partnerd_dis')";

    if(mysqli_query($con,$sql2)){
          $alert = '<script type="text/javascript">';
          $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
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