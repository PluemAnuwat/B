<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["customer_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE customer SET ".$_POST["column_name"]."='".$value."' WHERE customer_id = '".$_POST["customer_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>