<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");

$con = mysqli_connect("localhost", "root", "", "dachai");
$sql = "SELECT * FROM view_product_stock  ";
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
        $sMessage =  "".$row['product_name']." : สินค้าหมดอายุ ".$row['product_name']." มีจำนวนทั้งหมด : ".$row['product_quantity']." ";
        break;
    case 4:
        $sMessage = "".$row['product_name']." : สินค้าชิ้นนี้จะหมดอายุในอีก 30 วัน ".$row['product_name']." มีจำนวนทั้งหมด : ".$row['product_quantity']." ";
        break;
    case 3:
        $sMessage = "".$row['product_name']." : สินค้าชิ้นนี้จะหมดอายุในอีก 15 วัน  ".$row['product_name']." มีจำนวนทั้งหมด : ".$row['product_quantity']." ";
        break;
    case 2:
        $sMessage = "".$row['product_name']." : สินค้าชิ้นนี้จะหมดอายุในอีก 7 วัน  ".$row['product_name']." มีจำนวนทั้งหมด : ".$row['product_quantity']." ";
        break;
    default:
        $sMessage = "".$row['product_name']." : สินค้าชิ้นนี้ยังไม่หมดอายุ ".$row['product_name']." มีจำนวนทั้งหมด : ".$row['product_quantity']." ";
        break;
}
// $sMessage = 'sasadad'; 
$sToken = "jSh4LM35SDRSjyIzTz1edFFMvi1ZAbRhjnfIjrAHDOO";
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
if(curl_error($chOne)) { 
 echo 'error:' . curl_error($chOne);
} 
else { 
 $result_ = json_decode($result, true); 
//  echo "status : ".$result_['status']; echo "message : ". $result_['message'];
} 
curl_close( $chOne );
echo "<script language='javascript'>history.back();</script>";
}
