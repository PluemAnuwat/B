<?php
$datenow = date('Y-m-d');
$year = date("Y");
$date = date("Y-m-d");
$week = date("N", strtotime($datenow));
$week1 = date("W", strtotime($datenow));
$date = new DateTime();
$date->setISODate($year, $week1);
$start = $date->format("Y-m-d");
$date->setISODate($year, $week1, 7);
$end = $date->format("Y-m-d");


$sql_stock = "SELECT COUNT(product_id) as count_stock FROM view_product_stock";
$query_stock = mysqli_query($con, $sql_stock);
$result_stock = mysqli_fetch_assoc($query_stock);

$sql_po = "SELECT COUNT(po_id) as count_po FROM view_po_show";
$query_po = mysqli_query($con, $sql_po);
$result_po = mysqli_fetch_assoc($query_po);

$sql_good = "SELECT COUNT(good_id) as count_good FROM view_good_show";
$query_good = mysqli_query($con, $sql_good);
$result_good = mysqli_fetch_assoc($query_good);


$sql = "SELECT * , COUNT(a.product_id) AS count_product , SUM(a.product_total) AS count_price   , MAX(a.product_quantity) AS maxstore
FROM view_sales_detail a WHERE a.sales_create = '$datenow' group by a.sales_create ";
$query = mysqli_query($con, $sql);

$sql1 = "SELECT * , COUNT(a.product_id) AS count_product , SUM(a.product_total) AS count_price  FROM view_sales_detail a 
 WHERE (a.sales_create BETWEEN '$start' AND  '$end') ";
$query1 = mysqli_query($con, $sql1);

$sql2 = "SELECT * 
FROM view_sales_detail a  ORDER BY a.product_quantity DESC LIMIT 0,5 ";
$query2 = mysqli_query($con, $sql2);


// print_r($query2);
// exit;
