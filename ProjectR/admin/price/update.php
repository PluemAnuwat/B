<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["product_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE product_price SET ".$_POST["column_name"]."='".$value."' WHERE product_id = '".$_POST["product_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>