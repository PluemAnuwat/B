<?php 
session_start();
	 
	require_once '../includedb/condb.php'; //$dbh  



	$cusa_id = $_POST['cusa_id'];


// check list prod have?

			 $sqll = "SELECT * FROM `akksofttech_customer_address` WHERE  cusa_id = '".$cusa_id."' ";

            $sthes  = mysqli_query($conn , $sqll) ; 

            $sthesnum = mysqli_num_rows($sthes) ; 

            if($sthesnum != 0 ){

                $sql_i = "DELETE FROM akksofttech_customer_address WHERE cusa_id = '".$cusa_id."'";

                $stmtt = mysqli_query($conn , $sql_i) ; 

                if($stmtt){

                    $coms = "YES";

                }else{

                    $coms = "NO";

                }
    

            }else{

                $coms = "NOS";

            }


			$json=array('status'=> $coms ,  'cusa_id'=> $cusa_id ); 
			$resultArray = array();
			array_push($resultArray,$json);
			echo json_encode($resultArray);




?>
