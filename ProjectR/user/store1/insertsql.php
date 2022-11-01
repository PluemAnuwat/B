<?php
session_start();

$connect = mysqli_connect("localhost","root","akom2006","project");


function random_char($len)
{
     $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; //ตัวอักษรที่สามารถสุ่มได้
     $ret_char = "";
     $num = strlen($chars);
     for ($i = 0; $i < $len; $i++) {
          $ret_char .= $chars[rand() % $num];
          $ret_char .= "";
     }
     return $ret_char;
}

//   $strSQL = "
// 	INSERT INTO po (po_create,po_RefNo,po_buyer,po_saler,po_status)
// 	VALUES
// 	('".date("Y-m-d H:i:s")."','".$_POST["po_RefNo"]."','0' ,'".$_POST["po_saler"]."','รอยืนยัน') ";

//   print_r($strSQL);

//   mysqli_query($connect , $strSQL) or die(mysqli_error());

//   $strOrderID = mysqli_insert_id($connect);
  for($i=0;$i<=(int)$_SESSION["intLine1"];$i++)
  {
	  if($_SESSION["strProductID1"][$i] != "")
	  {

                    $das = random_char(10);
			$strSQL = "
				INSERT INTO sales (sales_RefNo , sales_date,sales_get,product_quantity,customer_id,product_id,sales_change,product_total,user_login)
				VALUES
				('".$das."' , '".date("Y-m-d H:i:s")."','".$_POST['sales_get']."','".$_SESSION["strQty1"][$i]."','".$_POST['customer_id']."','".$_SESSION["strProductID1"][$i]."','','".$VatTotal."','".$_SESSION['user_login']."') 
			";
				$resultSQL = mysqli_query($connect , $strSQL);


               $strQTY = "SELECT * FROM product_quantity";
               $resultQTY = mysqli_query($connect  , $strQTY);
               $queryQTY = mysqli_fetch_array($resultQTY);

               $oldqty = $queryQTY['product_quantity'];
               $newqty = $oldqty - $_SESSION['strQty1'][$i]; 

               $strSQL1 = "
                    UPDATE product_quantity SET product_quantity = '$newqty' WHERE product_id = '".$_SESSION['strProductID1'][$i]."' " ; 
                    $resultSQL1 = mysqli_query($connect , $strSQL1);
               }
       
  }

  require '../functionDateThai.php' ;
  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  date_default_timezone_set("Asia/Bangkok");

  $sToken = "Uv0soCK4s2VPPiO1s8DpbBYp5mHdqz9Y9p5NUpiPsRZ";


$sql1 = "SELECT sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name  , sales.sales_date , sales.sales_RefNo
FROM sales INNER JOIN product ON sales.product_id = product.product_id
JOIN product_price AS c ON sales.product_id = c.product_id 
 WHERE sales.sales_RefNo = '".$das."' " ;
$query1 = mysqli_query($connect , $sql1) ;
while ($row1 = mysqli_fetch_array($query1)) { 
 
 $sMessage = '
<----- ขายสินค้า ----->
วันที่ขาย : '.datethai($row1['sales_date']).'
รหัสการขาย :'.$row1['sales_RefNo'].'
รายการสินค้า :'.$row1['product_name'].'
จำนวน :'.$row1['product_quantity'].'
ราคาต่อหน่วย :'.number_format($row1['product_price_sell'],2).' บาท
ราคารวมภาษี :'.number_format(($row1['product_price_sell'] * 0.07) +  ($row1['product_price_sell'] *  $row1['product_quantity']  )  ,2). ' บาท
                     ';
             }

          

  
  $chOne = curl_init(); 
  curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
  curl_setopt( $chOne, CURLOPT_POST, 1); 
  curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
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




mysqli_close();


session_destroy();

header("location:index.php?page=po");

?>