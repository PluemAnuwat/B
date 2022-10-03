<?php
if (isset($_GET['type_id']) & isset($_GET['type_name'])) {
  $type_id = $_GET['type_id'];
  $sql = "SELECT *   FROM view_product_stockv3  WHERE a.product_type ='$type_id'  ";
  $query = mysqli_query($con, $sql);
} else {
  $sql = "SELECT *   FROM view_product_stockv3   ";
  $query = mysqli_query($con, $sql);
}

$sql2 = "SELECT * FROM type_product";
$query2  = mysqli_query($con, $sql2);
