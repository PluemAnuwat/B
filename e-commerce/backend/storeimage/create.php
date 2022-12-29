

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();


$noimage = $_POST['logo_img64'];
$img_id = $_POST['img_id'];
$memid =   $_SESSION['akksofttechsess_memid'];
$memname = $_SESSION['akksofttechsess_name'];
$stoid = $_SESSION['akksofttechsess_stoid'];
$stoname = $_SESSION['akksofttechsess_stoname'];
$img_start_date = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];


if(trim($_FILES["filesto_picture"]["name"]) != "")
		{     
	
			$imgname = 'naropos_'.date("YmdHis").'.png';
			define('UPLOAD_DIR', 'images/');
			$image_parts = explode(";base64,", $noimage);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			file_put_contents('../getimg/store/'.$imgname , $image_base64);

		}
	if($img_id != 0){
		
		$sqli = "UPDATE akksofttech_member_store_image 
        SET img_name = '".$imgname."', img_ip ='".$ip."', img_start_date = '".$img_start_date."'
        WHERE img_id='".$img_id."'";
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
		// `mem_id``sto_id``sto_name`
		// `img_name``mem_id_save`
		// `mem_name``img_ip``img_start_date`
		
		$sql = "INSERT INTO akksofttech_member_store_image  (mem_id , sto_id, sto_name , 
		img_name, mem_id_save, mem_name, img_ip, img_start_date)
		VALUES('".$memid."','".$stoid."','".$stoname."','".$imgname."', '0', '".$memname."', '".$ip."', '".$img_start_date."')";
		
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