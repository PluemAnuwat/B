<?php session_start();



	require_once 'include/condb.php'; //$dbh  

	
?>      


<?php

			
			$sqll = "SELECT po_id FROM `akksofttech_purchase_order` WHERE  sto_id = '".$_SESSION['akksofttechsess_stoid']."' " ;		
			$result = mysqli_query($connect,$sqll);
			$rownum = mysqli_num_rows($result);

			if($result) {  
			
				$coms = "YES";
				$num = $rownum;
			}else {
		
				$coms = "NO";
				$num = $rownum;

			}

			$json=array('status'=> $coms  , 'num'=> $num  ); 
			$resultArray = array();
			array_push($resultArray,$json);
			echo json_encode($resultArray);



?>