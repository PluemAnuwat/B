<?php
if (isset($_GET['partner_id']) && !empty($_GET['partner_id'])) {
     $partner_id = $_GET['partner_id'];
     $sql = "SELECT * FROM partner AS a LEFT JOIN partner_detail AS b ON a.partner_id = b.partner1_id  WHERE a.partner_id = '$partner_id'";
        $query = mysqli_query($con, $sql);
     $result = mysqli_fetch_assoc($query);
}
if (isset($_POST) && !empty($_POST)) {
     $partner_name = $_POST['partner_name'];
     $partner_email = $_POST['partner_email'];
     $partner_phone = $_POST['partner_phone'];
     $partnerd_pro = $_POST['partnerd_pro'];
     $partnerd_amp = $_POST['partnerd_amp'];
     $partnerd_dis = $_POST['partnerd_dis'];
     $sql = "UPDATE partner SET partner_name='$partner_name' , partner_email = '$partner_email' , partner_phone = '$partner_phone'  WHERE partner_id = '$partner_id'";
     $query = mysqli_query($con , $sql);
     
     $sql1 = "UPDATE partner_detail SET partnerd_pro = '$partnerd_pro' , partnerd_amp = '$partnerd_amp' , partnerd_dis = '$partnerd_dis' WHERE partner1_id = '$partner_id'";
     if(mysqli_query($con,$sql1)){
          $alert = '<script type="text/javascript">';
          $alert .= 'alert("แก้ไขเรียบร้อย !!");';
          $alert .= 'window.location.href = "?page=suppiles";';
          $alert .= '</script>';
          echo $alert;
          exit();
     } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
     }
     mysqli_close($con);
}
