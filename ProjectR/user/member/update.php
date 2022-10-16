<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["employee_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE employee SET ".$_POST["column_name"]."='".$value."' WHERE employee_id = '".$_POST["employee_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>