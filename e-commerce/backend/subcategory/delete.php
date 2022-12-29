<?php
    @session_start();
	require_once '../include/condb.php';

			
						$sql = "DELETE FROM akksofttech_subcategory  WHERE scate_id = '".$_POST['id']."'";
						$query = mysqli_query($connect,$sql);
						// exit();
						              
						if($query){
							$com = "YES";
							}
							else{
							$com = "NO";
							}
                
            			$json=array('com'=>$com  ); 
            			$resultArray = array();
                       	array_push($resultArray,$json);
                       	echo json_encode($resultArray);

?>