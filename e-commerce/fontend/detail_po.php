<?php 

session_start();

require_once 'includedb/condb.php';  

$sql = "SELECT * FROM akksofttech_purchase_order  WHERE po_id = '".$_GET['po_id']."' "   ;
 

$res = mysqli_query($conn , $sql) ; 


$sss  = mysqli_fetch_array($res)  ;
 
?>






<p><?php echo $sss['po_id'] ;  ?></p>