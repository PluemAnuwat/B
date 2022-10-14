<?php
$url        = 'https://notify-api.line.me/api/notify';
$token      = 'jSh4LM35SDRSjyIzTz1edFFMvi1ZAbRhjnfIjrAHDOO';
$headers    = [
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer ' . $token
];

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
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

var_dump($result);
$result = json_decode($result, TRUE);
?>

<!-- jSh4LM35SDRSjyIzTz1edFFMvi1ZAbRhjnfIjrAHDOO -->