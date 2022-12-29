
<?php require_once '../include/condb.php';
@session_start();     
	
     $SavefileName =  $_POST['logo_img64'] ;
     
     
   
     $sto_id = $_SESSION['akksofttechsess_stoid'];
     $sto_name = $_SESSION['akksofttechsess_stoname'];    
    
    
     $sto_address = $_POST['sto_address'];
     $sto_province = $_POST['sto_province'];
     $sto_zipcode = $_POST['sto_zipcode'];
     $sto_start_date = date('Y-m-d H:i:s');
     $ip = $_SERVER['REMOTE_ADDR'];
     
     
     //จัดการเรื่องรูป
		$sqllgoods = "SELECT * FROM `akksofttech_member_store` WHERE `sto_id`  =  '".$sto_id."' ";					 
		$resultgoods = mysqli_query($connect,$sqllgoods);
		$dataggoods = mysqli_fetch_array($resultgoods,MYSQLI_BOTH);
		
		$imgname = $dataggoods['sto_logo'];
        if(trim($_FILES["filelogo_picture"]["name"]) != "")
        {     
            $unlinkimgname = "../getimg/manu/".$imgname;
            @unlink($unlinkimgname);
            $imgname = 'naropos_'.date("YmdHis").'.png';
            define('UPLOAD_DIR', 'images/');
            $image_parts = explode(";base64,", $SavefileName);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents('../getimg/logo/'.$imgname , $image_base64);

        }
        
        // `sto_id``mem_id``mem_name``pos``sto_name``sto_logo`
        // `sto_address``sto_province``sto_zipcode``sto_latitude`
        // `sto_longtitude``sto_ip``sto_start_date`
        $sql = "UPDATE akksofttech_member_store 
        SET sto_name = '".$sto_name."',sto_logo = '".$imgname."',
        sto_address = '".$sto_address."',sto_province = '".$sto_province."',sto_zipcode = '".$sto_zipcode."',sto_ip = '".$ip."',sto_start_date = '".$sto_start_date."'
        
        WHERE sto_id='".$sto_id."'";



$query = mysqli_query($connect,$sql) or die ("ERROR ".mysqli_error($connect));
mysqli_close($connect);


if ($query) {
  	echo "<script>";
  	echo "alert('successfully saved');";
  	echo "window.location='index.php'";
  	echo "</script>";
}else{
	echo "<script>";
  	echo "alert('error');";
  	echo "window.history.back()";
  	echo "</script>";
}
     
?>