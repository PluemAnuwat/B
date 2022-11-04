<?php
$con = mysqli_connect("localhost", "root", "akom2006", "project");
require '../functionDateThai.php' ;
if (isset($_POST) && !empty($_POST)){
     $product_name = $_POST['product_name'];
     $product_type = $_POST['product_type'];
     $product_category = $_POST['product_category'];
     $product_symp = $_POST['product_symp'];
     $product_unit = $_POST['product_unit'];
     $product_barcode = $_POST['product_barcode'];
     $point = $_POST['point'];

     if (isset($_FILES['product_img']['name']) && !empty($_FILES['product_img']['name'])) {
          $extension = array("jpeg", "jpg", "png");
          $target = './image/';
          $filename = $_FILES['product_img']['name'];
          $filetmp = $_FILES['product_img']['tmp_name'];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          if (in_array($ext, $extension)) {
               if (!file_exists($target . $filename)) {
                    if (move_uploaded_file($filetmp, $target . $filename)) {
                         $filename = $filename;
                    } else {
                         echo 'เพิ่มไม่สำเร็จ';
                    }
               } else {
                    $newfilename = time() . $filename;
                    if (move_uploaded_file($filetmp, $target . $newfilename)) {
                         $filename = $newfilename;
                    } else {
                         echo 'เพิ่มเข้าไม่ได้';
                    }
               }
          } else {
               echo 'ประเภทไม่ถูกต้อง';
          }
     } else {
          $filename = '';
     }
     $sqlp = "INSERT INTO product (product_img  ,product_symp,product_category,product_type,product_name,product_unit,product_barcode) 
     VALUES ('$filename'  ,'$product_symp','$product_category','$product_type','$product_name','$product_unit','$product_barcode')";
     $queryp = mysqli_query($con, $sqlp);

     $new_product_id = mysqli_insert_id($con);
     $product_quantity = 0;


     $sqlpp = "INSERT INTO product_quantity (product_quantity ,  product_id ) VALUE ('$product_quantity' , '$new_product_id')";
     $querypp = mysqli_query($con, $sqlpp);

     $product_price_cost =  $_POST['product_price_cost'];
     $product_price_sell = 0;

     $sqlppp = "INSERT INTO product_price ( product_price_cost ,  product_id , product_price_sell) VALUES ( '$product_price_cost' , '$new_product_id' , '$product_price_sell')";
     $queryppp = mysqli_query($con, $sqlppp);

     $sqlpoint = "INSERT INTO product_reorder (product_id , point) VALUES($new_product_id , $point)";
    

     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
     date_default_timezone_set("Asia/Bangkok");
     $sToken = "Uv0soCK4s2VPPiO1s8DpbBYp5mHdqz9Y9p5NUpiPsRZ";
 $sql1 = "SELECT *   FROM product AS a 
WHERE a.product_id = '".$new_product_id."' ";


 $query1 = mysqli_query($con , $sql1);
 $result1 = mysqli_fetch_array($query1);
$sMessage1 = "
<===== รายการเพิ่มข้อมูลสินค้า =====>
วันที่เพิ่มข้อมูล : ".datethai(date('Y-m-d H:i:s'))."
ชื่อสินค้า : ".$result1['product_name']."
ราคาต้นทุน :". $product_price_cost."  
กำหนดจุดสั่งซื้อ :". $point."             
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
     { echo 'error:' . curl_error($chOne); } 
     else { $result_ = json_decode($result, true); echo "status : ".$result_['status']; echo "message : ". $result_['message']; } 
     curl_close( $chOne );   

     if (mysqli_query($con, $sqlpoint)) {
          $alert = '<script type="text/javascript">';
          $alert .= 'alert("เพิ่มข้อมูลสำเร็จ !!");';
          $alert .= 'window.location.href = "?page=product";';
          $alert .= '</script>';
          echo $alert;
          exit();
     } else {
          echo "Error: " . $sqlp . "<br>" . mysqli_error($con);
     }
     mysqli_close($con);

}
?>