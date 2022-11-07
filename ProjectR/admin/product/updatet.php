<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["type_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE type_product SET ".$_POST["column_name"]."='".$value."' WHERE type_id = '".$_POST["type_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>