<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "Uv0soCK4s2VPPiO1s8DpbBYp5mHdqz9Y9p5NUpiPsRZ";


require 'functionDateThai.php'; 

$con = mysqli_connect("localhost", "root", "akom2006", "project");



while ($row = mysqli_fetch_array($result)) { 



$sql1 = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id   group by sales.sales_RefNo ";
$query1 = mysqli_query($con , $sql1);
while ($row1 = mysqli_fetch_array($query1)) { 
    
                 $sql2 = "SELECT sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name  
                 FROM sales INNER JOIN product ON sales.product_id = product.product_id
                JOIN product_price AS c ON sales.product_id = c.product_id 
                WHERE sales_RefNo = '".$row1['sales_RefNo']."'    " ;
                     $query2 = mysqli_query($con , $sql2);
                     while ($result2 = mysqli_fetch_array($query2)){ 
                        $sMessage1 = '
                        <----- ขายสินค้า ----->
                        วันที่ขาย : '.datethai($row1['sales_date']).'
                        รหัสการขาย :'.$row1['sales_RefNo'].'
                        รายการสินค้า :'.$result2['product_name'].'
                        จำนวน :'.$result2['product_quantity'].'
                        ราคาต่อหน่วย :'.number_format($result2['product_price_sell'],2).' บาท
                        ราคารวมภาษี :'.number_format(($result2['product_price_sell'] * 0.07) +  ($result2['product_price_sell'] *  $result2['product_quantity']  )  ,2). ' บาท
                        ';
                }

                }
            }

                    
 

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage.$sMessage1); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        
	} 
	curl_close( $chOne );   
   
?>
<script>
