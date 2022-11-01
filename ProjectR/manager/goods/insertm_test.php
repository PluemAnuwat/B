<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>
<?php
// echo '<pre>'.print_r($_REQUEST, 1).'</pre>';
//   echo '<pre>$_GET: '.print_r($_GET, 1).'</pre>';

echo '<pre>$_POST : ' . print_r($_POST, 1) . '</pre>';
$date = date('Y-m-d H:i:s');



foreach ($_POST['product_id'] as $key =>  $value) {
    // $product_start_date = date('Y-m-d H:i:s',strtotime($_POST['product_start_date'][$key]));
    //   $product_end_date = date('Y-m-d H:i:s',strtotime($_POST['product_end_date'][$key]));

      // print_r($product_start_date);
    // print_r($product_end_date);

    $date = date('Y-m-d H:i:s');
    if ($product_start_date == '') {
        $product_start_date = date('Y-m-d H:i:s',strtotime($date));
        $product_end_date = date('Y-m-d H:i:s', strtotime(@$now . "+3 years"));
    } else if($product_start_date != '' & $product_end_date != '') {
        $product_start_date = date('Y-m-d H:i:s' , strtotime($_POST['product_start_date'][$key]));
        $product_end_date = date('Y-m-d H:i:s' , strtotime($_POST['product_end_date'][$key]));
    }else if($product_start_date != '' & $product_end_date == ''){
        $product_start_date = date('Y-m-d H:i:s' , strtotime($_POST['product_start_date'][$key]));
        $product_end_date = date('Y-m-d H:i:s', strtotime(@$now . "+3 years"));
    }
    // print_r(date('Y-m-d H:i:s' , strtotime($_POST['product_start_date'][$key])));

    $sql1 = "INSERT INTO product_date (product_start_date , product_end_date , product_create_date , product_id , good_RefNo)  
                values('$product_start_date' ,'$product_end_date' , '$date' , '{$value}','{$_POST['good_RefNo'][$key]}')";
    $query1 = mysqli_query($connect, $sql1);

    // echo '<pre> ' . print_r($sql1, 1) . '</pre>';
    //  exit;

    // $sql1111 = "UPDATE  goods_detailproduct
    //  SET product_start_date = '$product_start_date'  , product_end_date = '$product_end_date'  
    //   WHERE  good_id = '{$_POST['good_id'][$key]}' )";  
    // $query1111 = mysqli_query($connect, $sql1111);
    // echo $product_end_date ; 
    //  exit;

    $sql200 = "UPDATE po_detailproduct SET product_start_date = '$product_start_date' , product_end_date = '$product_end_date' WHERE product_id = '{$value}'";
    $res200 = mysqli_query($connect, $sql200);

    $sqll = "SELECT * FROM product_quantity WHERE product_id  = '{$value}' ";
    $queryy = mysqli_query($connect, $sqll);
    $result = mysqli_fetch_assoc($queryy);


    $oldnet =  $result['product_quantity'];
    $newnet = $oldnet + $_POST['product_quantity'][$key];
    $sql9 = "UPDATE product_quantity SET product_quantity = '$newnet'   , good_RefNo = '{$_POST['good_RefNo'][$key]}' WHERE product_id  = '{$value}'";
    $resuu = mysqli_query($connect, $sql9);
    
    echo '<pre>' . print_r($sql9, 1) . '</pre>';
    // exit;
}

// exit;

$sql10 = "UPDATE goods SET good_status = '1' , good_create = '$date' WHERE good_RefNo = '{$_POST['good_RefNo'][$key]}'";
$query10 = mysqli_query($connect, $sql10);

$sql11 = "UPDATE po SET po_status = 'รับสินค้าแล้ว111'  WHERE po_id = '{$value}'";

// $sqlstatus = "UPDATE  po SET po_status = 'รับสินค้าแล้ว'  ";
// $resustatus = mysqli_query($connect, $sqlstatus);

if (mysqli_query($connect, $sql11)) {
    $alert = '<script type="text/javascript">';
    $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
    $alert .= 'window.location.href = "index.php?page=manager_goods_test";';
    $alert .= '</script>';
    echo $alert;
    exit();
} else {
    echo "Error: " . $sqlp . "<br>" . mysqli_error($connect);
}
mysqli_close($con);

?>