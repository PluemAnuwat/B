<?php
if (isset($_POST) && !empty($_POST)) {
     $employee_name = $_POST['employee_name'];
     $employee_email = $_POST['employee_email'];
     $employee_phone = $_POST['employee_phone'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     $employee_role = $_POST['employee_role'];

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
          $filename = '';
     }
     $sqlp = "INSERT INTO employee (employee_img,employee_email  ,password,username,employee_phone,employee_name,employee_role) 
VALUES ('$filename','$employee_email'  ,'$password','$username','$employee_phone','$employee_name','$employee_role')";

     if (mysqli_query($con, $sqlp)) {
          $alert = '<script type="text/javascript">';
          $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
          $alert .= 'window.location.href = "?page=employee";';
          $alert .= '</script>';
          echo $alert;
          exit();
     } else {
          echo "Error: " . $sqlp . "<br>" . mysqli_error($con);
     }
     mysqli_close($con);
}
