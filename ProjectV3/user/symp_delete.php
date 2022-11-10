
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["symp_id"]))
{
 $query = "DELETE FROM symptons WHERE symp_id = '".$_POST["symp_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'ลบข้อมูลแล้ว';
 }else
 echo 'เกิดความผิดพลาด';
}
?>