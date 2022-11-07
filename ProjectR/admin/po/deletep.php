<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if (isset($_GET['po_RefNo']) && !empty($_GET['po_RefNo'])) {
    $po_RefNo = $_GET['po_RefNo'];
    $sql = "SELECT * FROM po a   WHERE a.po_RefNo = '$po_RefNo'";
    $query = mysqli_query($connect, $sql);
    $countnum = mysqli_num_rows($query);
}
while ($result = mysqli_fetch_assoc($query)) {
    $po_RefNo = $_GET['po_RefNo'];
  
    $sqlstatus = "UPDATE  po a  SET a.po_status = 'ยกเลิก'  WHERE a.po_RefNo = '$po_RefNo' ";
   

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
$sToken = "Uv0soCK4s2VPPiO1s8DpbBYp5mHdqz9Y9p5NUpiPsRZ";
require '../functionDateThai.php'; 
$con = mysqli_connect("localhost", "root", "akom2006", "project");
$product_name = "" ;
$product_quantity = "";
$sql1 = "SELECT product.product_name AS product_name , po_detailproduct.product_quantity AS  product_quantity FROM po JOIN po_detailproduct ON po.po_id = po_detailproduct.po_id 
INNER JOIN product ON po_detailproduct.product_id = product.product_id
 WHERE po.po_RefNo = '".$po_RefNo."' ";
$query1 = mysqli_query($con , $sql1);
while ($result1 = mysqli_fetch_array($query1)){ 
$product_name =  $product_name.$result1['product_name']."\r"."จำนวน : ".$product_quantity.$result1['product_quantity']. "\n" ;      
}
$sMessage1 = "
<===== ยกเลิกใบสั่งซื้อ  =====>
วันที่ยกเลิกใบสั่งซื้อ : ".datethai(date('Y-m-d H:i:s'))."
หมายเลขใบสั่งซื้อที่ยกเลิก : ".$po_RefNo."  
<===== รายการสินค้าที่ยกเลิก  =====> 
" .$product_name . "
";
    $chOne = curl_init(); 
    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt( $chOne, CURLOPT_POST, 1); 
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage1); 
    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec( $chOne ); 
    if(curl_error($chOne)) 
    { 
        echo 'error:' . curl_error($chOne); 
    } 
    else { 
        $result_ = json_decode($result, true); 
        echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        
    } 
    curl_close( $chOne );   
    if(mysqli_query($connect , $sqlstatus)){
    echo "<script>";
    echo "alert(' ยกเลิกเรียบร้อย !');";
    echo "window.location='index.php?page=po';";
    echo "</script>";
    }
}
?>