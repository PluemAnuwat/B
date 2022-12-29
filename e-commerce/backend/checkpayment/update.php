

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();



    $show_po_id = $_POST['show_po_id'];
    $postatus = 3;    
    $po_update_date = date('Y-m-d H:i:s');
    $po_ip = $_SERVER['REMOTE_ADDR'];

		echo $sqli = "UPDATE akksofttech_purchase_order 
        SET po_status = '".$postatus."', 
        po_update_date = '".$po_update_date."' ,
        po_ip = '".$po_ip."'
		WHERE po_id='".$show_po_id."'"; 	
		$query =mysqli_query($connect,$sqli) or die ("Error ".mysqli_error($connect));
		mysqli_close($connect);
			
			if($query)
				{
					$com = "YES";
				}
				else{
					$com = "NO";
				}
	

		$json=array('in'=>$com ); 
    	$resultArray = array();
    	array_push($resultArray,$json);
    	echo json_encode($resultArray);


	

?>