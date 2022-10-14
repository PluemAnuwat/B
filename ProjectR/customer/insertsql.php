<?php
$con = mysqli_connect("localhost", "root", "akom2006", "dachai");
$customer_name = $_POST['customer_name'];
$customer_last = $_POST['customer_last'];
$customer_phone = $_POST['customer_phone'];
$customer_drug = $_POST['customer_drug'];
$sql="INSERT INTO `customer` (`customer_name`, `customer_last` , `customer_phone` , `customer_drug`) VALUES ( '$customer_name', '$customer_last' , '$customer_phone' , '$customer_drug')";
$query  = mysqli_query($con  , $sql);
?>
