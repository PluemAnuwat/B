<?php
@session_start();

require '../includedb/condb.php' ;

if (!$_POST) {

    exit;

}else{

    $cus_id = $_SESSION['akksofttechsess_cusid'] ; 

    $cus_save_name = $_SESSION['akksofttechsess_name'] ; 

    $cusa_name = $_POST['cusa_name'] ; 

    $cusa_surname = $_POST['cusa_surname'] ; 

    $cusa_address = $_POST['cusa_address'] ; 

    $cusa_note = $_POST['cusa_note'] ; 

    $cusa_phone = $_POST['cusa_phone'] ; 

    $cusa_province = $_POST['cusa_province'] ; 

    $cusa_zipcode = $_POST['cusa_zipcode'] ; 

	$ip = $_SERVER['REMOTE_ADDR'];

    $date = date('Y-m-d H:i:s');

    // print_r($_POST);
  
                         
                                $sql = "INSERT INTO `akksofttech_customer_address`( `cus_id` ,  `cusa_name`,`cusa_surname`, `cusa_address`, `cusa_province`, `cusa_zipcode`, `cusa_note`,  `cusa_phone`, `cusa_ip`, `cusa_start_date`, `cus_id_save`, `cus_name_save`) 

                                        VALUES ('".$cus_id."' , '".$cusa_name."' , '".$cusa_surname."'  , '".$cusa_address."'  , '".$cusa_province."'  , '".$cusa_zipcode."' , '".$cusa_note."' , '".$cusa_phone."' , '".$ip."' , '".$date."' , '".$cus_id."' , '".$cus_save_name."') " ;
                                
                                $query = mysqli_query($conn , $sql) ; 

                                if($query) { 
                    
                                    $com = "YES";
                    
                                }else {
                    
                                    $com = "NO";
                                }
                    
                                
			$json=array('status'=> $com  ); 
			$resultArray = array();
			array_push($resultArray,$json);
			echo json_encode($resultArray);


}