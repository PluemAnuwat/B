<?php
if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
     $employee_id = $_GET['employee_id'];
     $sql = "SELECT * FROM employee  WHERE employee_id = '$employee_id'";
     $query = mysqli_query($con, $sql);
     $result = mysqli_fetch_assoc($query);
}
if (isset($_POST) && !empty($_POST)) {
     $employee_name = $_POST['employee_name'];
     $employee_phone = $_POST['employee_phone'];
     $employee_email = $_POST['employee_email'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     // $employee_role = $_POST['employee_role'];
     $oldimage = $_POST["oldimage"];
     if (isset($_FILES['employee_img']['name']) && !empty($_FILES['employee_img']['name'])) {
          $extension = array("jpeg", "jpg", "png");
          $target = './image/';
          $filename = $_FILES['employee_img']['name'];
          $filetmp = $_FILES['employee_img']['tmp_name'];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          if (in_array($ext, $extension)) {
               if (!file_exists($target . $filename)) {
                    if (move_uploaded_file($filetmp, $target . $filename)) {
                         $filename = $filename;
                    } else {
                         echo 'เพิ่มไม่สำเร็จ';
                    }
               } else {
                    $newfilename = time() . $filename;
                    if (move_uploaded_file($filetmp, $target . $newfilename)) {
                         $filename = $newfilename;
                    } else {
                         echo 'เพิ่มเข้าไม่ได้';
                    }
               }
          } else {
               echo 'ประเภทไม่ถูกต้อง';
          }
     } else {
          $filename = $oldimage;
     }
     $sql = "UPDATE employee SET employee_name='$employee_name',employee_phone='$employee_phone' , employee_img= '$filename' , 
    employee_email = '$employee_email'  , username = '$username' ,  password = '$password'  , employee_role = '$_SESSION[posit_login]'  WHERE employee_id = '$employee_id'";
    if(mysqli_query($con,$sql)){
     $alert = '<script type="text/javascript">';
     $alert .= 'alert("แก้ไขเรียบร้อย !!");';
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
