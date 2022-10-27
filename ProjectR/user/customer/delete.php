
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["customer_id"]))
{
 $query = "DELETE FROM customer WHERE customer_id = '".$_POST["customer_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'ลบข้อมูลแล้ว';
 }else
 echo 'เกิดความผิดพลาด';
}
?>