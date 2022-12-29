<?php require_once 'include/condb.php';
     
     @session_start();
	
     $noimage = $_POST['logo_img64'];
    
     $memid =   $_SESSION['akksofttechsess_memid'];
     $memname = $_SESSION['akksofttechsess_name'];
    
     $sto_name = $_POST['sto_name'];
     $sto_address = $_POST['sto_address'];
     $sto_province = $_POST['sto_province'];
     $sto_zipcode = $_POST['sto_zipcode'];
     $sto_start_date = date('Y-m-d H:i:s');
     $ip = $_SERVER['REMOTE_ADDR'];
     
     
     
    if(trim($_FILES["filelogo_picture"]["name"]) != "")
		{     
	
			$imgname = 'naropos_'.date("YmdHis").'.png';
			define('UPLOAD_DIR', 'images/');
			$image_parts = explode(";base64,", $noimage);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			file_put_contents('getimg/logo/'.$imgname , $image_base64);

		}


        
     
        // `sto_id``mem_id``mem_name``pos``sto_name``sto_logo`
        // `sto_address``sto_province``sto_zipcode``sto_latitude`
        // `sto_longtitude``sto_ip``sto_start_date`
        
         $sql ="INSERT INTO akksofttech_member_store (mem_id,mem_name,sto_name,sto_logo,
         sto_address,sto_province,sto_zipcode,sto_latitude,sto_longtitude,sto_ip,sto_start_date)
         VALUES ('".$memid."','".$memname."','".$sto_name."','".$imgname."','".$sto_address."',
         '".$sto_province."','".$sto_zipcode."','0','0','".$ip."','".$sto_start_date."')";
         $result = mysqli_query($connect,$sql) or die ("error ".mysqli_error($connect));
         mysqli_close($connect);   
    
      
         
         
        if($result) {  //เขียนดักแค่ว่า query มีข้อมูลหรือเปล่า?
			
            $coms = "YES";
        }else {
    
            $coms = "NO";
        }


        $json=array('status'=> $coms); 
        $resultArray = array();
        array_push($resultArray,$json);
        echo json_encode($resultArray);
     
     
?>