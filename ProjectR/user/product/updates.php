<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["symp_id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE symptons SET ".$_POST["column_name"]."='".$value."' WHERE symp_id = '".$_POST["symp_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>