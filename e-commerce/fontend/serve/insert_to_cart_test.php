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

        
    $ss = "SELECT * FROM `akksofttech_cart` WHERE  `prod_id` = '".$prod_id."' AND  cus_id  = '".$cus_id."' "  ;  
    $qq = mysqli_query ($conn , $ss) ;
    $rr = mysqli_fetch_array($qq) ; 
    $nn = mysqli_num_rows($qq) ; 

    if(empty($cus_id) ) { //เช็คลอคอิน
        $coms = "NOLOGIN" ; 	 
    }else{
        $s =  "SELECT * FROM akksofttech_subproduct  WHERE  prod_id = '".$prod_id."'"  ;   $q = mysqli_query ($conn , $s ) ;  $n = mysqli_num_rows($q) ;  //เช็คมีย่อยไหม
        if($n > 0 ) { 
            if($show_sub_prod_id == 0 ){  //เช็คว่าเลือกยัง
                $coms = "NOS" ; 
            } else { 
                $coms = "YESS" ;
                $s1 =  "SELECT * FROM akksofttech_subproduct_one  WHERE  prod_id = '".$prod_id."' AND sprod_id = '".$show_sub_prod_id."'" ;  ;   $q1 = mysqli_query ($conn , $s1 ) ;  $n1 = mysqli_num_rows($q1) ;  
                if($n1 > 0 ){ //เช็คว่ามีย่อย 1 ไหม
                    if($show_sub_prodone_id == 0 ){ //เช็คมีเลือกยัง
                        $coms = "NOS1" ; 
                    }else{
                        $coms = "YESSS1" ;
                        $see1 = "SELECT  akksofttech_category.cat_name AS cat_name , akksofttech_category.cat_id AS cat_id ,
                        akksofttech_subproduct.sprod_id AS  sprod_id, akksofttech_subproduct.sprod_name AS sprod_name ,
                        akksofttech_subcategory.scate_id AS scate_id , akksofttech_subcategory.scate_name AS scate_name , 
                        akksofttech_product.prod_id AS prod_id , akksofttech_product.prod_name AS prod_name , akksofttech_product.prod_brand AS prod_brand , 
                        akksofttech_product.prod_sku AS prod_sku , akksofttech_product.mem_id AS mem_id , akksofttech_product.mem_name AS mem_name , 
                        akksofttech_subproduct.sprod_sku AS sprod_sku , akksofttech_subcategory.scate_id AS scate_id , akksofttech_subcategory.scate_name AS scate_name  ,
                        akksofttech_subproduct_one.sprodone_id AS sprodone_id ,  akksofttech_subproduct_one.sprodone_name AS sprodone_name ,  akksofttech_subproduct_one.sprodone_sku AS sprodone_sku ,  akksofttech_subproduct_one.sprodone_price AS sprodone_price , akksofttech_subproduct_one.sprodone_image AS sprodone_image
                        FROM akksofttech_category 
                        INNER JOIN akksofttech_subcategory ON akksofttech_category.cat_id = akksofttech_subcategory.cat_id
                        INNER JOIN akksofttech_product ON  akksofttech_subcategory.scate_id = akksofttech_product.scate_id 
                        INNER JOIN akksofttech_subproduct ON akksofttech_product.prod_id = akksofttech_subproduct.prod_id
                        INNER JOIN akksofttech_subproduct_one ON akksofttech_subproduct.sprod_id = akksofttech_subproduct_one.sprod_id
                        WHERE akksofttech_product.prod_id = '".$prod_id."' AND akksofttech_product.sto_id = '".$show_sto_id."' AND akksofttech_subproduct.sprod_id = '".$show_sub_prod_id."' AND akksofttech_subproduct_one.sprodone_id = '".$show_sub_prodone_id."'  "; 
                        $ree1 = mysqli_query($conn , $see1);
                        $qee1 = mysqli_fetch_array($ree1);

                    
                        if($nn > 0 ){ //เช็คสินค้านี้มีในตะกร้ายัง
                                if($show_sto_id == $rr['sto_id']){ //เช็คว่าร้านเดียวกันไหม
                                    $coms = 'YESSTO' ; 
                                    echo $see1 = "UPDATE `akksofttech_cart` SET  `quantity` = `quantity` + $show_quantity  WHERE  `prod_id` = '".$prod_id."' AND sprod_id = '".$show_sub_prod_id."' AND sprodone_id = '".$show_sub_prodone_id."'   ";
                                    $ree1 = mysqli_query($conn ,$see1);
                                    if($ree1){
                                        $coms = 'YESUP2';
                                    }else{
                                        $coms = 'NOUP2';
                                    }    
                                }else{
                                    $coms = 'NOSTO' ; 
                                }     
                        }else{
                            if($show_sto_id == $rr['sto_id']){ //เช็คว่าร้านเดียวกันไหม
                                $coms = 'YESSTO' ; 
                                $seee1 = "INSERT INTO `akksofttech_cart` (`po_id`,  `pod_create` , `sto_id` , `cat_id` , `cat_name` , `scat_id`  , `scat_name` , `prod_id` ,
                                `prod_name` , `prod_price_simple` , `sprod_id` , `sprod_name`, `sprodone_id`, `sprodone_name` , `prod_sku`, `sprod_sku`, `sprodone_sku` ,
                                `prod_brand`, `prod_image`, `quantity` , `cus_id`, `mem_id`,   `mem_name`, `pod_ip`, `pod_start_date` ) 
                                VALUES ( '0' , '".$date."' , '".$show_sto_id."' , '".$qee1['cat_id']."' , '".$qee1['cat_name']."' , '".$qee1['scate_id']."' ,  '".$qee1['scate_name']."' ,
                                '".$qee1['prod_id']."'  ,   '".$qee1['prod_name']."' ,  '".$qee1['sprodone_price']."' ,  '".$qee1['sprod_id']."' , 
                                '".$qee1['sprod_name']."' , '".$qee1['sprodone_id']."' ,  '".$qee1['sprodone_name']."' , '".$qee1['prod_sku']."' ,  '".$qee1['sprod_sku']."' ,  '".$qee1['sprodone_sku']."' ,
                                '".$qee1['prod_brand']."' ,  '".$qee1['sprodone_image']."' ,  '".$show_quantity."'  , '".$cus_id."' , '".$qee1['mem_id']."' , '".$qee1['mem_name']."' , '".$ip."' , '".date('Y-m-d H:i:s')."'  )" ; 
                                $reee1 = mysqli_query($conn ,$seee1);
                                if($reee1){
                                    $coms = 'YESIN2';
                                }else{
                                    $coms = 'NOIN2';
                                }  
                            }else{
                                $coms = 'NOSTO' ; 
                            }       
                        }
                    }
                }else{
                    $see = "SELECT  akksofttech_category.cat_name AS cat_name , akksofttech_category.cat_id AS cat_id ,
                    akksofttech_subproduct.sprod_id AS  sprod_id, akksofttech_subproduct.sprod_name AS sprod_name , akksofttech_subproduct.sprod_price AS sprod_price  , 
                    akksofttech_subcategory.scate_id AS scate_id , akksofttech_subcategory.scate_name AS scate_name ,    akksofttech_subproduct.sprod_image AS  sprod_image , 
                    akksofttech_product.prod_id AS prod_id , akksofttech_product.prod_name AS prod_name , akksofttech_product.prod_brand AS prod_brand , 
                    akksofttech_product.prod_sku AS prod_sku , akksofttech_product.mem_id AS mem_id , akksofttech_product.mem_name AS mem_name , 
                    akksofttech_subproduct.sprod_sku AS sprod_sku , akksofttech_subcategory.scate_id AS scate_id , akksofttech_subcategory.scate_name AS scate_name  
                    FROM akksofttech_category 
                    INNER JOIN akksofttech_product ON  akksofttech_category.cat_id = akksofttech_product.cat_id 
                    INNER JOIN akksofttech_subproduct ON akksofttech_product.prod_id = akksofttech_subproduct.prod_id
                    INNER JOIN akksofttech_subcategory ON akksofttech_category.cat_id = akksofttech_subcategory.cat_id
                    WHERE akksofttech_product.prod_id = '".$prod_id."' AND akksofttech_product.sto_id = '".$show_sto_id."' AND akksofttech_subproduct.sprod_id = '".$show_sub_prod_id."'  "; 
                    $ree = mysqli_query($conn , $see);
                    $qee = mysqli_fetch_array($ree);
                    if($nn > 0 ){ //เช็คสินค้านี้มีในตะกร้ายัง
                        if($show_sto_id == $rr['sto_id']){ //เช็คว่าร้านเดียวกันไหม
                            $coms = 'YESSTO' ; 
                        $suu = "UPDATE `akksofttech_cart` SET  `quantity` = `quantity` + $show_quantity  WHERE  `prod_id` = '".$prod_id."' AND sprod_id = '".$show_sub_prod_id."'     ";
                        $ruu = mysqli_query($conn ,$suu);
                        if($ruu){
                            $coms = 'YESUP1';
                        }else{
                            $coms = 'NOUP1';
                        }
                    }else{
                        $coms = 'NOSTO' ; 
                    }
                    }else{
                        if($show_sto_id == $rr['sto_id']){ //เช็คว่าร้านเดียวกันไหม
                            $coms = 'YESSTO' ; 
                            $suu = "INSERT INTO `akksofttech_cart` (`po_id`,  `pod_create` , `sto_id` , `cat_id` , `cat_name` , `scat_id`  , `scat_name` , `prod_id` ,
                            `prod_name` , `prod_price_simple` , `sprod_id` , `sprod_name`, `sprodone_id`, `sprodone_name` , `prod_sku`, `sprod_sku`, `sprodone_sku` ,
                            `prod_brand`, `prod_image`, `quantity` , `cus_id`, `mem_id`,   `mem_name`, `pod_ip`, `pod_start_date` ) 
                            VALUES ( '0' , '".$date."' , '".$show_sto_id."' , '".$qee['cat_id']."' , '".$qee['cat_name']."' , '".$qee['scate_id']."' ,  '".$qee['scate_name']."' ,
                            '".$qee['prod_id']."'  ,   '".$qee['prod_name']."' ,  '".$qee['sprod_price']."' ,  '".$qee['sprod_id']."' , 
                            '".$qee['sprod_name']."' ,  '0' ,  '0' , '".$qee['prod_sku']."' ,  '".$qee['sprod_sku']."' ,  '0' ,
                            '".$qee['prod_brand']."' ,  '".$qee['sprod_image']."' ,  '".$show_quantity."'  , '".$cus_id."' , '".$qee['mem_id']."' , '".$qee['mem_name']."' , '".$ip."' , '".date('Y-m-d H:i:s')."'  )" ; 
                            $ruu = mysqli_query($conn ,$suu);
                            if($ruu){
                                $coms = 'YESIN1';
                            }else{
                                $coms = 'NOIN1';
                            }
                        }else{
                            $coms = 'NOSTO' ; 
                        }
                    }
                }
            } 
        }else{
            $se = "SELECT akksofttech_category.cat_name AS cat_name , akksofttech_category.cat_id AS cat_id ,
            akksofttech_product.prod_id AS prod_id , akksofttech_product.prod_name AS prod_name , akksofttech_product.prod_brand AS prod_brand ,
            akksofttech_product.prod_image AS prod_image , akksofttech_product.prod_sku AS prod_sku , akksofttech_product.mem_id AS mem_id , 
            akksofttech_product.mem_name AS mem_name , akksofttech_product.prod_price AS prod_price
            FROM akksofttech_category 
            INNER JOIN akksofttech_product ON  akksofttech_category.cat_id = akksofttech_product.cat_id 
            WHERE akksofttech_product.prod_id = '".$prod_id."' AND akksofttech_product.sto_id = '".$show_sto_id."' ";
            $qe = mysqli_query($conn , $se);
            $re = mysqli_fetch_array($qe);  
            if($nn > 0 ){ //เช็คสินค้านี้มีในตะกร้ายัง
                if($show_sto_id == $rr['sto_id']){ //เช็คว่าร้านเดียวกันไหม
                    $coms = 'YESSTO' ; 
                    $sqlup = "UPDATE `akksofttech_cart` SET  `quantity` = `quantity` + $show_quantity  WHERE  `prod_id` = '".$prod_id."   '   ";
                    $resup = mysqli_query($conn ,$sqlup);
                    if($resup){
                        $coms = 'YESUP';
                    }else{
                        $coms = 'NOUP';
                    }
                }else{
                    $coms = 'NOSTO' ; 
                }
            }else{
                if($show_sto_id == $rr['sto_id']){ //เช็คว่าร้านเดียวกันไหม
                    $coms = 'YESSTO' ; 
                    $date = date('Y-m-d H:i:s') ; 
                    $sqlin = "INSERT INTO `akksofttech_cart` (`po_id`,  `pod_create` , `sto_id` , 
                    `cat_id` , `cat_name` , `scat_id`  , `scat_name` , `prod_id` ,
                    `prod_name` , `prod_price_simple` , `sprod_id` , `sprod_name`,
                    `sprodone_id`, `sprodone_name` , `prod_sku`, `sprod_sku`, `sprodone_sku` ,
                    `prod_brand`, `prod_image`, `quantity` , `cus_id`, `mem_id`, 
                    `mem_name`, `pod_ip`, `pod_start_date` ) 
                    VALUES ( '0' , '".$date."' , '".$show_sto_id."' ,
                    '".$re['cat_id']."' , '".$re['cat_name']."' , '0' ,  '0' ,'".$re['prod_id']."'  ,
                    '".$re['prod_name']."' ,  '".$re['prod_price']."' ,  '.0.' , '0' ,
                    '0' ,  '0' , '".$re['prod_sku']."' ,  '0' ,  '0' ,
                    '".$re['prod_brand']."' ,  '".$re['prod_image']."' ,  '".$show_quantity."'  , '".$cus_id."' , '".$re['mem_id']."' ,
                    '".$re['mem_name']."' , '".$ip."' , '".date('Y-m-d H:i:s')."' )" ;  
                    $resin = mysqli_query($conn ,$sqlin);
                    if($resin){
                        $coms = 'YESIN';
                    }else{
                        $coms = 'NOIN';
                    }
                }else{
                    $coms = 'NOSTO' ; 
                }
            }
        }

    }

    $json=array('status'=> $coms ); 

	$resultArray = array();

	array_push($resultArray,$json);

	echo json_encode($resultArray);
    

?>
