<?php
// $sql = "select  * , count(a.po_RefNo) as count from view_po_show a group by a.po_RefNo";
$sql = "SELECT * , 
CASE  
WHEN  a.good_status = 0 THEN 'อยู่ในสถานะรอยืนยัน' 
WHEN  a.good_status = 1 THEN 'ยืนยันการรับสินค้าแล้ว'
END AS status ,
 count(a.good_RefNo) AS count 
 FROM view_good_show a 
 WHERE a.good_status = 0  
 GROUP BY  a.good_RefNo DESC";
$query = mysqli_query($con , $sql);
?>