

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();


$noimage = $_POST['logo_img64'];
$cat_id = $_POST['cat_id'];
$cat_name = $_POST['cat_name'];
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$stoid = $_SESSION['akksofttechsess_stoid'];	
$cat_start_date = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

$sqllgoods = "SELECT * FROM `akksofttech_category` WHERE `cat_id`  =  '".$cat_id."' ";					 
$resultgoods = mysqli_query($connect,$sqllgoods);
$dataggoods = mysqli_fetch_array($resultgoods,MYSQLI_BOTH);
		
		$imgname = $dataggoods['cat_img'];
if(trim($_FILES["filecat_picture"]["name"]) != "")
		{     
	
			$imgname = 'naropos_'.date("YmdHis").'.png';
			define('UPLOAD_DIR', 'images/');
			$image_parts = explode(";base64,", $noimage);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			file_put_contents('../getimg/cate/'.$imgname , $image_base64);

		}
	
	if($cat_id != 0){

			
		// `cat_id``cat_name``sto_id``mem_id``mem_name`
		//  `cat_ip``cat_start_date``cat_img`
			
		$sqli = "UPDATE akksofttech_category 
        SET cat_name = '".$cat_name."',cat_img = '".$imgname."', cat_ip ='".$ip."', cat_start_date = '".$cat_start_date."'
        WHERE cat_id='".$cat_id."'";
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
		
		
		
		$sql = "INSERT into akksofttech_category (cat_name,sto_id,mem_id,mem_name,cat_ip,cat_start_date,cat_img)
		VALUES('".$cat_name."','".$stoid."','".$memid."','".$memname."', '".$ip."' ,'".$cat_start_date."','".$imgname."')";
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