<?php
$con = mysqli_connect("localhost", "root", "akom2006", "dachai");
if (isset($_POST) && !empty($_POST)) {
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

     $sqlpoint = "INSERT INTO reorder (product_id , point) VALUES($new_product_id , $point)";
     $querypoint = mysqli_query($con, $sqlpoint);

}
?>