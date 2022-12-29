<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();




$po_id = $_POST['po_id'];
$ttype	= $_POST['ttype'];
$del_update_date = $_POST['del_update_date'];
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$ip = $_SERVER['REMOTE_ADDR'];
$del_start_date = date('Y-m-d H:i:s');
$tracking = $_POST['tracking'];
$postatus = 4;   
 $tsp = "SELECT tran_type_name FROM akksofttech_transport WHERE tran_type_id = '".$ttype."'" ;
$qtsp = mysqli_query($connect , $tsp);
$rqtsp = mysqli_fetch_array($qtsp);
$tran_type_name = $rqtsp['tran_type_name'];

// SELECT * FROM `akksofttech_delivery`
// `del_id``po_id``del_status``del_status_log``del_update_date`
// `tran_type_id``tran_type_name`
// `mem_id``mem_name``del_ip``del_start_date`
		
	 $sql = "INSERT into akksofttech_delivery (po_id,del_status,del_update_date,tran_type_id,
        tran_type_name,mem_id,mem_name,del_ip,del_start_date)
		VALUES('".$po_id."',  
        '1', 
        '".$del_update_date."', 
        '".$ttype."', 
        '".$tran_type_name."' , 
        '".$memid."' , 
        '".$memname."' , 
        '".$ip."' , 
        '".$del_start_date."')";
		$query =mysqli_query($connect,$sql) or die ("Error ".mysqli_error($connect));
	    
		
	if($query){

		$com = "YESSHIP";
		
		 $updatepoid = "UPDATE akksofttech_purchase_order SET 
		po_status = '".$postatus."' , 
		
		tracking  = '".$tracking."' ,  
		
		tran_type_name =  '".$tran_type_name."' 
		
		WHERE po_id = '".$po_id."' " ; 
		
		$qpoid = mysqli_query($connect, $updatepoid);
	
		
		if($qpoid) { 

			$com = "YES";

		}else{

			$com = "NO";

		}
	
	}else{
		$com = "NOSHIP";
		}
		
	
	
	

		

		$json=array('status'=> $com  ); 
		$resultArray = array();
		array_push($resultArray,$json);
		echo json_encode($resultArray);


	

?>