<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["unit_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE unit SET ".$_POST["column_name"]."='".$value."' WHERE unit_id = '".$_POST["unit_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>