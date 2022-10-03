<?php
    $user = $_SESSION['user_login'];
    $sql = "SELECT * FROM employee  WHERE username = '$user'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($query);

if (isset($_POST) && !empty($_POST)) {
    if(isset($_POST['profile'])){
    $employee_name = $_POST["employee_name"];
    $employee_phone = $_POST["employee_phone"];
    $employee_email = $_POST["employee_email"];
    $oldimage = $_POST["oldimage"];
      $sql = "UPDATE employee SET employee_name='$employee_name', employee_phone= '$employee_phone'  ,  employee_email = '$employee_email'  
        WHERE username = '$user'";
  if (mysqli_query($con, $sql)) {
    $_SESSION['image_login'] = $filename;
      $alert = '<script type="text/javascript">';
      $alert .= 'alert("แก้ไขข้อมูลสำเร็จ !!");';
      $alert .= 'window.location.href = "?page=index_profile";';
      $alert .= '</script>';
      echo $alert;
      exit();
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
  mysqli_close($con);
}
}
    if(isset($_POST['checkpassword'])){
      $oldpassword = sha1(md5($_POST['oldpassword']));
      $newpassword = $_POST['newpassword'];
      $confirmpassword = $_POST['confirmpassword'];
      if (isset($oldpassword) && !empty($oldpassword)){
        $sql_check = "SELECT * FROM employee WHERE username = '$user' AND password = '$oldpassword' ";
        $query_check = mysqli_query($con, $sql_check);
        $row_check = mysqli_num_rows($query_check);
    if($row_check == 1){
      $alert = '<script type="text/javascript">';
            $alert .= 'alert("รหัสผ่านเก่าไม่ถูกต้อง กรุณาแก้ไขใหม่ !!");';
            $alert .= 'window.location.href = "?page=index_profile";';
            $alert .= '</script>';
            echo $alert;
            exit(); 
    }else{
if($newpassword != $confirmpassword){
  $alert = '<script type="text/javascript">';
            $alert .= 'alert("ยืนยันรหัสผ่านไม่ถูกต้อง กรุณาแก้ไขใหม่ !!");';
            $alert .= 'window.location.href = "?page=index_profile";';
            $alert .= '</script>';
            echo $alert;
            exit(); 
}else{
  $sql ="UPDATE employee SET password  = '$newpassword' WHERE username = '$user'";
  if (mysqli_query($con, $sql)) {
        $_SESSION['image_login'] = $filename;
          $alert = '<script type="text/javascript">';
          $alert .= 'alert("เปลี่ยนแปลงรหัสผ่านสำเร็จ !!");';
          $alert .= 'window.location.href = "?page=index_profile";';
          $alert .= '</script>';
          echo $alert;
          exit();
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
      }
      mysqli_close($con);
    }
  }
}
  }
   
?>