<?php
if (isset($_GET['good_RefNo']) && !empty($_GET['good_RefNo'])) {
  $good_RefNo = $_GET['good_RefNo'];
  $sql = "SELECT *  , sum(c.product_price_cost * a.product_quantity ) as qty ,
  sum(c.product_price_cost )  as sum ,
  sum(c.product_price_cost * a.product_quantity ) * 0.07 + sum(c.product_price_cost * a.product_quantity ) as vat ,
  sum(c.product_price_cost * a.product_quantity ) * 0.07 as vatt
   ,(c.product_price_cost * a.product_quantity) as plusel  
   FROM view_good_show a left join view_product_detail b on 
  a.product_id = b.product_id 
  left join view_product_price c
   on a.product_id = c.product_id  
   WHERE a.good_RefNo = '$good_RefNo'";
  $query = mysqli_query($con, $sql);
  $result1 = mysqli_fetch_assoc($query);
}
?>