<?php 

session_start() ; 

require_once '../includedb/condb.php';  

$cus_id = $_SESSION['akksofttechsess_cusid'] ; 

$cart_select_id = $_POST['cart_select_id'] ; 

 $s = "SELECT * FROM akksofttech_cart  WHERE cus_id = '".$cus_id."' AND cart_id = '".$cart_select_id."' " ; 

 $q = mysqli_query($conn , $s ) ; 

 $n = mysqli_num_rows($q)  ;

    if(!$q){

        $coms = 'NOOO' ; 

    }else{

 while($data =  mysqli_fetch_array($q,MYSQLI_BOTH)){


   echo $data['prod_name'] ; 

    $coms = 'YESSS' ;

   echo  $ss = " INSERT INTO  `akksofttech_purchase_order`(`po_update_date`, `po_status`, `tracking`, 
    `transport_name`, `cus_name`, `cus_surname`, `cus_address`, `cus_province`, `cus_zipcode`, `mem_id`, 
    `mem_name`, `po_ip`, `po_start_date`) VALUES('".$data['po_update_date']."') " ; 

    $qq = mysqli_query($conn , $ss )  ;



 } 

 



    }


//  $reslutArray = array();

//  while($data = mysqli_fetch_array($q,MYSQLI_BOTH))	{

//     $arrayBill = array( 

//                         "pod_create" => $data['pod_create'] ,

//                         "sto_id" => $data['sto_id'] ,

//                         "cat_id" => $data['cat_id'] ,

//                         "cat_name" => $data['cat_name'] ,

//                         "scat_id" => $data['scat_id'] ,

//                         "scat_name" => $data['scat_name'] ,

//                         "prod_id" => $data['prod_id'] ,

//                         "prod_name" => $data['prod_name'] ,

//                         "prod_price_simple" => $data['prod_price_simple'] ,

//                         "sprod_id" => $data['sprod_id'] ,

//                         "sprod_name" => $data['sprod_name'] ,

//                         "sprodone_id" => $data['sprodone_id'] ,

//                         "sprodone_name" => $data['sprodone_name'] ,

//                         "prod_sku" => $data['prod_sku'] ,

//                         "sprod_sku" => $data['sprod_sku'] ,

//                         "sprodone_sku" => $data['sprodone_sku'] ,

//                         "prod_brand" => $data['prod_brand'] ,
           
//                         "prod_image" => $data['prod_image'] ,

//                         "quantity" => $data['quantity'] ,

//                         "cus_id" => $data['cus_id'] 

//                     );

//     array_push($reslutArray , $arrayBill);
// }										

// echo json_encode($reslutArray);



?>