<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  

		$scate_id = $_POST['scate_id'];

			$sql = "SELECT * FROM akksofttech_product WHERE scate_id = '".$scate_id."' ";
        
            $result = mysqli_query($conn,$sql);

            $reslutArray = array();

            $num = mysqli_num_rows($result) ; 

            if(!$num){

                $arrayBill = array("prod_id" => "ไม่มีสินค้า") ;

            }
            
            while($data = mysqli_fetch_array($result,MYSQLI_BOTH))	{

                    $arrayBill = array( 

                                        "prod_id" => $data['prod_id'] ,

                                        "prod_name" => $data['prod_name'] ,

                                        "prod_image" => $data['prod_image'] ,

                                        "prod_price" => $data['prod_price'] ,

                                        "prod_sku" => $data['prod_sku'] ,

                                        "prod_detail" => $data['prod_detail'] ,

                                        "prod_quantity" => $data['prod_quantity'] ,

                                        "prod_unit" => $data['prod_unit'] ,

                                        "sto_id" => $data['sto_id'] ,

                                        "cat_id" => $data['cat_id'] ,

                                        "scate_id" => $data['scate_id'] ,

                                        "prod_brand" => $data['prod_brand'] 

                                    );

                    array_push($reslutArray , $arrayBill);

            }										

            echo json_encode($reslutArray);

?>