<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["suppiles_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE suppiles SET ".$_POST["column_name"]."='".$value."' WHERE suppiles_id = '".$_POST["suppiles_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>