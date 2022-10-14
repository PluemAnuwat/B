<?php
$con = mysqli_connect("localhost", "root", "akom2006", "dachai");
if (isset($_POST) && !empty($_POST)) {
    $type_name = $_POST['type_name'];
    $sql = "INSERT INTO type_product(type_name) VALUES ('$type_name')";
$query = mysqli_query($con , $sql);
}
    //      if(mysqli_query($con,$sql)){
//           $alert = '<script type="text/javascript">';
//           $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
//           $alert .= 'window.location.href = "?page=type";';
//           $alert .= '</script>';
//           echo $alert;
//           exit();
//      } else {
//           echo "Error: " . $sql . "<br>" . mysqli_error($con);
//      }
//      mysqli_close($con);
// }
?>