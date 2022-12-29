<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  


		$prod_id = $_POST['prod_id'];

		$sqll = "SELECT * FROM akksofttech_product where akksofttech_product.prod_id=".$prod_id."";

		$result = mysqli_query($conn,$sqll);
        
		$reslutArray = array();

		while($data = mysqli_fetch_array($result,MYSQLI_BOTH))	{

				$arrayBill = array( 
									"prod_id" => $data['prod_id'] ,

									"prod_name" => $data['prod_name'] ,

									"prod_price" => $data['prod_price'] ,

                                    "prod_image" => $data['prod_image'] 

								);

				array_push($reslutArray , $arrayBill);

		}				
        						
		echo json_encode($reslutArray);


?>