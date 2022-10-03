<?php
if (isset($_GET['po_RefNo']) && !empty($_GET['po_RefNo'])) {
     $po_RefNo = $_GET['po_RefNo'];
     $sql = "SELECT * ,(c.product_price_cost * a.product_quantity) as plusel  
      FROM view_po_show a join view_product_detail b ON a.product_id = b.product_id 
     join view_product_price c on a.product_id = c.product_id  JOIN partner  d ON a.po_saler = d.partner_id
      WHERE po_RefNo = '$po_RefNo'";
      $query = mysqli_query($con, $sql);
      $resultq = mysqli_num_rows($query);

      $sql1 = "SELECT * , sum(c.product_price_cost * a.product_quantity ) as qty ,
       sum(c.product_price_cost )  as sum ,
       sum(c.product_price_cost * a.product_quantity ) * 0.07 + sum(c.product_price_cost * a.product_quantity ) as vat ,
       sum(c.product_price_cost * a.product_quantity ) * 0.07 as vatt
       FROM view_po_show a join view_product_detail b ON a.product_id = b.product_id 
      join view_product_price c on a.product_id = c.product_id 
       WHERE po_RefNo = '$po_RefNo'";
  $query1 = mysqli_query($con, $sql1);
  $result1 = mysqli_fetch_assoc($query1);

  $sql2 = "SELECT * FROM po_status    WHERE po_RefNo = '$po_RefNo' group by po_RefNo"; 
  $query2 = mysqli_query($con , $sql2);
  $result2 = mysqli_num_rows($query2);
}
