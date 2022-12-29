

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();



$noimage = $_POST['logo_img64'];
$sprod_id = $_POST['sprod_id'];
$sprod_name = $_POST['sprod_name'];
$sprod_price	= $_POST['sprod_price'];
$sprod_sku = $_POST['sprod_sku'];
$sprod_detail	= $_POST['sprod_detail'];
$sprod_quantity	= $_POST['sprod_quantity'];
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$prod_id = $_POST['prod_id'];
$sprod_start_date = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

// `sprod_id``sprod_name``sprod_sku``sprod_image``sprod_quantity``sprod_price`
// `sprod_detail``prod_id``mem_id``mem_name``sprod_ip``sprod_start_date`
$sqllgoods = "SELECT * FROM `akksofttech_subproduct` WHERE `sprod_id`  =  '".$sprod_id."' ";					 
$resultgoods = mysqli_query($connect,$sqllgoods);
$dataggoods = mysqli_fetch_array($resultgoods,MYSQLI_BOTH);
$imgname = $dataggoods['sprod_image'];
if(trim($_FILES["fileprod_picture"]["name"]) != "")
		{     
	
			$imgname = 'naropos_'.date("YmdHis").'.png';
			define('UPLOAD_DIR', 'images/');
			$image_parts = explode(";base64,", $noimage);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			file_put_contents('../getimg/sprod/'.$imgname , $image_base64);
			
		}
	
	if($sprod_id != ""){ 
		// `sprod_id``sprod_name``sprod_sku``sprod_image``sprod_quantity``sprod_price`
        // `sprod_detail``prod_id``mem_id``mem_name``sprod_ip``sprod_start_date`
		 $sqli = "UPDATE akksofttech_subproduct 
		 SET sprod_name = '".$sprod_name."',
		 sprod_sku = '".$sprod_sku."',
		 sprod_image = '".$imgname."',
		 sprod_quantity = '".$sprod_quantity."',
		 sprod_price = '".$sprod_price."',
		 sprod_detail = '".$sprod_detail."',
		 prod_id = '".$prod_id."',
		 sprod_start_date = '".$sprod_start_date."'
		 WHERE sprod_id='".$sprod_id."'

		 "; 	
		
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
		//เช็ค
	 $check = " SELECT sprod_sku FROM akksofttech_subproduct  WHERE  sprod_sku = '".$sprod_sku."'";
 
 	$qcheck  = mysqli_query($connect, $check) or die("Error ".mysqli_error($connect));
    $num=mysqli_num_rows($qcheck);
	$recheck = mysqli_fetch_array($qcheck);
			
    if($num)
    {
		$com = "NOS";
    }else{
		
		
		$sql = "INSERT into akksofttech_subproduct  (sprod_name, sprod_sku, sprod_image, 
		sprod_quantity, sprod_price, sprod_detail, prod_id, mem_id, mem_name, sprod_ip, sprod_start_date)
		VALUES('".$sprod_name."','".$sprod_sku."','".$imgname."','".$sprod_quantity."',
		'".$sprod_price."','".$sprod_detail."','".$prod_id."','".$memid."','".$memname."','".$ip."','".$sprod_start_date."')";
		$query =mysqli_query($connect,$sql) or die ("Error ".mysqli_error($connect));
	    mysqli_close($connect);	
		
		if($query){
		$com = "YES";
		}
		else{
		$com = "NO";
		}
		
	
	}
	
	}
		

		$json=array('in'=>$com ); 
    	$resultArray = array();
    	array_push($resultArray,$json);
    	echo json_encode($resultArray);


	

?>