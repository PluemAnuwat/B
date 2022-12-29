<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  


        $cus_id  =   $_POST['cus_id'] ; 

        if(!$cus_id){

            $coms = "NO" ; 

        }else{

            $coms = "YES" ; 
        
        }

               									
                
	$json=array('status'=> $coms ); 

	$resultArray = array();

	array_push($resultArray,$json);

	echo json_encode($resultArray);


?>




<?php
	
	@session_start();
	
	//var_dump($_SESSION['sid']);exit;
	
	if(empty($_SESSION['akksofttechsess_cusid'])      ) {
		// echo "ไม่อนุญาติให้เข้าสู่ระบบ";
		// echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=login.php'>";
        $coms="NO" ; 

	}
    else{
        $coms="YES" ;
    }
    
    
    $json=array('status'=> $coms ); 


	$resultArray = array();

	array_push($resultArray,$json);

	echo json_encode($resultArray);
	
?>

