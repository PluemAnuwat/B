<?php 

session_start();

require_once '../includedb/condb.php'; 

$prod_id = $_POST['prod_id'];  //รหัสสินค้า

$show_sub_prod_id = $_POST['show_sub_prod_id']; //รหัสสินค้าย่อย

$show_sub_prodone_id = $_POST['show_sub_prodone_id']; //รหัสสินค้าย่อย 1 

$show_quantity = $_POST['show_quantity'];  //จำนวน
       
$show_sto_id = $_POST['show_sto_id']; //รหัสร้านค้า

$ip = $_SERVER['REMOTE_ADDR'] ; // ไอพี

$cus_id = $_SESSION['akksofttechsess_cusid'] ;  //รหัสผู้ซื้อ

$cus_name = $_SESSION['akksofttechsess_name'] ;  //ชื่อผู้ซื้อ


$sql = "SELECT * FROM akksofttech_cart WHERE cus_id = '".$cus_id."'" ; 

$query = mysqli_query($conn , $sql) ;

$result = mysqli_fetch_array($query) ; 

$num = mysqli_num_rows($query) ; 

if(!$num){

    $coms = "NOS" ; 

}else{

    // remove 

    $delete = "DELETE FROM `akksofttech_cart` WHERE cus_id =  '".$cus_id."'" ; 

    $query_de = mysqli_query($conn , $delete) ;

    if(!$query_de){

        $coms = "NOD" ; 

    }else{

        $coms = "YESD" ; 

         $see = "SELECT  akksofttech_category.cat_name AS cat_name , akksofttech_category.cat_id AS cat_id ,
        akksofttech_subproduct.sprod_id AS  sprod_id, akksofttech_subproduct.sprod_name AS sprod_name , akksofttech_subproduct.sprod_price AS sprod_price  , 
        akksofttech_subproduct_one.sprodone_id AS  sprodone_id, akksofttech_subproduct_one.sprodone_name AS sprodone_name , akksofttech_subproduct_one.sprodone_price AS sprodone_price  , 
        akksofttech_subcategory.scate_id AS scate_id , akksofttech_subcategory.scate_name AS scate_name ,    akksofttech_subproduct.sprod_image AS  sprod_image ,    akksofttech_subproduct_one.sprodone_image AS  sprodone_image , 
        akksofttech_product.prod_id AS prod_id , akksofttech_product.prod_name AS prod_name , akksofttech_product.prod_brand AS prod_brand , 
        akksofttech_product.prod_sku AS prod_sku , akksofttech_product.mem_id AS mem_id , akksofttech_product.mem_name AS mem_name , 
        akksofttech_subproduct.sprod_sku AS sprod_sku ,   akksofttech_subproduct_one.sprodone_sku AS sprodone_sku , akksofttech_subcategory.scate_id AS scate_id , akksofttech_subcategory.scate_name AS scate_name  
        FROM akksofttech_category 
        INNER JOIN akksofttech_product ON  akksofttech_category.cat_id = akksofttech_product.cat_id 
        INNER JOIN akksofttech_subproduct ON akksofttech_product.prod_id = akksofttech_subproduct.prod_id
        INNER JOIN akksofttech_subcategory ON akksofttech_category.cat_id = akksofttech_subcategory.cat_id
        INNER JOIN akksofttech_subproduct_one ON akksofttech_product.prod_id = akksofttech_subproduct_one.prod_id
        WHERE akksofttech_product.prod_id = '".$prod_id."' AND akksofttech_product.sto_id = '".$show_sto_id."' AND akksofttech_subproduct.sprod_id = '".$show_sub_prod_id."'  "; 
        $ree = mysqli_query($conn , $see);
        $qee = mysqli_fetch_array($ree);


        $suu = "INSERT INTO `akksofttech_cart` (`po_id`,  `pod_create` , `sto_id` , `cat_id` , `cat_name` , `scat_id`  , `scat_name` , `prod_id` ,
        `prod_name` , `prod_price_simple` , `sprod_id` , `sprod_name`, `sprodone_id`, `sprodone_name` , `prod_sku`, `sprod_sku`, `sprodone_sku` ,
        `prod_brand`, `prod_image`, `quantity` , `cus_id`, `mem_id`,   `mem_name`, `pod_ip`, `pod_start_date` ) 
        VALUES ( '0' , '".$date."' , '".$show_sto_id."' , '".$qee['cat_id']."' , '".$qee['cat_name']."' , '".$qee['scate_id']."' ,  '".$qee['scate_name']."' ,
        '".$qee['prod_id']."'  ,   '".$qee['prod_name']."' ,  '".$qee['sprod_price']."' ,  '".$qee['sprod_id']."' , 
        '".$qee['sprod_name']."' , '".$qee['sprodone_id']."' , '".$qee['sprodone_name']."' , '".$qee['prod_sku']."' ,  '".$qee['sprod_sku']."' ,  '".$qee['sprodone_sku']."'  ,
        '".$qee['prod_brand']."' ,  '".$qee['sprod_image']."' ,  '".$show_quantity."'  , '".$cus_id."' , '".$qee['mem_id']."' , '".$qee['mem_name']."' , '".$ip."' , '".date('Y-m-d H:i:s')."'  )" ; 
        $ruu = mysqli_query($conn ,$suu);

        if($ruu){

            $coms = 'YESINSERT';

        }else{

            $coms = 'NOINSERT';
            
        }

    }

}


$json=array('status'=> $coms ); 

$resultArray = array();

array_push($resultArray,$json);

echo json_encode($resultArray);

?>