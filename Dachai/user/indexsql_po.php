<?php
$sql = "SELECT   * , count(a.po_RefNo) as count ,
SUM(c.product_price_cost *  a.product_quantity) * 0.07 + sum(c.product_price_cost * a.product_quantity) as sum
 from view_po_show a left join partner b ON a.po_saler = b.partner_id LEFT JOIN product_price c
ON a.product_id = c.product_id group by a.po_RefNo";
$rp = mysqli_query($con , $sql);
