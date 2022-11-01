
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["employee_id"]))
{
 $query = "DELETE FROM employee WHERE employee_id = '".$_POST["employee_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'ลบข้อมูลแล้ว';
 }else
 echo 'เกิดความผิดพลาด';
}
?>