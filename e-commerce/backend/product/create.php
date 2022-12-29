

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();



$noimage = $_POST['logo_img64'];
$prod_id = $_POST['prod_id'];
$prod_name = $_POST['prod_name'];
$prod_price	= $_POST['prod_price'];
$prod_sku = $_POST['prod_sku'];
$prod_detail	= $_POST['prod_detail'];
$prod_quantity	= $_POST['prod_quantity'];
$prod_unit	= $_POST['prod_unit'];
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$stoid = $_SESSION['akksofttechsess_stoid'];
$cat_id = $_POST['cat_id'];
$scate_id = $_POST['scate_id'];
$prod_brand	= $_POST['prod_brand'];
$prod_start_date = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

$sqllgoods = "SELECT * FROM `akksofttech_product` WHERE `prod_id`  =  '".$prod_id."' ";					 
$resultgoods = mysqli_query($connect,$sqllgoods);
$dataggoods = mysqli_fetch_array($resultgoods,MYSQLI_BOTH);
$imgname = $dataggoods['prod_image'];
if(trim($_FILES["fileprod_picture"]["name"]) != "")
		{     
	
			$imgname = 'naropos_'.date("YmdHis").'.png';
			define('UPLOAD_DIR', 'images/');
			$image_parts = explode(";base64,", $noimage);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			file_put_contents('../getimg/prod/'.$imgname , $image_base64);
			
		}
		
	
	if($prod_id != ""){ 
	
		$sqli = "UPDATE akksofttech_product 
        SET prod_name = '".$prod_name."',
		prod_price = '".$prod_price."',
		prod_sku = '".$prod_sku."',
		prod_detail = '".$prod_detail."',
		prod_quantity = '".$prod_quantity."',
		prod_unit = '".$prod_unit."',
		cat_id = '".$cat_id."', 
		scate_id = '".$scate_id."', 
		prod_image = '".$imgname."',
		prod_brand = '".$prod_brand."',
		
		prod_start_date = '".$prod_start_date."',
		prod_ip = '".$ip."'
		WHERE prod_id='".$prod_id."'"; 	
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
	 $check = " SELECT prod_sku ,  prod_name FROM akksofttech_product  WHERE  prod_name = '".$prod_name."' OR prod_sku = '".$prod_sku."'";
 
 	$qcheck  = mysqli_query($connect, $check) or die("Error ".mysqli_error($connect));
    $num=mysqli_num_rows($qcheck);
	$recheck = mysqli_fetch_array($qcheck);
			
    if($num)
    {
		$com = "NOS";
    }else{
	
 
		
		$sql = "INSERT into akksofttech_product  (prod_name, prod_price, prod_sku, prod_detail, prod_quantity,
		prod_unit, sto_id, cat_id, scate_id, prod_image, prod_brand, mem_id, mem_name, prod_ip, prod_start_date)
		VALUES('".$prod_name."','".$prod_price."','".$prod_sku."','".$prod_detail."',
		'".$prod_quantity."','".$prod_unit."', '".$stoid."', '".$cat_id."', '".$scate_id."', 
		'".$imgname."','".$prod_brand."','".$memid."','".$memname."','".$ip."','".$prod_start_date."')";
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