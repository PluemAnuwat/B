      <?php session_start() ;

      require_once '../includedb/condb.php';

      $cus_id = $_SESSION['akksofttechsess_cusid'] ;

      $ip = $_SERVER['REMOTE_ADDR'] ;

      $show_address_id = $_POST['show_address_id'] ; 

      $show_sto_id = $_POST['show_sto_id'] ; 
 
      // ค้นหาที่อยู่ที่ดึงมา 

      $sqlro = "select  *   FROM  akksofttech_customer_address  where   cusa_id = '".$show_address_id."' ";

      $result = mysqli_query($conn , $sqlro);

      $rowttto = mysqli_fetch_array($result,MYSQLI_BOTH) ; 



      // ค้นหาตะกร้าว่ามีสินค้าอะไรบ้างแล้วเอามา INSERT

      $s = "SELECT * FROM akksofttech_cart  WHERE cus_id = '".$cus_id."' " ;

      $q = mysqli_query($conn, $s) ;

      $n = mysqli_num_rows($q) ;

      if(!$q){ $coms = 'NOOO' ;

      }else{ 

         $coms = 'YESSS' ;
         
         $ss = " INSERT INTO `akksofttech_purchase_order`(`sto_id` , `po_update_date`,
         .`cus_id` , `po_status`, `tracking`, `transport_name`, `cus_name`, 
         `cus_surname`, `cus_address`, `cus_province`, `cus_zipcode`, 
         `mem_id`, `mem_name`, `po_ip`, `po_start_date`)
         VALUES ( '$show_sto_id' ,  '0' ,   '".$_SESSION['akksofttechsess_cusid']."'   , '1' , '0' ,'0' , '".$rowttto['cusa_name']."' ,
         '".$rowttto['cusa_surname']."' ,'".$rowttto['cusa_address']."' ,'".$rowttto['cusa_province']."' ,'".$rowttto['cusa_zipcode']."'  ,
         '".$_SESSION['akksofttechsess_cusid']."' ,'".$_SESSION['akksofttechsess_name']."' ,'".$ip."' , '".date('Y-m-d H:i:s')."' ) " ;

         $qq = mysqli_query($conn, $ss) ;

         $old_id = mysqli_insert_id($conn) ;

         $comss = "$old_id" ; 
         
         while($data = mysqli_fetch_array($q, MYSQLI_BOTH)){ 
            
         $ss1 = " INSERT INTO `akksofttech_phrchaes_order_detail` (`cart_id`, `po_id`, `pod_create`, `sto_id`,
         `cat_id`, `cat_name`, `scat_id`, `scat_name`, `prod_id`, `prod_name`, `prod_price`, `sprod_id`, `sprod_name`,
         `sprodone_id`, `sprodone_name`, `prod_sku`, `sprod_sku`,
         `sprodone_sku`, `prod_brand`, `prod_image`, `quantity`, `cus_id`, `mem_id`, `mem_name`, `pod_ip`, `pod_start_date`)
         VALUES ( '0' , '".$old_id."' , '".date('Y-m-d H:i:s')."' ,'".$data['sto_id']."' ,
         '".$data['cat_id']."' ,'".$data['cat_name']."' ,'".$data['scat_id']."' ,'".$data['scat_name']."' ,'".$data['prod_id']."' ,'".$data['prod_name']."' ,'".$data['prod_price_simple']."' ,'".$data['sprod_id']."' , '".$data['sprod_name']."' ,
         '".$data['sprodone_id']."' ,'".$data['sprodone_name']."' ,'".$data['prod_sku']."' ,'".$data['sprod_sku']."' ,
         '".$data['sprodone_sku']."' ,  '".$data['prod_brand']."' ,  '".$data['prod_image']."' , '".$data['quantity']."' , '".$data['cus_id']."' ,  '".$_SESSION['akksofttechsess_cusid']."' ,  '".$_SESSION['akksofttechsess_name']."' , '".$ip."' , '".date('Y-m-d H:i:s')."' ) " ;

         $qq1 = mysqli_query($conn, $ss1) ;

         if($qq1){

            $coms = "YES" ; 

         }else{

            $coms = "NO" ; 

         }

      }
    } 

    $json=array('status'=> $coms , 'po_id' => $comss ); 
			$resultArray = array();
			array_push($resultArray,$json);
			echo json_encode($resultArray);

      ?>