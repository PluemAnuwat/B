<?php
$con = mysqli_connect("localhost", "root", "", "dachai");
if (isset($_POST) && !empty($_POST)) {
    $symp_name = $_POST['symp_name'];
    $sql = "INSERT INTO sympton(symp_name) VALUES ('$symp_name')";
     if(mysqli_query($con,$sql)){
          $alert = '<script type="text/javascript">';
          $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
          $alert .= 'window.location.href = "?page=symp";';
          $alert .= '</script>';
          echo $alert;
          exit();
     } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
     }
     mysqli_close($con);
}
?>