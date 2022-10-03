<?php
$sql = "SELECT * , DATEDIFF(product_end_date,product_start_date) AS datediff FROM view_product_stockv3   ";
$result = mysqli_query($con, $sql); 
?>  