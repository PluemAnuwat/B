<?php
// echo '<pre>'.print_r($_REQUEST, 1).'</pre>';
//   echo '<pre>$_GET: '.print_r($_GET, 1).'</pre>';
echo '<pre>$_POST : ' . print_r($_POST, 1) . '</pre>';

$date = date('Y-m-d');
$con = mysqli_connect("localhost", "root", "", "dachai");


foreach ($_POST['product_id'] as $key =>  $value) {
    if (@$product_start_date == '' && @$product_end_date == '') {
        $product_start_date = $date;
        $product_end_date = date('Y-m-d', strtotime(@$now . "+3 years"));
    } else {
        $product_start_date = $_POST['product_start_date'][$key];
        $product_end_date = $_POST['product_end_date'][$key];
    }
    $sql1 = "INSERT INTO product_date (product_start_date , product_end_date , product_create_date , product_id , good_RefNo)  
                values('$product_start_date' ,'$product_end_date' , '$date' , '{$value}','{$_POST['good_RefNo'][$key]}')";
    $query1 = mysqli_query($con, $sql1);
    // echo $product_start_date;
    // echo $product_end_date ; 
    // exit;

    $sqll = "SELECT * FROM product_quantity WHERE product_id  = '{$value}' ";
    $queryy = mysqli_query($con, $sqll);
    $result = mysqli_fetch_assoc($queryy);


    $oldnet =  $result['product_quantity'];
    $newnet = $oldnet + $_POST['product_quantity'][$key];
    $sql9 = "UPDATE product_quantity SET product_quantity = '$newnet'   , good_RefNo = '{$_POST['good_RefNo'][$key]}' WHERE product_id  = '{$value}'";
    $resuu = mysqli_query($con, $sql9);
    // echo $sqll;
    // echo $oldnet;
    // echo $newnet;
    echo '<pre>' . print_r($sql9, 1) . '</pre>';
    // สังเกตุว่ามันปรินท์รอบเสียง ก็สันนิษฐานได้ว่าก็น่าจะมีการอัพเดทรอบเดียว ควรจะลองแบบสองรอบด้วยเพื่อให้แน่ใจ

    // สรุป คือ แค่เราเปลี่ยนจาก $_POST['product_id'] เป็น $value แล้วมัน error เราก็คิดว่าการแก้นี้ไม่ใช่การแก้ไขที่ถูกต้อง ทั้งๆ ที่จริงๆ มันมีที่ผิดที่อื่นอีกอย่างน้อยสองจุด ตามที่อธิบายด้านบน เราควรจะไล่และ debug ให้เปิด อ่าน error ให้เข้าใจ เราไม่ได้กำลังพัฒนาโปรแกรม แต่เรากำลังพัฒนาความเข้าใจของตัวเรา
}


$sql10 = "UPDATE good SET good_status = 1 WHERE good_RefNo = '{$_POST['good_RefNo'][$key]}'";
$query10 = mysqli_query($con, $sql10);

$sql11 = "UPDATE po SET po_status = 'ได้รับสินค้า เข้าสต็อกแล้ว'  WHERE po_id = '{$value}'";

$sqlstatus = "UPDATE  view_po_show SET po_status = 'ได้รับสินค้า เข้าสต็อกแล้ว'  ";
$resustatus = mysqli_query($con, $sqlstatus);

if (mysqli_query($con, $sql11)) {
    $alert = '<script type="text/javascript">';
    $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
    $alert .= 'window.location.href = "?page=good";';
    $alert .= '</script>';
    echo $alert;
    exit();
} else {
    echo "Error: " . $sqlp . "<br>" . mysqli_error($con);
}
mysqli_close($con);
