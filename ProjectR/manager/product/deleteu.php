
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["unit_id"]))
{
 $query = "DELETE FROM unit WHERE unit_id = '".$_POST["unit_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'ลบข้อมูลแล้ว';
 }else
 echo 'เกิดความผิดพลาด';
}
?>