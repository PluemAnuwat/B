<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>
<?php
// echo '<pre>'.print_r($_REQUEST, 1).'</pre>';
//   echo '<pre>$_GET: '.print_r($_GET, 1).'</pre>';

// echo '<pre>$_POST : ' . print_r($_POST, 1) . '</pre>';

$date = date('Y-m-d H:i:s');
require 'functionthaitoeng.php'; 
// echo '<pre>'.print_r($_POST,2).'</pre>';
// exit;

foreach ($_POST['product_id'] as $key =>  $value) {

    $date = date('Y-m-d');
    
    $product_start_date = thaistart1($_POST['product_start_date'][$key]);
    $product_end_date = thaistart1($_POST['product_end_date'][$key]);
    
       if($product_start_date == '' && $product_end_date == ''){
        $product_start_date = date('Y-m-d',strtotime($date));
        $product_end_date = date('Y-m-d', strtotime(@$now . "+3 years"));
       }

    // if ($product_start_date == '') {
    //     $product_start_date = date('Y-m-d',strtotime($date));
    //     $product_end_date = date('Y-m-d', strtotime(@$now . "+3 years"));
    // } else if($product_start_date != '' & $product_end_date != '') {
    //     $product_start_date = date('Y-m-d' , strtotime($_POST['product_start_date'][$key]));
    //     $product_end_date = date('Y-m-d' , strtotime($_POST['product_end_date'][$key]));
    // }else if($product_start_date != '' & $product_end_date == ''){
    //     $product_start_date = date('Y-m-d' , strtotime($_POST['product_start_date'][$key]));
    //     $product_end_date = date('Y-m-d', strtotime(@$now . "+3 years"));
    // }


    $sql1 = "INSERT INTO product_date (status , product_start_date , product_end_date , product_create_date , product_id , good_RefNo)  
                values('0' , '$product_start_date' ,'$product_end_date' , '$date' , '{$value}','{$_POST['good_RefNo'][$key]}')";
    $query1 = mysqli_query($connect, $sql1);

    // echo '<pre> ' . print_r($sql1, 1) . '</pre>';
    //  exit;

    $sql1111 = "UPDATE  goods_detailproduct  SET product_start_date = '$product_start_date'  , product_end_date = '$product_end_date'  
      WHERE  good_id = '{$value}' )";  
    $query1111 = mysqli_query($connect, $sql1111);

    $sql200 = "UPDATE po_detailproduct SET product_start_date = '$product_start_date' , product_end_date = '$product_end_date' WHERE product_id = '{$value}'";
    $res200 = mysqli_query($connect, $sql200);

    $sqll = "SELECT * FROM product_quantity WHERE product_id  = '{$value}'  ";
    $queryy = mysqli_query($connect, $sqll);
    $result = mysqli_fetch_assoc($queryy);

    $sqll123 = "SELECT * FROM product WHERE product_id  = '{$value}'  ";
    $queryy123 = mysqli_query($connect, $sqll123);
    $result123 = mysqli_fetch_assoc($queryy123);


    $newnet = $_POST['product_quantity'][$key];
    $sql9 = "UPDATE product_quantity SET product_quantity = '$newnet' , status = '0'   , good_RefNo = '{$_POST['good_RefNo'][$key]}' WHERE product_id  = '{$value}' AND po_RefNo = '{$_POST['po_RefNo'][$key]}' ";
    $resuu = mysqli_query($connect, $sql9);
    // print_r($_POST);
    // print_r($sql9);
    // exit;
    
    $oldnet =  $result123['product_quantity'];
    $newnet = $oldnet + $_POST['product_quantity'][$key];
    $sqlproduct = "UPDATE product SET product_quantity = '$newnet'    WHERE product_id  = '{$value}' ";
    $resuproduct = mysqli_query($connect, $sqlproduct);
    
  
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
    
    $sToken = "Uv0soCK4s2VPPiO1s8DpbBYp5mHdqz9Y9p5NUpiPsRZ";

    
    
}




require 'functionDateThai.php'; 

$product_name="";
$product_quantity = "";
$unit_name = "";
$sql1 = "SELECT *   FROM goods INNER JOIN goods_detailproduct ON goods.good_id = goods_detailproduct.good_id 
WHERE good_RefNo = '{$_POST['good_RefNo'][$key]}' ";

$query1 = mysqli_query($connect , $sql1);

while ($row1 = mysqli_fetch_array($query1)) { 

          
     
             $sql2 = "SELECT * , goods_detailproduct.product_quantity AS product_quantity
             FROM goods INNER JOIN goods_detailproduct ON goods.good_id = goods_detailproduct.good_id
             INNER JOIN product  ON goods_detailproduct.product_id = product.product_id
             INNER JOIN unit ON product.product_unit = unit.unit_id
            WHERE goods.good_id = '".$row1['good_id']."'    " ;
            // print_r($sql2);
            $i=1;
                 $query2 = mysqli_query($connect , $sql2);
                 while ($result2 = mysqli_fetch_array($query2)){

                    $product_name =  $product_name.$result2['product_name']."\r"."จำนวน : ".$product_quantity.$result2['product_quantity']. "\r" .$unit_name.$result2['unit_name']."\n" ;  

                    

            }

            
        }

        $sMessage1 = '
<----- รายการสินค้าเข้าสต็อก ----->
วันที่รับสินค้า : '.datethai(date('Y-m-d H:i:s')).'
หมายเลขใบรับสินค้า :'.$_POST['good_RefNo'][$key].'
<====== รายการ ======>   
' .$product_name. "\n
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


$sql10 = "UPDATE goods SET good_status = '1' , good_create = '$date' WHERE good_RefNo = '{$_POST['good_RefNo'][$key]}'";
$query10 = mysqli_query($connect, $sql10);

$sql11 = "UPDATE po SET po_status = 'รับสินค้าแล้ว'  WHERE po_id = '{$value}'";



// header("location:index.php?page=manager_goods_test");


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