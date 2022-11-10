<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if (isset($_GET['good_RefNo']) && !empty($_GET['good_RefNo'])) {
    $good_RefNo = $_GET['good_RefNo'];
    $product_id = $_GET['product_id'];
  
    $sql = "SELECT * , COUNT(a.product_quantity) as product_quantity
     FROM  product_quantity  a  
    INNER JOIN product_date b ON a.product_id = b.product_id
         WHERE a.good_RefNo = '$good_RefNo' and a.product_id = '".$product_id."' AND  b.product_end_date <= CURDATE() ";
    $query = mysqli_query($connect, $sql);
    $countnum = mysqli_num_rows($query);
    // print_r($sql);
    $result = mysqli_fetch_assoc($query) ;

}
   
      
        $good_RefNo = $_GET['good_RefNo'];
      
        $sqlstatus = "UPDATE  product_quantity  a  SET a.status = '1'  WHERE a.good_RefNo = '$good_RefNo' AND  a.product_id = '".$product_id."'";
        $querystatus = mysqli_query($connect , $sqlstatus);

        $sqldate = "UPDATE  product_date  a  SET a.status = '1'  WHERE a.good_RefNo = '$good_RefNo' AND  a.product_id = '".$product_id."'";
        $querydate = mysqli_query($connect , $sqldate);
        
        $sqlqtynew = "SELECT * FROM product b WHERE b.product_id = '".$product_id."'";
        $querynew = mysqli_query($connect , $sqlqtynew);
        $resultnew = mysqli_fetch_array($querynew);
        $oldqty = $resultnew['product_quantity'];
       
        $newqty = $oldqty - $result['product_quantity'];

       

        $updateqty = "UPDATE product SET product_quantity = '$newqty' WHERE product_id = '".$product_id."'";
        // print_r($updateqty);
        // exit;
        if(mysqli_query($connect , $updateqty)){
        echo "<script>";
        echo "alert(' ยกเลิกเรียบร้อย !');";
        echo "window.location='index.php?page=stock';";
        echo "</script>";
        }
    
?>