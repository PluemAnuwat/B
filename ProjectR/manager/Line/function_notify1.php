<?php
// $url        = 'https://notify-api.line.me/api/notify';
// $token      = 'VR660oYFeKCH2i8cjejICgKwLMJ56i610FcMdC4oVcb';
// $headers    = [
//     'Content-Type: application/x-www-form-urlencoded',
//     'Authorization: Bearer ' . $token
// ];

// $con = mysqli_connect("localhost", "root", "akom2006", "project");

// $sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
// FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
// INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
// INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
// INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id GROUP BY a.product_id   ";
// $result = mysqli_query($con, $sql);

// while ($row = mysqli_fetch_array($result)) { 
// function status_date_notify($endDate)
// {
//     $chk_day_now = time();
//     $chk_day_expire = strtotime($endDate);
//     $chk_day30 = strtotime($endDate . " -30 day");
//     $chk_day15 = strtotime($endDate . " -15 day");
//     $chk_day7 = strtotime($endDate . " -7 day");
//     //  สามารถเพิ่มตัวแปร และเงื่อนไข เพิ่มเติมสำหรับตรวจสอบได้ตามต้องการ
//     if ($chk_day_now >= $chk_day_expire) {
//         return 5; // เงื่อนไขรายการเมื่อหมดอายุ
//     } else {
//         if ($chk_day_now >= $chk_day30 && $chk_day_now < $chk_day15) {
//             return 4; // เงื่อนไขรายการจะหมดอายุในอีก 30 วัน
//         } elseif ($chk_day_now >= $chk_day15 && $chk_day_now < $chk_day7) {
//             return 3; // เงื่อนไขรายการจะหมดอายุในอีก 15 วัน
//         } elseif ($chk_day_now >= $chk_day7 && $chk_day_now < $chk_day_expire) {
//             return 2; // เงื่อนไขรายการจะหมดอายุในอีก 7 วัน
//         } else {
//             return 1; // เงื่อนไขรายการยังไม่หมดอายุ
//         }
//     }
// }
// $case_notify = status_date_notify(($row['product_end_date']));
// switch ($case_notify) {
//     case 5:
//         $fields = 'สินค้าเมื่อหมดอายุ';
//         break;
//     case 4:
//         $fields = 'สินค้าจะหมดอายุในอีก 30 วัน';
//         break;
//     case 3:
//         $fields = 'สินค้าจะหมดอายุในอีก 15 วัน ';
//         break;
//     case 2:
//         $fields = 'สินค้าจะหมดอายุในอีก 7 วัน ';
//         break;
//     default:
//         $fields = 'ยังไม่หมดอายุ';
//         break;
// }
// }
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $result = curl_exec($ch);
// curl_close($ch);

// var_dump($result);
// $result = json_decode($result, TRUE);
// ?>

<!-- jSh4LM35SDRSjyIzTz1edFFMvi1ZAbRhjnfIjrAHDOO -->



<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "Uv0soCK4s2VPPiO1s8DpbBYp5mHdqz9Y9p5NUpiPsRZ";


require 'functionDateThai.php'; 

$con = mysqli_connect("localhost", "root", "akom2006", "project");

$sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id 
INNER JOIN unit sss ON a.product_unit = sss.unit_id
GROUP BY a.product_id   ";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) { 
function status_date_notify($endDate)
{
    $chk_day_now = time();
    $chk_day_expire = strtotime($endDate);
    $chk_day30 = strtotime($endDate . " -30 day");
    $chk_day15 = strtotime($endDate . " -15 day");
    $chk_day7 = strtotime($endDate . " -7 day");
    //  สามารถเพิ่มตัวแปร และเงื่อนไข เพิ่มเติมสำหรับตรวจสอบได้ตามต้องการ
    if ($chk_day_now >= $chk_day_expire) {
        return 5; // เงื่อนไขรายการเมื่อหมดอายุ
    } else {
        if ($chk_day_now >= $chk_day30 && $chk_day_now < $chk_day15) {
            return 4; // เงื่อนไขรายการจะหมดอายุในอีก 30 วัน
        } elseif ($chk_day_now >= $chk_day15 && $chk_day_now < $chk_day7) {
            return 3; // เงื่อนไขรายการจะหมดอายุในอีก 15 วัน
        } elseif ($chk_day_now >= $chk_day7 && $chk_day_now < $chk_day_expire) {
            return 2; // เงื่อนไขรายการจะหมดอายุในอีก 7 วัน
        } else {
            return 1; // เงื่อนไขรายการยังไม่หมดอายุ
        }
    }
}
$case_notify = status_date_notify(($row['product_end_date']));
switch ($case_notify) {
    case 5:
        $fields = 'สินค้าเมื่อหมดอายุ';
        break;
    case 4:
        $fields = 'สินค้าจะหมดอายุในอีก 30 วัน';
        break;
    case 3:
        $fields = 'สินค้าจะหมดอายุในอีก 15 วัน ';
        break;
    case 2:
        $fields = 'สินค้าจะหมดอายุในอีก 7 วัน ';
        break;
    default:
        $fields = 'ยังไม่หมดอายุ';
        break;
}


$productqty = $row['product_quantity'];
$point = $row['point'];
if ($productqty <= $point) { 
$pointmsg = "ถึงจุดสั่งซื้อ";
}else{
$pointmsg = "ไม่ถึงจุดสั่งซื้อ";
}

$sMessage = '
<----- สถานะของสินค้า ----->
รายการสินค้า :'.$row['product_name'].'
วันที่ผลิต : '.datethai($row['product_start_date']).'
วันที่หมดอายุ : '.datethai($row['product_end_date']).'
สถานะของสินค้า : ' .$fields . ' 
<---------- จุดสั่งซื้อ ---------->
จุดสั่งซื้อที่กำหนด : '.$point.'
จำนวนสินค้า : '.$row['product_quantity'].$row['unit_name'].'
สถานะจุดสั่งซื้อ : '.$pointmsg.'
';


// $sql1 = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id   group by sales.sales_RefNo ";
// $query1 = mysqli_query($con , $sql1);
// while ($row1 = mysqli_fetch_array($query1)) { 

                
    
//                  $sql2 = "SELECT sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name  
//                  FROM sales INNER JOIN product ON sales.product_id = product.product_id
//                 JOIN product_price AS c ON sales.product_id = c.product_id 
//                 WHERE sales_RefNo = '".$row1['sales_RefNo']."'    " ;
//                      $query2 = mysqli_query($con , $sql2);
//                      while ($result2 = mysqli_fetch_array($query2)){ 
//                         $sMessage1 = '
//                         <----- ขายสินค้า ----->
//                         วันที่ขาย : '.datethai($row1['sales_date']).'
//                         รหัสการขาย :'.$row1['sales_RefNo'].'
//                         รายการสินค้า :'.$result2['product_name'].'
//                         จำนวน :'.$result2['product_quantity'].'
//                         ราคาต่อหน่วย :'.number_format($result2['product_price_sell'],2).' บาท
//                         ราคารวมภาษี :'.number_format(($result2['product_price_sell'] * 0.07) +  ($result2['product_price_sell'] *  $result2['product_quantity']  )  ,2). ' บาท
//                         ';
//                 }

//                 }
//             }

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

    header("location:../index.php");
   
?>
