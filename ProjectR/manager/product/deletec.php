
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["cate_id"]))
{
 $query = "DELETE FROM category WHERE cate_id = '".$_POST["cate_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'ลบข้อมูลแล้ว';
 }else
 echo 'เกิดความผิดพลาด';
}
?>