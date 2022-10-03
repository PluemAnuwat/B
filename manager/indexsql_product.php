<?php
$sql = "SELECT * FROM view_product_detail a left join view_product_price b on a.product_id = b.product_id  ";
$result = mysqli_query($con, $sql);
?>  