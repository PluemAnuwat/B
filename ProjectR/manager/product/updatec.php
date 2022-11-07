<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["cate_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE category SET ".$_POST["column_name"]."='".$value."' WHERE cate_id = '".$_POST["cate_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>