
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["symp_name"]))
{
 $symp_name = mysqli_real_escape_string($connect, $_POST["symp_name"]);
 $query = "INSERT INTO symptons(symp_name) VALUES('$symp_name')";
 if(mysqli_query($connect, $query))
 {
  echo 'เพิ่มเรียบร้อย';
 }
}
?>
