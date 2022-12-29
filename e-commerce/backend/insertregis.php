<?PHP 
require_once 'include/condb.php';

@session_start();


if (!$_POST){ exit;}else{
       
	
           
			
			
            $mem_name	 = !empty($_POST['mem_name'])?$_POST['mem_name']:null;
            $mem_surname	 = !empty($_POST['mem_surname'])?$_POST['mem_surname']:null;
            $mem_email	 = !empty($_POST['mem_email'])?$_POST['mem_email']:null;
            $mem_phone	 = !empty($_POST['mem_phone'])?$_POST['mem_phone']:null;
            $mem_username = !empty($_POST['mem_username'])?$_POST['mem_username']:null;
			$mem_password = !empty($_POST['mem_password'])?$_POST['mem_password']:null;
			$mem_date = date('Y-m-d H:i:s');
			$ip = $_SERVER['REMOTE_ADDR'];
			$sql_check = "SELECT * FROM `akksofttech_member` WHERE `mem_username` = '".$mem_username."'  AND `mem_password` = '".$mem_password."' " ; 

			$quey_check = mysqli_query($connect , $sql_check) ;
	
			$num_check = mysqli_num_rows($quey_check);
	
			$result_check = mysqli_fetch_array($quey_check);
			
			
			if($num_check == 0 ){
				

				$sql = "INSERT INTO `akksofttech_member`( `mem_name`, `mem_surname`, `mem_email`, `mem_phone`, `mem_username`, `mem_password`,`mem_date`,`mem_ip`, `mem_id_save`, `mem_name_save`) 
	
				VALUES ('".$mem_name."','".$mem_surname."','".$mem_email."','".$mem_phone."','".$mem_username."','".$mem_password."','".$mem_date."','".$ip."','0','Addmember')";
	
				$query = mysqli_query($connect, $sql);
				
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