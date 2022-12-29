<?php

require_once '../includedb/condb.php'; 

        if (!$_POST) {

            exit;

        }else{

        $cus_name	 = !empty($_POST['cus_name'])?$_POST['cus_name']:null;
        $cus_surname = !empty($_POST['cus_surname'])?$_POST['cus_surname']:null;
        $cus_email = !empty($_POST['cus_email'])?$_POST['cus_email']:null;
        $cus_phone = !empty($_POST['cus_phone'])?$_POST['cus_phone']:null;
        $cus_username = !empty($_POST['cus_username'])?$_POST['cus_username']:null;
        $cus_password = !empty($_POST['cus_password'])?$_POST['cus_password']:null;
        $date = date('Y-m-d H:i:s');
      

        $sql_check = "SELECT * FROM `akksofttech_customer` WHERE `cus_username` = '".$cus_username."' AND cus_password = '".$cus_password."'" ; 

        $quey_check = mysqli_query($conn , $sql_check) ;

        $num_check = mysqli_num_rows($quey_check);

        $result_check = mysqli_fetch_array($quey_check);

        if($num_check == 0 ){


            $sql = "INSERT INTO `akksofttech_customer`( `cus_name`, `cus_surname`, `cus_email`, `cus_phone`, `cus_username`, `cus_password`, `cus_start_date`, `cus_id_save`, `cus_name_save` ) 

            VALUES ('".$cus_name."','".$cus_surname."','".$cus_email."','".$cus_phone."','".$cus_username."','".$cus_password."','".$date."','0','AddCustomer')";

            $query = mysqli_query($conn, $sql);
            
            if($query) { 
                    
                $com = "YES";

            }else {

                $com = "NO";
            }


        }else{

            $com = 'NOS';
            
        }

    }
 

			$json=array('status'=> $com  ); 
			$resultArray = array();
			array_push($resultArray,$json);
			echo json_encode($resultArray);
?>