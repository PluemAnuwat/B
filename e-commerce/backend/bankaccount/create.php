

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();



		// `bac_id``sto_id``bac_number_mem`
// `bac_mem_name``bac_name``bak_id`
// `bak_name``mem_id``mem_name``bac_ip`
// `bac_start_date`
$noimage = $_POST['logo_img64'];
$bac_id = $_POST['bac_id'];
$bac_number_mem = $_POST['bac_number_mem'];
$bac_mem_name = $_POST['bac_mem_name'];
$bac_name = $_POST['bac_name'];
$bakgroup	= $_POST['bak_group'];
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$stoid = $_SESSION['akksofttechsess_stoid'];
$ip = $_SERVER['REMOTE_ADDR'];
$bac_start_date = date('Y-m-d H:i:s');

$bakname = "SELECT bak_name FROM akksofttech_bank WHERE bak_id = '".$bakgroup."'" ;
$qbak = mysqli_query($connect , $bakname);
$rqbak = mysqli_fetch_array($qbak);
$bak_name = $rqbak['bak_name'];


	
	if($bac_id != ""){
		
		$sqli = "UPDATE akksofttech_bank_account 
        SET bac_number_mem = '".$bac_number_mem."', 
         bac_mem_name = '".$bac_mem_name."', 
         bac_name = '".$bac_name."',
         bak_id = '".$bakgroup."', 
         bak_name = '".$bak_name."',
		 bac_ip = '".$ip."',
		 bac_start_date = '".$bac_start_date."'
        WHERE bac_id='".$bac_id."'";
		$query =mysqli_query($connect,$sqli) or die ("Error ".mysqli_error($connect));
		mysqli_close($connect);
			
			
			
			if($query)
				{
					$com = "YES";
				}
				else{
					$com = "NO";
				}
			
	}else{

		$sql = "INSERT into akksofttech_bank_account  (sto_id, bac_number_mem, bac_mem_name, 
        bac_name, bak_id,bak_name, mem_id , mem_name, bac_ip, bac_start_date)
		VALUES('".$stoid."',  
        '".$bac_number_mem."', 
        '".$bac_mem_name."', 
        '".$bac_name."',
        '".$bakgroup."',
        '".$bak_name."', 
        '".$memid."' , 
        '".$memname."' , 
        '".$ip."' ,
         '".$bac_start_date."')";
		$query =mysqli_query($connect,$sql) or die ("Error ".mysqli_error($connect));
	    mysqli_close($connect);	
		
		if($query){
		$com = "YES";
		}
		else{
		$com = "NO";
		}
		
	
	
	
	}
		

		$json=array('in'=>$com ); 
    	$resultArray = array();
    	array_push($resultArray,$json);
    	echo json_encode($resultArray);


	

?>