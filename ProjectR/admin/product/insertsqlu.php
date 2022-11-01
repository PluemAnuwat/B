
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["unit_name"]))
{
 $unit_name = mysqli_real_escape_string($connect, $_POST["unit_name"]);
 $query = "INSERT INTO unit(unit_name) VALUES('$unit_name')";
 if(mysqli_query($connect, $query))
 {
  echo 'เพิ่มเรียบร้อย';
 }
}
?>
