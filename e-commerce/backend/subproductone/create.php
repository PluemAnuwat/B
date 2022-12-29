

<?php 
require_once '../include/condb.php';
session_start();




$noimage = $_POST['logo_img64'];
$sprodone_id = $_POST['sprodone_id'];// `sprodone_id`
$sprodone_name = $_POST['sprodone_name'];// `sprodone_name`
$sprodone_sku = $_POST['sprodone_sku'];// `sprodone_sku`
$sprodone_quantity	= $_POST['sprodone_quantity'];// `sprodone_quantity`
$sprodone_price	= $_POST['sprodone_price'];// `sprodone_price`
$sprodone_detail	= $_POST['sprodone_detail'];// `sprodone_detail`
$prod_id = $_POST['prod_id'];
$sprod_id = $_POST['sprod_id'];
$showinput_price  = $_POST['showinput_price'];  
$showinput_sku = $_POST['showinput_sku']; 
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$sprodone_start_date = date('Y-m-d H:i:s');// `sprodone_start_date
$ip = $_SERVER['REMOTE_ADDR'];

 

$sqllgoods = "SELECT * FROM `akksofttech_subproduct_one` WHERE `sprodone_id`  =  '".$sprodone_id."' ";					 
$resultgoods = mysqli_query($connect,$sqllgoods);
$dataggoods = mysqli_fetch_array($resultgoods,MYSQLI_BOTH);
$imgname = $dataggoods['sprodone_image'];
if(trim($_FILES["fileprod_picture"]["name"]) != "")
		{     
	
			$imgname = 'naropos_'.date("YmdHis").'.png';
			define('UPLOAD_DIR', 'images/');
			$image_parts = explode(";base64,", $noimage);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			file_put_contents('../getimg/sprodone/'.$imgname , $image_base64);
			
		}
	
		

	if($sprodone_id != ""){ 
		
		 $sqli = "UPDATE akksofttech_subproduct_one 
		 SET sprodone_name = '".$sprodone_name."',
		 sprodone_sku = '".$sprodone_sku."',
		 sprodone_image = '".$imgname."', 
		 sprodone_quantity = '".$sprodone_quantity."', 
		 sprodone_price = '".$sprodone_price."', 
		 sprodone_detail = '".$sprodone_detail."', 
		 prod_id = '".$prod_id."',
		 sprod_id = '".$sprod_id."',
		 sprod_sku = '".$showinput_sku."',
		 sprod_price = '".$showinput_price."',
		 sprodone_start_date = '".$sprodone_start_date."',
		 sprodone_ip = '".$ip."'
		 WHERE sprodone_id='".$sprodone_id."'";

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
	$check = " SELECT sprodone_sku FROM akksofttech_subproduct_one  WHERE  sprodone_sku = '".$sprodone_sku."'";
 
 	$qcheck  = mysqli_query($connect, $check) or die("Error ".mysqli_error($connect));
    $num=mysqli_num_rows($qcheck);
	$recheck = mysqli_fetch_array($qcheck);
			
    if($num)
    {
		$com = "NOS";
    }else{

		$sql = "INSERT into akksofttech_subproduct_one  (sprodone_name, sprodone_sku, sprodone_image, 
		sprodone_quantity, sprodone_price, sprodone_detail, 
        prod_id,  sprod_id, sprod_sku, sprod_price, 
        mem_id, mem_name, sprodone_ip, sprodone_start_date)
		VALUES('".$sprodone_name."','".$sprodone_sku."','".$imgname."',
        '".$sprodone_quantity."',
		'".$sprodone_price."',
        '".$sprodone_detail."',
        '".$prod_id."',
        '".$sprod_id."',
        '".$showinput_sku."',
        '".$showinput_price."',
        '".$memid."',
        '".$memname."',
        '".$ip."','
        ".$sprodone_start_date."')";
		
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