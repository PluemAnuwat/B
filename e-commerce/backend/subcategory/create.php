

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();

// `scate_id``scate_name``cat_id``cat_name``sto_id``mem_id``mem_name``scat_ip``scat_start_date`
$noimage = $_POST['logo_img64'];

$scate_id = $_POST['scate_id'];
$scate_name = $_POST['scate_name'];
$catgroup	= $_POST['cat_group'];
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$stoid = $_SESSION['akksofttechsess_stoid'];
$ip = $_SERVER['REMOTE_ADDR'];
$scat_start_date = date('Y-m-d H:i:s');

$cat = "SELECT cat_name FROM akksofttech_category WHERE cat_id = '".$catgroup."'" ;
$qcat = mysqli_query($connect , $cat);
$rqcat = mysqli_fetch_array($qcat);
$cat_name = $rqcat['cat_name'];

$sqllgoods = "SELECT * FROM `akksofttech_subcategory` WHERE `scate_id`  =  '".$scate_id."' ";					 
$resultgoods = mysqli_query($connect,$sqllgoods);
$dataggoods = mysqli_fetch_array($resultgoods,MYSQLI_BOTH);
$imgname = $dataggoods['scate_img'];
if(trim($_FILES["filescate_picture"]["name"]) != "")
		{     
	
			$imgname = 'naropos_'.date("YmdHis").'.png';
			define('UPLOAD_DIR', 'images/');
			$image_parts = explode(";base64,", $noimage);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			file_put_contents('../getimg/scate/'.$imgname , $image_base64);
			
		}
	
	if($scate_id != 0){
		// `scate_id``scate_name``cat_id``cat_name``sto_id``mem_id`
		// `mem_name``scat_ip``scat_start_date``scate_img`
		$sqli = "UPDATE akksofttech_subcategory 
        SET scate_name = '".$scate_name."', scate_img = '".$imgname."',
		 cat_id = '".$catgroup."', cat_name = '".$cat_name."',
		 scat_ip = '".$ip."',
		 scat_start_date = '".$scat_start_date."'
        WHERE scate_id='".$scate_id."'";
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

		// `scate_id``scate_name``cat_id``cat_name``sto_id``mem_id`
		// `mem_name``scat_ip``scat_start_date``scate_img`
		$sql = "INSERT into akksofttech_subcategory  (scate_name, cat_id, cat_name, sto_id, 
		mem_id , mem_name, scat_ip, scat_start_date, scate_img)
		VALUES('".$scate_name."',  '".$catgroup."', '".$cat_name."', '".$stoid."', '".$memid."' , '".$memname."' , '".$ip."' , '".$scat_start_date."' , '".$imgname."')";
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