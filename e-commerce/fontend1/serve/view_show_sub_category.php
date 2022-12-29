<?php session_start(); ?>

<?php 

		require_once '../includedb/condb.php';  

		$cat_id = $_POST['cat_id'];

		$s = "SELECT * FROM akksofttech_subcategory  where akksofttech_subcategory.cat_id=".$cat_id."";

		$r = mysqli_query($conn,$s);

		$n = mysqli_num_rows($r);

		$reslutArray = array();

		if(!$n){

			while($data = mysqli_fetch_array($r,MYSQLI_BOTH))	{

				$arrayBill = array( 
									"scate_id" => $data['scate_id'] ,

									"cat_id" => $data['cat_id'] ,

									"cat_name" => $data['cat_name'] ,

                                    "scate_name" => $data['scate_name'] ,

									"scate_img" => $data['scate_img'] 

								);

				array_push($reslutArray , $arrayBill);

		}		

		}else{
	

		while($data = mysqli_fetch_array($r,MYSQLI_BOTH))	{

				$arrayBill = array( 
									"scate_id" => $data['scate_id'] ,

									"cat_id" => $data['cat_id'] ,

									"cat_name" => $data['cat_name'] ,

                                    "scate_name" => $data['scate_name'] ,

									"scate_img" => $data['scate_img'] 

								);

				array_push($reslutArray , $arrayBill);

		}
	}		
        								
		echo json_encode($reslutArray);

?>